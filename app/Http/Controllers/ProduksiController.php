<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class ProduksiController extends Controller
{
    function index() {
        $order = Order::where('status', 'accept');
        return view('produksi.index-produksi', compact('order'));
    }
}
