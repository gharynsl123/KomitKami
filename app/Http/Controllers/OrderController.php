<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Events\OrderUpdated;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Brand;
use App\Order;
use App\Product;
use App\Laporan;
use App\Invoice;
use App\Formula;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        // Mengambil semua order yang tidak dalam status 'reject' atau 'done'
        $orders = Order::whereNotIn('status', ['reject', 'done']);
    
        // Jika pengguna adalah Customer, hanya menampilkan order yang terkait dengan instansinya
        if (Auth::user()->level == 'Customer') {
            $userInstansiId = Auth::user()->id_instansi;
            $orders->where('id_instansi', $userInstansiId);
        }
    
        // Mengelompokkan order berdasarkan invoice
        $groupedOrders = $orders->with('invoice')->get()->groupBy('invoice_id');
    
        // Mengambil satu data order yang pertama dari setiap grup invoice
        $groupedOrders->transform(function ($orders) {
            return $orders->first();
        });
    
        return view('ordering.index-order', compact('groupedOrders'));
    }
    

    function create() {
        $brand = Brand::where('id_instansi', Auth::user()->id_instansi)->get()->all();
        $product = Product::join('brand', 'product.brand_id', '=', 'brand.id')
        ->where('brand.id_instansi', Auth::user()->id_instansi)
        ->select('product.*')
        ->get();

        $orders = Order::all();
        
        return view('ordering.create-order', compact('brand', 'product', 'orders'));
    }

    function store(Request $request) {
        $now = Carbon::now();
        $nowDays = $now->format('dmY');

        $lastOrder = Invoice::latest()->first();

        $counter = 1;
        
        if ($lastOrder) {
            $lastOrderYear = $lastOrder->created_at->year; // Menggunakan metode year() dari objek Carbon

            if ($lastOrderYear != $now->year) {
                $counter = 1;
            } else {
                $lastInvoiceNumber = explode('-', $lastOrder->nomor_invoice)[1];
                $counter = intval($lastInvoiceNumber) + 1;
            }
        }

        $dataInvoice['nomor_invoice'] = $nowDays . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
        $dataInvoice['slug'] = Str::slug($nowDays . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT));
        $dataInvoice['total_harga'] = $request->input('datatotalsemuaharga') ;

        $invoice = Invoice::create($dataInvoice);


        $id_instansi = $request->input('id_instansi');
        $product_id = $request->input('product_id');
        $brand_id = $request->input('brand_id');
        $quantity = $request->input('quantity');
        $total_harga = $request->input('total_harga');
        $catatan = $request->input('catatan');

        $data = [];
        // Looping untuk menyusun data yang akan disimpan
        foreach ($id_instansi as $key => $id_instansi) {
            $data[] = [
                'id_instansi' => $id_instansi,
                'invoice_id' => $invoice->id,
                'product_id' => $product_id[$key],
                'brand_id' => $brand_id[$key],
                'quantity' => $quantity[$key],
                'total_harga' => $total_harga[$key],
                'catatan' => $catatan[$key],
                'created_at' => Carbon::now(),
            ];
        }
    
        Order::insert($data);

        return redirect('/view-order')->with('success', 'berhasil');
    }

    function detail($slug) {
        $invoice = Invoice::where('slug', $slug)->first();
        $orders = Order::where('invoice_id', $invoice->id)->get();
        $orderInformation = Order::where('invoice_id', $invoice->id)->first();
        
        return view('ordering.show-order', compact('invoice', 'orders', 'orderInformation'));
    }


    public function rekapPO(Request $request) {
        $fromMonth = $request->input('fromMonth');
        $toMonth = $request->input('toMonth');
    
        $fromDate = $fromMonth . '-01';
        $toDate = $toMonth . '-31';
    
        $orders = Order::where('created_at', '>=', $fromDate)
                       ->where('created_at', '<=', $toDate)
                       ->get();

        $uniqueProducts = [];

        // Loop melalui semua pesanan
        foreach ($orders as $order) {

            if ($order->status == 'reject') {
                continue;
            }
            
            $productName = $order->product->name;
            $productPrice = $order->product->price;
            $productSlug = $order->invoice->slug;
            $productCode = $order->product->code;
            $quantity = $order->quantity;
            $totalPrice = $productPrice * $quantity;

            // Jika produk sudah ada dalam array, tambahkan jumlah dan total harga
            if (array_key_exists($productName, $uniqueProducts)) {
                $uniqueProducts[$productName]['quantity'] += $quantity;
                $uniqueProducts[$productName]['code'] == $productCode;
                $uniqueProducts[$productName]['slug'] == $productSlug;
                $uniqueProducts[$productName]['price'] == $productPrice;
                $uniqueProducts[$productName]['totalPrice'] += $totalPrice;
            } else {
                // Jika produk belum ada dalam array, tambahkan produk beserta jumlah dan total harga
                $uniqueProducts[$productName] = [
                    'quantity' => $quantity,
                    'code' => $productCode,
                    'slug' => $productSlug,
                    'price' => $productPrice,
                    'totalPrice' => $totalPrice
                ];
            }
        }
    
        return view('ordering.index-rekap', compact('orders', 'uniqueProducts','fromMonth', 'toMonth'));
    }

    public function unpaid(){ 
        $order = Order::query();
        $instansiId = Auth::user()->id_instansi;


        if (Auth::user()->level == 'Customer') {
            $order->whereHas('invoice', function ($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            });
        }
        $invoiceData = $order->with('invoice')->get()->groupBy('invoice_id');
        $invoiceData->transform(function ($order) {
            return $order->first();
        });


        $orderData = null;

        if(Auth::user()->level == 'Customer'){
            $orderData = Order::where('id_instansi', $instansiId)
                  ->where(function($query) {
                      $query->where('status', '!=', 'paid')
                            ->orWhere('status', '!=', 'done');
                  })
                  ->get();

        }else{ 
            $orderData = Order::all();
        }

        return view ('ordering.index-unpaid-po', compact('invoiceData','orderData'));
    }
    
    

    public function changetime(Request $request, $id)
    {
        $order = Invoice::findOrFail($id);
        $dataUpdate = $request->all();

        // Update status menjadi 'accept'
        $order->update($dataUpdate);

        return redirect()->back()->with('success', 'Order has been accepted.');
    }
    public function accept(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $dataAccept = $request->all();
        $dataAccept['status'] = 'accept';
        $dataAccept['estimate_arrive'] =  $request->input('estimate_arrive');;

        $invoice->update($dataAccept);
        $orders = Order::where('invoice_id', $invoice->id)->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'accept']);
        }

        return redirect('/view-order')->with('success', 'Order has been accepted.');
    }

    public function kirimRevisi(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'revisi' => 'required|string|max:255',
        ]);

        // Buat entri revisi baru
        $revisi = new Laporan([
            'isi_laporan' => $request->revisi,
            'type' => $request->type,
            'invoice_id' => $request->invoice_id,
        ]);
        
        // Simpan revisi ke dalam database
        $revisi->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Revisi berhasil dikirim.');
    }

    public function reject($id)
    {
        $invoice = Invoice::find($id);
        $invoice->update(['status' => 'reject']);
        $orders = Order::where('invoice_id', $invoice->id)->get();


        foreach ($orders as $order) {
            $order->update(['status' => 'reject']);
        }
        return redirect('/view-order')->with('success', 'Order has been rejected.');
    }
    
}