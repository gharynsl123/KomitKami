<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\MaterialProduksi;
use App\Inventory;
use App\Produksi;
use App\Formula;
use App\CheckSerahTerimaBarang;
use App\Product;
use App\Invoice;
use App\Order;
use App\Brand;

use Carbon\Carbon;


class ProduksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $tikets = Produksi::all();
        $tiketsjadwal = Produksi::whereNull('tanggal_produksi')->get(); 
        return view('produksi.index-produksi', compact('tikets', 'tiketsjadwal'));
    }

    function create() {
        $produksi = Produksi::all();
        $brand = Brand::all();
        $product = Product::all();
        $invoice = Invoice::whereIn('status', ['accept'])->get();
        $inventory = Inventory::with('transactions')->get();
        
        $formula = Formula::all();
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

    public function updateEvent($id, Request $request)
    {
        $event = Produksi::find($id);
    
        $event->tanggal_produksi = Carbon::parse($request->tanggal_produksi)->setTimezone('Asia/Jakarta');
        $event->save();
    
        return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
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

    public function getFormula($invoiceId) {
        $invoice = Invoice::with('orders.product')->find($invoiceId);
        $inventory = Inventory::with('transactions')->get();
    
        $formulas = [];
        if ($invoice) {
            $productIds = $invoice->orders->pluck('product.id')->filter();
            $formulas = Formula::whereIn('product_id', $productIds)->get();

            // Ambil stok akhir dari inventory
            $inventoryData = $inventory->map(function ($item) {
                $currentMonth = now()->month;
                $currentYear = now()->year;

                $stokAkhir = $item->transactions()
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum(DB::raw('CASE WHEN jenis = "in" THEN jumlah_barang WHEN jenis = "out" THEN -jumlah_barang ELSE 0 END'));

                return [
                    'name' => $item->name,
                    'stok_akhir' => $stokAkhir,
                ];
            });

            // Gabungkan stok akhir ke dalam data formula
            $formulas = $formulas->map(function ($formula) use ($inventoryData) {
                $inventoryItem = $inventoryData->firstWhere('name', $formula->nama_bahan_baku);
                $formula->stok_akhir = $inventoryItem ? $inventoryItem['stok_akhir'] : 0;
                return $formula;
            });
        }
    
        return response()->json($formulas);
    }

    public function getProducts($invoice_id) {
        // Ambil invoice berdasarkan ID
        $invoice = Invoice::find($invoice_id);
    
        if (!$invoice) {
            return response()->json(['error' => 'Invoice tidak ditemukan'], 404);
        }
    
        $orders = $invoice->orders;
        $products = [];
    
        foreach ($orders as $order) {
            if ($order->product) {
                $hasil_acuan = $order->product->produkjadi->first()->hasil_acuan ?? 1; // Ambil hasil acuan, default 1 jika null
                $batch_size = $order->product->produkjadi->first()->size_batch ?? 1; // Ambil hasil acuan, default 1 jika null
                $jumlah_tiket = ceil($order->quantity / $hasil_acuan); // Hitung jumlah tiket
                $products[] = [
                    'product_id' => $order->product->id,
                    'product_name' => $order->product->name,
                    'brand_name' => $order->product->brand->name,
                    'hasil_satu_batch' => $hasil_acuan,
                    'ukurang_batch' => $batch_size,
                    'code_product' => $order->product->code,
                    'jumlah_yang_di_pesan' => $order->quantity,
                    'jumlah_tiket' => $jumlah_tiket, // Kirim jumlah tiket ke front-end
                ];
            }
        }
    
        // Kembalikan data produk dalam bentuk JSON
        return response()->json($products);
    }

    public function getLastProductionNumber(Request $request) {
        $year = date('Y'); // Tahun saat ini
        $lastProduction = DB::table('produksi')
                            ->where('batch_number', 'like', substr($year, -3) . '%') // Ambil batch untuk tahun ini
                            ->orderBy('batch_number', 'desc')
                            ->first();
    
        if ($lastProduction) {
            // Ambil 3 digit terakhir dari batch_number
            $lastProductionNumber = intval(substr($lastProduction->batch_number, -3)); 
            return response()->json(['success' => true, 'lastProductionNumber' => $lastProductionNumber]);
        }
    
        // Jika tidak ada, mulai dari 0
        return response()->json(['success' => true, 'lastProductionNumber' => 0]);
    }

    public function updateStatusDone(Request $request, $id)
    {
        // Cari produksi berdasarkan ID
        $produksi = Produksi::findOrFail($id);

        // Update status menjadi 'close'
        $produksi->status = $request->status;
        $produksi->save();

        return response()->json([
            'message' => 'Status updated successfully!',
            'produksi' => $produksi
        ]);
    }
    
    
    function store(Request $request) {
        $data = $request->all();
        $formulaId = $data['formula_id']; 
    
        $invoice = Invoice::where('id', $request->input('invoice_id'))->first();
        $invoice->update(['status' => 'process']);

        $orderItems = Order::where('invoice_id', $invoice->id)->get();
        foreach ($orderItems as $order) {
            $order->status = 'process';
            $order->save();
        }
        
        foreach ($data['batch_number'] as $key => $batchNumber) {
            Produksi::create([
                'batch_number' => $batchNumber,
                'product_id' => $data['product_id'][$key],
                'formula_id' => $formulaId,
                'batch_size' => $data['batch_size'][$key],
                'tanggal_expired' => $data['tanggal_expired'][$key],
            ]);
        }
    
        return redirect('/ruang-produksi')->with('success', 'Tiket berhasil dibuat');
    }
    
    function show($date){
        // Ambil data tiket berdasarkan tanggal
        $tikets = Produksi::whereDate('tanggal_produksi', $date)->get();
    
        // Tampilkan view dengan data tiket
        return view('produksi.detail-list-tiket', compact('tikets', 'date'));
    }

    function kirimBarangJadi(Request $request, $id) {
        $produksi = Produksi::find($id); // Gunakan findOrFail untuk menangani jika data tidak ditemukan
    
        $produksi->status = 'close';
        $produksi->save(); // Variabelnya adalah $produksi, bukan $product

        // ambil relasi
        $product = Product::where('id', $produksi->product->id)->first();
    
        $stok = $product->stok ?? 0;

        $product['stok'] = $stok + $request->nilai_actual;
        $product->update();

        // Validasi input
        $validatedData = $request->validate([
            'produksi_id' => 'required|integer|exists:produksi,id',
            'nilai_actual' => 'required|string|max:255',
        ]);
    
        CheckSerahTerimaBarang::create($validatedData);
        return redirect()->back()->with('success', 'Barang berhasil dikirim.');
    }
}