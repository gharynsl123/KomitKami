<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\PemeriksaanKebersihan;
use App\BagianKebersihan;
use App\RuangProduksi;
use App\Produksi;
use App\User;

class RuangProduksiController extends Controller
{

    public function index() {
        $rooms = RuangProduksi::with('items')->get();

        return view('produksi.atur-ruangan', compact('rooms'));
    }
    public function proses($batch_number) {
        // Query untuk mendapatkan data berdasarkan batch_number

        $produksiSaatini = Produksi::where('batch_number', $batch_number)->first();

        $rooms = RuangProduksi::with('items')->get();
        $pemeriksaanKebersihan  = PemeriksaanKebersihan::where('produksi_id', $produksiSaatini->id);
        $users = User::all();
    
        // Kirim data ke view
        return view('produksi.mulai-produksi', compact('rooms','users', 'pemeriksaanKebersihan', 'produksiSaatini'));
    }
    

    function riwayat() {
        return view('produksi.riwayat-produksi');
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
    

    function storeItems(Request $request) {
        $data = $request->all();
        BagianKebersihan::create($data);
        return redirect()->back()->with('success', 'Ruangan Berhasil Di Tambbhkan');
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

    public function storeProduksi(Request $request) {
        // Ambil data dari request
        $bagianKebersihanIds = $request->input('bagian_kebersihan_id', []);
        $hasil = $request->input('hasil', []);
        $dibersihkanOleh = $request->input('dibersihkan_oleh', []);
        $diperiksaOleh = $request->input('diperiksa_oleh', []);
        $produksiId = $request->input('produksi_id');

        // Validasi manual: Cek apakah jumlah elemen array sesuai
        if (
            count($bagianKebersihanIds) !== count($hasil) || 
            count($hasil) !== count($dibersihkanOleh) || 
            count($dibersihkanOleh) !== count($diperiksaOleh)
        ) {
            return back()->withErrors(['message' => 'Data input tidak konsisten!']);
        }

        // Persiapkan array untuk batch insert
        $dataToInsert = [];
        foreach ($bagianKebersihanIds as $index => $id) {
            // Validasi manual: Pastikan id bagian_kebersihan dan produksi_id valid
            if (!is_numeric($id) || !is_numeric($produksiId)) {
                return back()->withErrors(['message' => 'ID bagian kebersihan atau produksi tidak valid!']);
            }

            $dataToInsert[] = [
                'bagian_kebersihan_id' => $id,
                'hasil' => $hasil[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'dibersihkan_oleh' => $dibersihkanOleh[$index] ?? null,
                'diperiksa_oleh' => $diperiksaOleh[$index] ?? null,
                'produksi_id' => $produksiId,
                'status' => 'diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke database menggunakan query builder
        try {
            DB::table('pemeriksaan_kebersihan')->insert($dataToInsert);
            return back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

}
