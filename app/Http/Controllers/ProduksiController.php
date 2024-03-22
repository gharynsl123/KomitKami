<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class ProduksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $order = Order::where('status', 'accept' || 'status', 'process');
        return view('produksi.index-produksi', compact('order'));
    }
}
