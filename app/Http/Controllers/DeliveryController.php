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
        // Fetch invoices and orders data
        $invoices = Invoice::with('orders.user')->get();

        $users = User::where('level', 'customer')->get();
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

    public function store(Request $request){
        $data = $request->all();
        $items = json_decode($data['items'], true);
    
        $now = Carbon::now();
        $years = $now->format('Y');
    
        $lastOrder = ReadyOrder::latest()->first();
        $counter = 1;
    
        if ($lastOrder) {
            $lastOrderYear = $lastOrder->created_at->year;
            
            if ($lastOrderYear != $now->year) {
                $counter = 1;
            } else {
                // Cek apakah created_at terakhir sama dengan sekarang
                if ($lastOrder->created_at->format('Y-m-d H:i:s') === $now->format('Y-m-d H:i:s')) {
                    $counter = intval(explode('/', $lastOrder->No_SJ)[2]); // Mempertahankan nomor SJ yang sama
                } else {
                    $noSjParts = explode('/', $lastOrder->No_SJ);
                    if (isset($noSjParts[2])) {
                        $lastletterNumber = $noSjParts[2]; 
                        $counter = intval($lastletterNumber) + 1;
                    } else {
                        $counter = 1; 
                    }
                }
            }
        }
    
        foreach ($items as $item) {
            $No_SJ = 'KIG/SJ/' . str_pad($counter, 3, '0', STR_PAD_LEFT) . '/' . $years;
        
            ReadyOrder::create([
                'estimate' => $data['estimate_date'], 
                'quantity' => $item['quantity'],
                'order_id' => $item['order_id'],
                'No_SJ' => $No_SJ,
                'invoice_id' => $item['invoice_id'],
                'id_user' => $item['user_id'], 
            ]);
        
            $dataOrder = Order::find($item['order_id']); 
        
            // Mengambil invoice yang berhubungan dengan order
            $invoice = Invoice::where('id', $dataOrder->invoice_id)->first();
        
            if ($dataOrder) {
                if ($dataOrder->quantity == $item['quantity']) {
                    $dataOrder->status = 'On The Way';
                    if ($invoice) {
                        $invoice->status = 'On The Way';
                        $invoice->save(); // Pastikan invoice disimpan setelah status diperbarui
                    }
                } else {
                    $dataOrder->quantity -= $item['quantity']; 
                }
                $dataOrder->save(); 
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