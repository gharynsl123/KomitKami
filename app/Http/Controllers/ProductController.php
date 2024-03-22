<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $products = Product::all();
        return view('products.index-product', compact('products'));
    }

    function create() {
        $products = Product::all();
        $brand = Brand::all();
        return view('products.create-product', compact('brand','products'));
    }

    function store(Request $request) {
        $dataStore = $request->all();
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/product_images');
            $dataStore['photo'] = basename($photoPath);
        }

        Product::create($dataStore);
        return redirect('/products')->with('success', 'Product Berhasil di tambahkan');
    }

    function edit($id)  {
        $product = Product::find($id);
        $brand = Brand::all();
        return view('products.edit-product', compact('product', 'brand'));
    }


    function update(Request $request, $id) {
        $product = Product::find($id);

        $product->fill($request->all());

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/product_images');
            $product->photo = $photoPath;
        } elseif ($product->photo) {
            $product->photo = $product->photo;
        }

        $product->save();
        return redirect('/products')->with('success', 'Product Berhasil Di Update');
    }
}