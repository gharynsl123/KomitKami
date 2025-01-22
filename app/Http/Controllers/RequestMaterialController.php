<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produksi;
use App\Formula;
use App\MaterialProduksi;

class RequestMaterialController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    function create($batch_number) {
        $produksi = Produksi::where('batch_number', $batch_number)->first();

        $formula = Formula::where('product_id', $produksi->product->id)->get();
        return view('formulir-permintaan.create-permintaan', compact('produksi', 'formula'));
    }

    public function store(Request $request)
    {
        $produksiId = $request->input('produksi_id');
        $userId = auth()->user()->id;

        $formulas = $request->input('formula_id');
        $jumlahYangDisediakan = $request->input('jumlah_yang_di_sediakan');
        $persetujuan = $request->input('persetujuan');

        foreach ($formulas as $key => $formulaId) {
            MaterialProduksi::create([
                'produksi_id' => $produksiId,
                'formula_id' => $formulaId,
                'jumlah_yang_di_sediakan' => $jumlahYangDisediakan[$key],
                'user_id' => $userId,
                'persetujuan' => $persetujuan[$key] ?? 'pending', // Default value jika persetujuan tidak diinput
            ]);
        }

        return redirect('/permintaan-material')->with('success', 'Permintaan material berhasil dikirim.');
    }


    function index() {
        $permintaan_material = MaterialProduksi::where('persetujuan', 'approved')
            ->with(['formula.product', 'produksi'])
            ->get()
            ->groupBy('produksi.batch_number'); // Mengelompokkan berdasarkan batch_number dari produksi
            
        // Return view dengan data yang telah diambil
        return view('formulir-permintaan.index-permintaan', compact('permintaan_material'));
    }
    
    function showAll() {
        $permintaan_material = MaterialProduksi::with(['formula.product', 'produksi'])
            ->get()
            ->groupBy('produksi.batch_number'); // Mengelompokkan berdasarkan batch_number dari produksi
            
        // Return view dengan data yang telah diambil
        return view('transaction.show-all', compact('permintaan_material'));
    }
    
}
