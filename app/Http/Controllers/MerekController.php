<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\User;

class MerekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $brand = Brand::all();
        $user = User::where('level' , 'customer')->get()->all();
        return view('brands.index-brand', compact('brand', 'user'));
    }

    function store(Request $request) {
        $dataStore = $request->all();
        Brand::create($dataStore);
        return redirect()->back()->with('success', 'Merek Telah Di Tambahkan');
    }

    public function edit($id) {
        $brand = Brand::findOrFail($id);
        $user = User::all();
        return view('brands.edit-brand', compact('brand', 'user'));
    }

    function update(Request $request, $id) {
        $brand = Brand::find($id);
        $brand->fill($request->all());
        $brand->save();

        return redirect('/merek')->with('success', 'Brand berhasil diupdate!');
    }

}