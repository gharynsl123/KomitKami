<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Carbon\Carbon;
use App\User;
use App\Order;

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

     public function index() {
        $user = User::all();
        $instansiId = Auth::user()->id_instansi;

        
        $order = Order::query();

    
        if (Auth::user()->level == 'Customer') {
            $order->whereHas('invoice', function ($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            });
        }
    
        $groupedOrders = $order->with('invoice')->get()->groupBy('invoice_id');
        $groupedOrders->transform(function ($order) {
            return $order->first();
        });


        $brandPurchases = [];

        foreach ($groupedOrders as $order) {
            $brandName = $order->product->name;
            if (!isset($brandPurchases[$brandName])) {
                $brandPurchases[$brandName] = 0;
            }
            $brandPurchases[$brandName]++;
        }


        // Ambil semua bulan untuk labels
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::now()->month($month)->monthName;
        });

        $monthlyPurchases = [];
    
        // Loop melalui semua bulan
        foreach ($months as $month) {
            // Ambil data pembelian untuk bulan ini dari database
            $purchases = Order::selectRaw('product.name AS product_name, COUNT(*) AS purchase_count')
                ->join('product', 'order.product_id', '=', 'product.id')
                ->where('id_instansi', Auth::user()->id_instansi)
                ->whereMonth('order.created_at', Carbon::parse($month)->month)
                ->whereYear('order.created_at', Carbon::parse($month)->year)
                ->groupBy('product.name')
                ->pluck('purchase_count', 'product_name');

            // Inisialisasi array untuk menyimpan data pembelian per produk
            $monthlyPurchases[$month] = $purchases->toArray();
        }                
        return view('dashboard', compact('user','months', 'groupedOrders', 'brandPurchases', 'monthlyPurchases'));
    }

}