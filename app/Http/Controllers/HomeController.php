<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::join('brand', 'product.brand_id', '=', 'brand.id')
        ->where('brand.id_instansi', Auth::user()->id_instansi)
        ->select('product.*')
        ->get();
        $user = User::all();
        return view('dashboard', compact('product', 'user'));
    }
}