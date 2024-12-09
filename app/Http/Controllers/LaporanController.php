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

        $history = Laporan::where('invoice_id', $invoice->id)->get();
        return view('laporan.view-laporan', compact('invoice', 'laporan', 'orderInformation', 'history'));
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
    
    public function updateConfirmation(Request $request, $id) {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $order = Order::findOrFail($id);
        $order->quantity = $request->quantity;

        // Hapus pemformatan harga dan ubah menjadi float
        $productPrice = preg_replace('/[^0-9]/', '', $order->product->price);
        $productPriceNumeric = floatval($productPrice);

        $totalHarga = $request->quantity * $productPriceNumeric;
        $order->total_harga = $this->formatRupiah($totalHarga); // Simpan total_harga dengan format
        $order->save();
        
        $invoice = $order->invoice;
        if ($invoice) {
            // Menghitung total_harga dari semua orders tanpa dua angka setelah koma
            $totalHarga = $invoice->orders->sum(function($order) {
                $orderTotalHarga = floatval(preg_replace('/[^0-9]/', '', $order->total_harga));
                // Hapus dua angka terakhir (setelah koma)
                return floor($orderTotalHarga / 100);
            });

            $invoice->total_harga = $totalHarga; // Simpan total_harga tanpa format
            $invoice->save();
        }

        return redirect()->back()->with('success', 'Order updated successfully');
    }

    private function formatRupiah($angka) {
        $angkaStr = (string)$angka;
        $formatted = '';
        
        if (strlen($angkaStr) > 2) {
            $lastTwoDigits = substr($angkaStr, -2);
            $remainingDigits = substr($angkaStr, 0, -2);
            $formatted = number_format($remainingDigits, 0, ',', '.') . ',' . $lastTwoDigits;
        } else {
            $formatted = $angkaStr;
        }
        
        return 'Rp ' . $formatted;
    }



    
}