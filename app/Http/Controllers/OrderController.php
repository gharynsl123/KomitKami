<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Brand;
use App\Order;
use Carbon\Carbon;
use App\Product;

class OrderController extends Controller
{
    function index() {
        $order = Order::all();
        return view('ordering.index-order', compact('order'));
    }

    function create() {
        $brand = Brand::where('id_instansi', Auth::user()->id_instansi)->get()->all();
        $product = Product::join('brand', 'product.brand_id', '=', 'brand.id')
        ->where('brand.id_instansi', Auth::user()->id_instansi)
        ->select('product.*')
        ->get();
        return view('ordering.create-order', compact('brand', 'product'));
    }

    function store(Request $request) {
        // Hari ini
        $nowDays = Carbon::now()->format('dmY');
        
        // tahun
        $currentYear = Carbon::now()->format('Y');
        
        $lastOrder = Order::whereYear('created_at', $currentYear)
        ->latest()
        ->first();
        
        // Inisialisasi counter
        $counter = 1;
        
        // Jika ada order sebelumnya, increment counter
        if ($lastOrder) {
            $counter = $lastOrder->counter + 1;
        }
        
        $dataStore = $request->all();
        $dataStore['nomor_invoice'] = $nowDays . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);

        Order::create($dataStore);
        return redirect('/view-order')->with('success', 'Order akan segera kami proses');
        
    }
}