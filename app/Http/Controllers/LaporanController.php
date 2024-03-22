<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Laporan;
use App\Order;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function view($slug) {
        $invoice = Invoice::where('slug', $slug)->first();
        $laporan = Laporan::where('invoice_id', $invoice->id)
        ->where('status', 'pending')->get()->all();
        $orderInformation = Order::where('invoice_id', $invoice->id)->first();

        return view('laporan.view-laporan', compact('invoice', 'laporan', 'orderInformation'));
    }

    function confirm($id) {
        $laporan = Laporan::find($id);
        $laporan->update(['status' => 'confirm']);
        $invoice = $laporan->invoice;

        $url = '/laporan-pesanan/' . $invoice->slug;

        return redirect($url)->with('success', 'Laporan Telah di confirmasi');
    }

    function confirmRevision($slug) {
        $invoice = Invoice::where('slug', $slug)->first();
        $orders = Order::where('invoice_id', $invoice->id)->get();
        $laporan = Laporan::where('invoice_id', $invoice->id)
        ->where('type', 'ketersedian barang')
        ->where('status', 'pending')->first();
        $orderInformation = Order::where('invoice_id', $invoice->id)->first();
        
        return view('laporan.revisi-order', compact('invoice', 'laporan', 'orders', 'orderInformation'));
    }

    public function updateConfirmation(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->quantity = $request->quantity;
        $order->total_harga = $request->quantity * $order->product->price;
        $order->save();

        // Update total harga invoice
        $invoice = $order->invoice;
        $totalHarga = $order->sum('total_harga');
        $invoice->total_harga = $totalHarga;
        $invoice->save();

        return redirect()->back()->with('success', 'Order updated successfully');
    }
}