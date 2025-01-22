<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ReadyOrder;
use Carbon\Carbon;
use App\Invoice;
use App\Order;
use App\User;
use PDF;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        // Mengambil semua data dari tabel readyorder dan mengelompokkannya berdasarkan invoice_id
        $readyOrders = ReadyOrder::with('invoice', 'order')
        ->orderBy('No_SJ')
        ->get()
        ->groupBy('No_SJ');

    
        return view('delivery.index-delivery', compact('readyOrders'));
    }
    
    public function create()
    {
        $invoices = Invoice::with(['orders.readyOrders', 'orders.product', 'orders.user'])->get();

        $users = User::where('level', 'Customer')->get();

        foreach ($invoices as $invoice) {
            foreach ($invoice->orders as $order) {
                $totalSent = $order->readyOrders->sum('quantity');
                $order->remaining_quantity = $order->quantity - $totalSent;
            } 
        }

        return view('delivery.create-delivery', compact('invoices', 'users'));
    }

    public function getOrderItems($invoiceId)
    {
        $orders = Order::where('invoice_id', $invoiceId)
        ->with('product', 'brand')
        ->get();

        return response()->json($orders);
    }

    public function addToList(Request $request)
    {
        // Add items to the temporary list (you can store them in session or temporary storage)
        $data = $request->all();
        // Handle adding items to session or another temporary store
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request) {
        $data = $request->all();
        $items = json_decode($data['items'], true);
        $now = Carbon::now();
        $year = $now->format('Y');
    
        $lastOrder = ReadyOrder::latest()->first();
        $counter = 1;
    
        if ($lastOrder) {
            $lastOrderYear = $lastOrder->created_at->year;
    
            if ($lastOrderYear == $now->year) {
                $lastNoSJ = explode('/', $lastOrder->No_SJ);
                if (isset($lastNoSJ[2])) {
                    $counter = intval($lastNoSJ[2]) + 1;
                }
            }
        }
    
        foreach ($items as $item) {
            $No_SJ = "KIG/SJ/" . str_pad($counter, 3, '0', STR_PAD_LEFT) . "/$year";
            $counter++;
    
            // Create ReadyOrder
            ReadyOrder::create([
                'estimate' => $data['estimate_date'],
                'quantity' => $item['quantity'],
                'order_id' => $item['order_id'],
                'No_SJ' => $No_SJ,
                'invoice_id' => $item['invoice_id'],
                'id_user' => $item['user_id'],
            ]);
    
            // Update Order and Product Stock
            $order = Order::with('product')->find($item['order_id']);
            $totalQuantitySent = ReadyOrder::where('order_id', $item['order_id'])->sum('quantity');
    
            if ($order && $order->product) {
                // Update stok produk
                $order->product->decrement('stok', $item['quantity']);
    
                // Hitung remaining quantity
                $remainingQuantity = $order->quantity - $totalQuantitySent;
    
                // Update status order jika semua quantity telah terpenuhi
                if ($remainingQuantity <= 0) {
                    $order->status = 'On The Way';
    
                    // Update status invoice
                    $invoice = Invoice::find($order->invoice_id);
                    if ($invoice) {
                        $invoice->status = 'On The Way';
                        $invoice->save();
                    }
                }
                $order->save();
            }
        }
    
        return redirect()->route('delivery.index')->with('success', 'Delivery data saved successfully.');
    }
    
    
    public function letter($No_SJ) {
        $decodedNo_SJ = urldecode($No_SJ);
        $readyOrders = ReadyOrder::where('No_SJ', $decodedNo_SJ)->get();

        // Render kedua view menjadi HTML
        $html3 = view('delivery.invoice-sales', compact('readyOrders'))->render();
        $html1 = view('delivery.surat-jalan', compact('readyOrders'))->render();
        $html2 = view('delivery.surat-terima-barang', compact('readyOrders'))->render();
        // Gabungkan kedua HTML
        $combinedHtml = $html3 . $html1 . $html2;

    
        // Jika kamu mempunyai view yang sudah disiapkan
        $pdf = PDF::loadHTML($combinedHtml);
    
        // Mengatur nama file PDF yang dihasilkan dan opsi download
        return $pdf->stream('surat-jalan-dan-terima-barang.pdf');
    }
}