<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Produksi;
use Carbon\Carbon;
use App\Brand;
use App\Product;
use App\MaterialProduksi;
use App\Invoice;
use App\Inventory;
use App\Formula;
use Illuminate\Support\Facades\DB;

class ProduksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $tikets = Produksi::all();
        return view('produksi.index-produksi', compact('tikets'));
    }

    function create() {
        $produksi = Produksi::all();
        $brand = Brand::all();
        $product = Product::all();
        $invoice = Invoice::whereIn('status', ['accept', 'process'])->get();
        $formula = Formula::all();
        $inventory = Inventory::with('transactions')->get();

        // Transformasi data untuk menghitung stok akhir
        $inventoryData = $inventory->map(function ($item) {
            $currentMonth = now()->month;
            $currentYear = now()->year;
    
            // Hitung stok akhir berdasarkan transaksi bulan ini
            $stokAkhir = $item->transactions()
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->sum(DB::raw('CASE WHEN jenis = "in" THEN jumlah_barang WHEN jenis = "out" THEN -jumlah_barang ELSE 0 END'));
    
            return [
                'name' => $item->name,
                'stok_akhir' => $stokAkhir,
            ];
        });
    
        return view('produksi.create-produksi', compact('brand', 'product', 'invoice', 'formula', 'inventoryData'));
    }

    function detail($batch_number) {
        $produksi = Produksi::where('batch_number', $batch_number)->first();

        $formula = Formula::where('product_id', $produksi->product->id)->get();
        return view('produksi.detail-produksi', compact('produksi', 'formula'));
    }
    
    function confirmProduksi(Request $request, $id) {
        $produksi = Produksi::find($id);
    
        if ($produksi) {
            $data = $request->all();
            $data['status'] = 'confirm';
    
            // Update status produksi
            $produksi->update($data);
    
            // Ambil produksi_id, user_id, dan formula terkait
            $produksiId = $produksi->id;
            $userId = auth()->user()->id;
    
            // Ambil semua formula terkait produksi
            $formulas = Formula::where('product_id', $produksi->product->id)->get();

            foreach ($formulas as $formula) {
                MaterialProduksi::create([
                    'produksi_id' => $produksiId,
                    'formula_id' => $formula->id,
                    'user_id' => $userId,
                    'persetujuan' => 'approved', // Set persetujuan langsung 'approved'
                ]);
            }
    
            return redirect()->back()->with('success', 'Produksi berhasil dikonfirmasi dan material produksi dibuat');
        }
    
        return redirect()->back()->with('error', 'Produksi tidak ditemukan');
    }

    function updateSatusProduksi(Request $request, $id) {
        // Temukan equipment berdasarkan slug
        $produksi = Produksi::find($id);
    
        // Update status garansi
        $produksi->status = $request->status;
        $produksi->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Status garansi berhasil diperbarui',
        ]);
    }

    public function getProducts($invoice_id) {
        // Ambil invoice berdasarkan ID
        $invoice = Invoice::find($invoice_id);
    
        // Periksa apakah invoice ada
        if (!$invoice) {
            return response()->json(['error' => 'Invoice tidak ditemukan'], 404);
        }
    
        // Ambil semua order yang terkait dengan invoice
        $orders = $invoice->orders;
    
        // Inisialisasi array untuk menyimpan produk
        $products = [];
    
        // Loop setiap order dan ambil produk terkait
        foreach ($orders as $order) {
            if ($order->product) {
                $products[] = [
                    'product_id' => $order->product->id,
                    'product_name' => $order->product->name,
                    'brand_name' => $order->product->brand->name 
                ];
            }
        }
    
        // Kembalikan data produk dalam bentuk JSON
        return response()->json($products);
    }

    public function getLastProductionNumber(Request $request) {
        $year = $request->input('year');
        
        // Cari batch terakhir untuk tahun yang sama, tanpa memperhatikan kode produk atau bulan
        $lastProduction = DB::table('produksi')
                            ->where('batch_number', 'like', "$year%")
                            ->orderBy('batch_number', 'desc')
                            ->first();
    
        if ($lastProduction) {
            // Ambil 3 digit terakhir sebagai nomor urut terakhir
            $lastProductionNumber = substr($lastProduction->batch_number, -3);
            return response()->json(['success' => true, 'lastProductionNumber' => $lastProductionNumber]);
        } else {
            // Jika belum ada batch number untuk tahun tersebut
            return response()->json(['success' => false, 'lastProductionNumber' => null]);
        }
    }
    
    function store(Request $request) {
        $storeData = $request->all();
    
        // Cek apakah invoice_id ada di dalam request, jika ada baru lakukan update
        if (!empty($request->invoice_id)) {
            // Ambil invoice berdasarkan invoice_id
            $invoice = Invoice::where('id', $request->invoice_id)->first();
    
            // Jika invoice ditemukan, update status invoice menjadi "process"
            if ($invoice) {
                $invoice->update(['status' => 'process']);
    
                // Update status semua orders terkait invoice
                $orders = Order::where('invoice_id', $invoice->id)->get();
                foreach ($orders as $order) {
                    $order->update(['status' => 'process']);
                }
            }
        }
    
        // Tentukan status produksi berdasarkan tanggal produksi
        if (Carbon::parse($request['tanggal_produksi'])->isToday()) {
            $storeData['status'] = 'open';
        } else {
            $storeData['status'] = 'pending';
        }
    
        // Simpan data produksi
        Produksi::create($storeData);
    
        // Redirect ke halaman ruang produksi dengan pesan sukses
        return redirect('/ruang-produksi')->with('success', 'Tiket berhasil dibuat');
    }

    function show($date){
        // Ambil data tiket berdasarkan tanggal
        $tikets = Produksi::whereDate('tanggal_produksi', $date)->get();
    
        // Tampilkan view dengan data tiket
        return view('produksi.detail-list-tiket', compact('tikets', 'date'));
    }
}