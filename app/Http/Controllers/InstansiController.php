<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index() {
        $instansi = Instansi::all();
        return view('costumer.index-costumer', compact('instansi'));
    }
    function create() {
        $instansi = Instansi::all();
        return view('costumer.create-costumer', compact('instansi'));
    }

    function store(Request $request) {
        $dataStore = $request->all();
        
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/instansi_images');
            $dataStore['photo'] = basename($photoPath);
        }
        Instansi::create($dataStore);
        return redirect('/customer')->with('success', 'Costumer berhasil Di tambahkan');
    }
}
