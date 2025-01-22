<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\BagianKebersihan;
use App\TahapanProses;
use App\QualityControl;
use App\SerahTerimaBarang;

class ProsesProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeTahapan(Request $request) {
        DB::table('tahapan_proses')->insert([
            'product_id' => $request->product_id,
            'nama_proses' => $request->nama_proses,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tahapan proses berhasil disimpan.');
    }

    public function storeQuality(Request $request) {
        DB::table('quality_control')->insert([
            'product_id' => $request->product_id,
            'parameter_pengujian' => $request->parameter_pengujian,
            'nilai_standart' => $request->nilai_standart,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tahapan proses berhasil disimpan.');
    }

    public function storeCheckQuality(Request $request) {
        $qualityID = $request->input('quality_id', []);
        $produksiId = $request->input('produksi_id');
        $keterangan = $request->input('nilai_real', []);
        $PJ = $request->input('petugas_qc', []);

        $dataToInsert = [];
        foreach ($qualityID as $index => $id) {

            $dataToInsert[] = [
                'quality_id' => $id,
                'produksi_id' => $produksiId,
                'nilai_real' => $keterangan[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'petugas_qc' => $PJ[$index] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('pemeriksaan_quality_control')->insert($dataToInsert);
        return redirect()->back()->with('success', 'Data berhasil disimpan tanpa validasi.');
    }

    public function storeProses(Request $request) {
        // Ambil data dari request
        $tahapanID = $request->input('tahapan_id', []);
        $produksiId = $request->input('produksi_id');
        $keterangan = $request->input('keterangan', []);
        $PJ = $request->input('penanggung_jawab', []);

        $dataToInsert = [];
        foreach ($tahapanID as $index => $id) {

            $dataToInsert[] = [
                'tahapan_id' => $id,
                'produksi_id' => $produksiId,
                'keterangan' => $keterangan[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'penanggung_jawab' => $PJ[$index] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('check_tahapan_proses')->insert($dataToInsert);
        return redirect()->back()->with('success', 'Data berhasil disimpan tanpa validasi.');
    }

    public function storeRekonsiliasi(Request $request) {
        // Ambil data dari request
        $produksiId = $request->input('produksi_id');
        $formulaId = $request->input('formula_id', []);
        $terpakai = $request->input('terpakai', []);
        $keterangan = $request->input('keterangan', []);
        $operator = $request->input('operator', []);

        $dataToInsert = [];
        foreach ($formulaId as $index => $id) {

            $dataToInsert[] = [
                'formula_id' => $id,
                'produksi_id' => $produksiId,
                'terpakai' => $terpakai[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'keterangan' => $keterangan[$index] ?? null,
                'operator' => $operator[$index] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('rekonsiliasi_bahan_kemas')->insert($dataToInsert);
        return back()->with('success', 'Data berhasil disimpan!');
    }


    function storeItems(Request $request) {
        $data = $request->all();
        BagianKebersihan::create($data);
        return redirect()->back()->with('success', 'Ruangan Berhasil Di Tambbhkan');
    }

    public function storeProduksi(Request $request) {
        // Ambil data dari request
        $bagianKebersihanIds = $request->input('bagian_kebersihan_id', []);
        $hasil = $request->input('hasil', []);
        $dibersihkanOleh = $request->input('dibersihkan_oleh', []);
        $diperiksaOleh = $request->input('diperiksa_oleh', []);
        $produksiId = $request->input('produksi_id');

        $dataToInsert = [];
        foreach ($bagianKebersihanIds as $index => $id) {
            if (!is_numeric($id) || !is_numeric($produksiId)) {
                return back()->withErrors(['message' => 'ID bagian kebersihan atau produksi tidak valid!']);
            }

            $dataToInsert[] = [
                'bagian_kebersihan_id' => $id,
                'hasil' => $hasil[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'dibersihkan_oleh' => $dibersihkanOleh[$index] ?? null,
                'diperiksa_oleh' => $diperiksaOleh[$index] ?? null,
                'produksi_id' => $produksiId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('pemeriksaan_kebersihan')->insert($dataToInsert);
        return back()->with('success', 'Data berhasil disimpan!');
    }

    public function storePenimbangan(Request $request) {
        // Ambil data dari request
        $produksiId = $request->input('produksi_id');
        $formulaId = $request->input('formula_id', []);
        $noBatch = $request->input('no_batch', []);
        $hasilTimbang = $request->input('hasil_timbang', []);
        $Operator = $request->input('operator_penimbangan', []);
        $spvUser = $request->input('spv_produksi', []);

        $dataToInsert = [];
        foreach ($formulaId as $index => $id) {

            $dataToInsert[] = [
                'formula_id' => $id,
                'produksi_id' => $produksiId,
                'no_batch' => $noBatch[$index] ?? 'Tidak Diketahui', // Default jika hasil tidak ada
                'hasil_timbang' => $hasilTimbang[$index] ?? null,
                'operator_penimbangan' => $Operator[$index] ?? null,
                'spv_produksi' => $spvUser[$index] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('penimbangan_bahan_baku')->insert($dataToInsert);
        return back()->with('success', 'Data berhasil disimpan!');
    }

    public function storeProdukJadi(Request $request) {
        $dataAll = $request->all();
        SerahTerimaBarang::create($dataAll);
        return redirect()->back();
    }

    public function deleteTahapanProses($id)
    {
        // Cari data berdasarkan ID
        $tahapanProses = TahapanProses::find($id);
        $tahapanProses->delete();
        return redirect()->back()->with('success', 'data berhasil di hapus.');
    }

    public function deleteQualityControl($id) {
        $qualtiyControler = QualityControl::find($id);
        $qualtiyControler->delete();
        return redirect()->back()->with('success', 'data berhasil di hapus');
    }

    public function updateNamaProses(Request $request, $id) {
        $request->validate([
            'nama_proses' => 'required|string',
        ]);
    
        $tahapan = TahapanProses::findOrFail($id);
        $tahapan->nama_proses = $request->nama_proses;
        $tahapan->save();
    
        return response()->json(['success' => true]);
    }

}