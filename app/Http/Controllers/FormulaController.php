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
        $formulas = Formula::all()->groupBy('product_id');
        $productIds = $formulas->keys();

        $productNames = Product::whereIn('id', $productIds)->pluck('name', 'id');
        $formulaSlugs = Formula::whereIn('product_id', $productIds)->pluck('slug', 'product_id');
        return view('formula.index-formula', compact('formulas', 'productNames', 'formulaSlugs'));
    }

    function create() {
        $product = Product::all();
        $inventory = Inventory::all();
        return view('formula.create-formula', compact('product', 'inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required', 
            'slug' => 'required', 
            'nama_bahan_baku.*' => 'required',
            'jumlah.*' => 'required|numeric',
            'satuan.*' => 'required',
        ]);

        $product_id = $request->input('product_id');
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
                'jumlah' => $jumlah[$key],
                'satuan' => $satuan[$key],
                'slug' => $slug,
            ];
        }

        // Menyimpan data ke database
        Formula::insert($data);

        // Redirect atau response sesuai kebutuhan
        return redirect('/formula')->with('success', 'Data berhasil disimpan!');
    }

    
    public function detail($slug) {
        $formulas = Formula::where('slug', $slug)->get();

        $firstFormula = Formula::where('slug', $slug)->first();
        $productName = $firstFormula->product->name;

        return view('formula.detail-formula', compact('productName','formulas'));
    }
}