<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;

class InstansiController extends Controller
{
    function index() {
        $instansi = Instansi::all();
        return view('instansi.index-instansi');
    }
}
