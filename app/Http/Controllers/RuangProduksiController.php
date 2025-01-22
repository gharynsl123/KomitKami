<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\RekonsiliasiBahanKemas;
use App\PemeriksaanKebersihan;
use App\PenimbanganBahanBaku;
use App\QualityControlCheck;
use App\CheckTahapanProses;
use App\BagianKebersihan;
use App\QualityControl;
use App\RuangProduksi;
use App\TahapanProses;
use App\Transaction;
use App\Produksi;
use App\Product;
use App\Formula;
use App\User;

class RuangProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $rooms = RuangProduksi::with('items')->get();

        return view('produksi.atur-ruangan', compact('rooms'));
    }

    public function proses($batch_number) {
        // Query untuk mendapatkan data berdasarkan batch_number

        $produksiSaatini = Produksi::where('batch_number', $batch_number)->first();

        // mengambil nomorbatch tepat sebelum prosukdi saat ini
        $produksiSebelumIni = Produksi::where('batch_number', $produksiSaatini->batch_number - 1)->first();

        $penimbanganBahanBaku = Formula::where('product_id', $produksiSaatini->product->id)
        ->whereHas('inventory', function ($query) {
            $query->where('type', 'Bahan Baku');
        })
        ->with('inventory')
        ->get();

        $transaction = Transaction::with(['inventory' => function ($query) use ($produksiSaatini) {
            $query->where('name', Formula::where('product_id', $produksiSaatini->product->id)->value('inventory_id'));
        }])->get();
        
        $rooms = RuangProduksi::with('items')->get();

        $pemeriksaanKebersihan = PemeriksaanKebersihan::with(['bagianKebersihan.ruangProduksi'])
        ->where('produksi_id', $produksiSaatini->id)
        ->get()
        ->groupBy('bagianKebersihan.ruang_produksi_id');
    
        $pemeriksaanPenimbang = PenimbanganBahanBaku::with('formula')
        ->where('produksi_id', $produksiSaatini->id)
        ->get();

        $pemeriksaanProsesProduksi = CheckTahapanProses::with('tapahanProses')
        ->where('produksi_id', $produksiSaatini->id)
        ->get();

        $pemeriksaanQualityControl = QualityControlCheck::with('qualityControl')
        ->where('produksi_id', $produksiSaatini->id)
        ->get();

        $rekonsiliasiBahanKemas = RekonsiliasiBahanKemas::with('formula')
        ->where('produksi_id', $produksiSaatini->id)->get();

        $rekonsiliasiBarang = Formula::where('product_id', $produksiSaatini->product->id)
        ->whereHas('inventory', function ($query) {
            $query->where('type', 'Bahan Kemas');
        })
        ->with('inventory')
        ->get();


        $users = User::all();

        $quality = QualityControl::where('product_id', $produksiSaatini->product->id)->get();
        $tahapan = TahapanProses::where('product_id', $produksiSaatini->product->id)->get();

        // Kirim data ke view
        return view('produksi.mulai-produksi', compact('rooms','produksiSebelumIni', 'users', 'rekonsiliasiBarang', 'rekonsiliasiBahanKemas', 'penimbanganBahanBaku','pemeriksaanQualityControl','pemeriksaanProsesProduksi','transaction', 'pemeriksaanPenimbang', 'quality', 'tahapan', 'pemeriksaanKebersihan', 'produksiSaatini'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
        ]);
    
        $room = RuangProduksi::findOrFail($id);
        $room->nama_ruangan = $request->nama_ruangan;
        $room->save();
    
        return response()->json(['success' => true]);
    
    }

    public function showRiwayatProduksi() {

        $tikets = Produksi::all();
        $pemeriksaanKebersihan = DB::table('pemeriksaan_kebersihan')->get();
        $penimbanganBahanBaku = DB::table('penimbangan_bahan_baku')->get();
        $penimbanganBahanBaku = DB::table('penimbangan_bahan_baku')->get();
        $tahapanProses = DB::table('check_tahapan_proses')->get();
        $rekonsiliasiBahanKemas = DB::table('rekonsiliasi_bahan_kemas')->get();

        return view('produksi.riwayat-produksi', compact('pemeriksaanKebersihan', 'tikets','penimbanganBahanBaku', 'tahapanProses', 'rekonsiliasiBahanKemas'));
    }


    function createRuangan(Request $request) {
        $data = $request->all();
        RuangProduksi::create($data);
        return redirect()->back()->with('success', 'Ruangan Berhasil Di Tambbhkan');
    }

    function deleteItem($id) {
        $item = BagianKebersihan::find($id);
        $item->delete();
        return redirect()->back();
    }
}