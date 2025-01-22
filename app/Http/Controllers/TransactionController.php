<?php

namespace App\Http\Controllers;

use App\User;
use App\Brand;
use App\Restok;
use App\Formula;
use App\Instansi;
use App\Inventory;
use App\Transaction;
use App\MaterialProduksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    function index() {
        $transaction  = Transaction::where('jenis', 'in')->get();
        $inventory = Inventory::all();
        return view('transaction.create-transaction', compact('transaction', 'inventory'));
    }

    public function out() {
        $user = User::where('level', '!=', 'Customer')->get();
        $transaction = Transaction::where('jenis', 'out')->get();
    
        $batchNumber = Transaction::whereNull('nomor_pengambilan')
        ->select('no_bach', 'tanggal_ed')
        ->get();
    
        $inventory = Inventory::all();
    
        $batches = MaterialProduksi::where('persetujuan', 'approved')
            ->with(['formula.product', 'produksi']) // Mengambil relasi formula yang berhubungan dengan produk, dan produksi
            ->get()
            ->groupBy('produksi.batch_number');
    
        return view('transaction.keluar-stok-barang', compact('transaction', 'user', 'batchNumber', 'batches', 'inventory'));
    }

    public function getBatchDetails(Request $request) {
        $namaBahanBaku = $request->input('nama_bahan_baku');
    
        $data = Transaction::select('no_bach', 'tanggal_ed')->where('jenis', 'in')
            ->whereHas('inventory', function($query) use ($namaBahanBaku) {
                $query->where('name', 'like', '%' . $namaBahanBaku . '%');
            })
            ->with('inventory') // Pastikan 'inventory' adalah nama relasi yang benar di model Transaction
            ->get();
    
        return response()->json(['data' => $data]);
    }
    
    

    public function getFormulasByBatch($batch_number) {
        // Mengambil data material produksi berdasarkan batch number
        $batches = MaterialProduksi::where('persetujuan', 'approved')
            ->whereHas('produksi', function ($query) use ($batch_number) {
                $query->where('batch_number', $batch_number);  // Menggunakan batch number
            })
            ->with(['formula.product', 'produksi'])
            ->get();
    
        // Pastikan data ditemukan
        if ($batches->isEmpty()) {
            return response()->json(['message' => 'Batch number tidak ditemukan'], 404);
        }
    
        // Jika bulan dan tahun tidak dipilih, gunakan bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');
        $previousMonth = $currentMonth - 1;
        $previousYear = $currentYear;

        if ($previousMonth == 0) {
            $previousMonth = 12;
            $previousYear -= 1;
        }
    
        // Mengelompokkan data formula
        $formulas = $batches->map(function($batch) use ($currentMonth, $currentYear, $previousMonth, $previousYear) {
            // Ambil inventory ID berdasarkan nama bahan baku
            $inventoryId = Inventory::where('name', 'like', '%' . $batch->formula->nama_bahan_baku . '%')->value('id');
    
            // Hitung stok akhir bulan lalu sebagai stok awal
            $stokAkhirBulanLalu = Transaction::where('inventory_id', $inventoryId)
                ->whereMonth('created_at', $previousMonth)
                ->whereYear('created_at', $previousYear)
                ->sum(DB::raw('CASE WHEN jenis = "in" THEN jumlah_barang WHEN jenis = "out" THEN -jumlah_barang ELSE 0 END'));
    
            // Hitung stok awal
            $stokAwal = $stokAkhirBulanLalu ?: 0;
    
            // Hitung stok masuk dan keluar bulan ini
            $stokMasuk = Transaction::where('inventory_id', $inventoryId)
                ->where('jenis', 'in')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->sum('jumlah_barang');
    
            $stokKeluar = Transaction::where('inventory_id', $inventoryId)
                ->where('jenis', 'out')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->sum('jumlah_barang');
    
            // Hitung stok akhir
            $stokAkhir = $stokAwal + $stokMasuk - $stokKeluar;
    
            return [
                'nama_bahan_baku' => $batch->formula->nama_bahan_baku,
                'inventory_id' => $inventoryId,
                'stok_akhir' => $stokAkhir,
                'jumlah' => $batch->formula->jumlah,
                'satuan' => $batch->formula->satuan,
            ];
        });
    
        // Mengembalikan data formula yang terkait dengan batch number ini
        return response()->json([
            'formulas' => $formulas
        ]);
    }

    function create() {
        $merek = Brand::all();
        $transaction = Transaction::all();
        $inventory = Inventory::all();
        $instansi = Instansi::all();
        return view('transaction.create-transaction', compact('transaction', 'inventory', 'merek' ,'instansi'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Transaction::create($data);
        return redirect()->back()->with('success', 'Transaksi sudah dibuat');
    }
    

    public function storeOut(Request $request)
    {
        // Pastikan data yang dibutuhkan ada dalam request
        if ($request->has('jumlah_barang') && is_array($request->jumlah_barang)) {
            // Loop melalui data array yang dikirimkan
            foreach ($request->jumlah_barang as $index => $jumlahBarang) {
                Transaction::create([
                    'nomor_pengambilan' => $request->nomor_pengambilan[$index] ?? null, // Berikan nilai default jika `nomor_pengambilan` tidak ada
                    'jumlah_barang' => $jumlahBarang,
                    'tanggal_transaksi' => $request->tanggal_transaksi[$index] ?? now(), // Berikan tanggal sekarang jika `tanggal_transaksi` tidak ada
                    'jenis' => $request->jenis,
                    'inventory_id' => $request->inventory_id[$index] ?? null,
                    'id_user' => $request->id_user,
                ]);
            }
        }
    
        // Mengambil batch number yang dipilih dari request, jika ada
        $batchNumber = $request->batch_number;
    
        // Mengupdate status persetujuan menjadi 'done' pada tabel MaterialProduksi
        $permintaan_material = MaterialProduksi::where('persetujuan', 'approved')
            ->whereHas('produksi', function ($query) use ($batchNumber) {
                $query->where('batch_number', $batchNumber);
            })
            ->get();
        
        foreach ($permintaan_material as $material) {
            $material->persetujuan = 'done';
            $material->save();
        }
    
        return redirect()->back()->with('success', 'Transaksi sudah dibuat');
    }

    function delete(Request $req, $id) {
        $dataDelete = Transaction::find($id);
        $dataDelete->delete();
        return redirect()->back()->with('success', 'data berhasil di hapus');
    }
}