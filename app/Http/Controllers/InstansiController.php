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
}
