<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Product;
use App\Transaction;
use App\Inventory;
use App\Produksi;
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

    public function index(Request $request) {
        $user = User::all();
        $transaction  = Transaction::where('jenis', 'in')->get();
        $inventory = Inventory::all();
        $tikets = Produksi::all();
        $instansiId = Auth::user()->id;

        
        $order = Order::query();

    
        if (Auth::user()->level == 'customer') {
            $order->whereHas('invoice', function ($query) use ($instansiId) {
                $query->where('id_user', $instansiId);
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

        $year = $request->input('year', Carbon::now()->year); 

        $years = collect(range(0, 9))->map(function ($offset) {
            return Carbon::now()->subYears($offset)->year;
        });

        // Ambil semua bulan untuk labels
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $monthlyPurchases = [];
    
        
        foreach ($months as $month) {
            $purchases = Order::selectRaw('product.name AS product_name, SUM(order.quantity) AS total_quantity')
                ->join('product', 'order.product_id', '=', 'product.id')
                ->where('order.id_user', Auth::user()->id)
                ->whereYear('order.created_at', $year) // Filter berdasarkan tahun yang dipilih
                ->whereMonth('order.created_at', Carbon::parse($month)->month)
                ->groupBy('product.name')
                ->pluck('total_quantity', 'product_name');
        
            $monthlyPurchases[$month] = $purchases->toArray();
        }                     
        return view('dashboard', compact('user','months', 'tikets', 'transaction', 'inventory',  'groupedOrders', 'years', 'brandPurchases', 'monthlyPurchases'));
    }
    
    public function fetchPurchasesByYear(Request $request) {
        $year = $request->input('year');
    
        // Ambil semua bulan untuk labels
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
    
        $monthlyPurchases = [];
    
        foreach ($months as $month) {
            $purchases = Order::selectRaw('product.name AS product_name, SUM(order.quantity) AS total_quantity')
                ->join('product', 'order.product_id', '=', 'product.id')
                ->where('order.id_user', Auth::user()->id)
                ->whereYear('order.created_at', $year) // Filter berdasarkan tahun yang dipilih
                ->whereMonth('order.created_at', Carbon::parse($month)->month)
                ->groupBy('product.name')
                ->pluck('total_quantity', 'product_name');
        
            $monthlyPurchases[$month] = $purchases->toArray();
        }
    
        return response()->json($monthlyPurchases);
    }
    

    public function showChartData(){
        $groupedOrders = Order::with('product')->get()->groupBy('invoice_id');
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

        $years = collect(range(0, 9))->map(function ($offset) {
            return Carbon::now()->subYears($offset)->year;
        });

        $monthlyPurchases = [];

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 
            'November', 'December'
        ];

        $productNames = Order::select('product.name')
            ->join('product', 'order.product_id', '=', 'product.id')
            ->where('order.id_user', Auth::user()->id)
            ->groupBy('product.name')
            ->pluck('product.name');

        foreach ($productNames as $productName) {
            $monthlyPurchases[$productName] = [];
            foreach ($months as $month) {
                $quantity = Order::selectRaw('SUM(order.quantity) AS total_quantity')
                    ->join('product', 'order.product_id', '=', 'product.id')
                    ->where('order.id_user', Auth::user()->id)
                    ->where('product.name', $productName)
                    ->whereMonth('order.created_at', Carbon::parse($month)->month)
                    ->value('total_quantity');
                
                $monthlyPurchases[$productName][$month] = $quantity ?: 0;
            }
        }

        return view('home.chart-data', compact('years', 'months', 'monthlyPurchases'));
    }

}