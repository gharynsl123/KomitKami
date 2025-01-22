<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formula;
use App\Product;
use Illuminate\Support\Str;
use App\Inventory;

class FormulaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $product = Product::with('formula', 'tahapanProses', 'qualityControl', 'produkjadi')->get();

        return view('formula.index-formula', compact('product'));
    }
    
    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $inventory_id = $request->input('inventory_id');
        $nama_bahan_baku = $request->input('nama_bahan_baku');
        $jumlah = $request->input('jumlah');
        $satuan = $request->input('satuan');
        $slug = Str::slug($request->input('slug'));

        $data = [];

        // Looping untuk menyusun data yang akan disimpan
        foreach ($nama_bahan_baku as $key => $bahan_baku) {
            $data[] = [
                'product_id' => $product_id,
                'nama_bahan_baku' => $bahan_baku,
                'inventory_id' => $inventory_id[$key],
                'jumlah' => $jumlah[$key],
                'satuan' => $satuan[$key],
                'slug' => $slug,
            ];
        }

        // Menyimpan data ke database
        Formula::insert($data);

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    
    public function detail($id) {
        $product = Product::where('id', $id)->with('formula', 'tahapanProses', 'qualityControl', 'produkjadi')->first();
        $inventory = Inventory::all();
        return view('formula.detail-formula', compact('product', 'inventory'));
    }
    
}