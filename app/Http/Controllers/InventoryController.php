<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Inventory;
use App\Product;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request) {
        // Mendapatkan bulan dan tahun dari request
        $month = $request->input('month');
        $year = $request->input('year');
    
        // Jika bulan dan tahun tidak dipilih, gunakan bulan dan tahun saat ini
        if (!$month || !$year) {
            $month = date('m');
            $year = date('Y');
        }
    
        // Cari bulan dan tahun sebelumnya
        $previousMonth = $month - 1;
        $previousYear = $year;
    
        // Jika bulan sebelumnya adalah Januari, ubah ke Desember tahun sebelumnya
        if ($previousMonth === 0) {
            $previousMonth = 12;
            $previousYear -= 1;
        }
    
        $inventory = Inventory::with(['transactions' => function ($query) use ($month, $year) {
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        }])->get();
    
        $inventoryData = $inventory->map(function ($item) use ($previousMonth, $previousYear) {
            $stokAkhirBulanLalu = $item->transactions()
                ->whereMonth('created_at', $previousMonth)
                ->whereYear('created_at', $previousYear)
                ->sum(DB::raw('CASE WHEN jenis = "in" THEN jumlah_barang WHEN jenis = "out" THEN -jumlah_barang ELSE 0 END'));
    
            $stokAwal = $item->stok;  // Default to the current stock value
            if ($stokAkhirBulanLalu !== 0) {
                $stokAwal = $stokAkhirBulanLalu;
            }
    
            $stokMasuk = $item->transactions->where('jenis', 'in')->sum('jumlah_barang');
            $stokKeluar = $item->transactions->where('jenis', 'out')->sum('jumlah_barang');
            $stokAkhir = $stokAwal + $stokMasuk - $stokKeluar;
    
            return [
                'name' => $item->name,
                'code' => $item->code,
                'slug' => $item->slug,
                'type' => $item->type,
                'stok_awal' => $stokAwal,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => $stokKeluar,
                'stok_akhir' => $stokAkhir
            ];
        });
    
        return view('inventory.index-inventory', compact('inventoryData', 'month', 'year'));
    }    

    function store(Request $request) {
        $dataStore = $request->all();
        $dataStore['slug'] = Str::slug($request->name);
        Inventory::create($dataStore);

        return redirect('local-inventory')->with('success', 'bahan baku behasil di tambahkan');
    }

    function detail($slug) {
        $inventory = Inventory::where('slug', $slug)->get();

        $inventoryData = $inventory->map(function ($item) {
            $stokMasuk = $item->transactions->where('jenis', 'in')->sum('jumlah_barang');
            $stokKeluar = $item->transactions->where('jenis', 'out')->sum('jumlah_barang');
            $stokAkhir = $item->stok + $stokMasuk - $stokKeluar;

            return [
                'name' => $item->name,
                'code' => $item->code,
                'slug' => $item->slug,
                'stok_awal' => $item->stok,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => $stokKeluar,
                'stok_akhir' => $stokAkhir
            ];
        });

        $idventory = Inventory::where('slug', $slug)->first();
        
        $transaction = Transaction::where('inventory_id', $idventory->id)->get();

        
        return view('inventory.detail-inventory', compact('inventory', 'transaction', 'inventoryData'));
    }
}
