<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Carbon\Carbon;
use PDF;

class PrintController extends Controller
{
    function preorder($slug) {
        $invoice = Invoice::where('slug', $slug)->first();
        $orders = Order::where('invoice_id', $invoice->id)->get();
        $orderInformation = Order::where('invoice_id', $invoice->id)->first();

        $pdf = PDF::loadView('print.print-preorder', ['invoice' => $invoice,'orders' => $orders, 'orderInformation' => $orderInformation]);
        return $pdf->stream('PreOrderDocument.pdf', ['Content-Type' => 'application/pdf']);
    }

    function rekaporder(Request $request) {
        $fromMonth = Carbon::parse($request->input('fromMonth'));
        $toMonth = Carbon::parse($request->input('toMonth'));

        if(Auth::user()->level == 'Customer'){
            $orders = Order::wheredate('created_at', '>=', $fromMonth)
                    ->wheredate('created_at', '<=', $toMonth)
                    ->where('id_user', Auth::user()->id)
                    ->get();
        }else{
            $orders = Order::wheredate('created_at', '>=', $fromMonth)
                    ->wheredate('created_at', '<=', $toMonth)
                    ->get();
        }

        $uniqueProducts = [];

        // Loop melalui semua pesanan
        foreach ($orders as $order) {

            if ($order->status == 'reject') {
                continue;
            }
            
            $productName = $order->product->name;
            $productPriceString = $order->product->price; // Harga produk sebagai string
            $productPrice = (float) str_replace(['Rp ', '.', ], '', $productPriceString); // Menghapus karakter non-numerik dan mengonversi ke float
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

        $uniqueProductsWithPO = [];

        foreach ($orders as $order) {
            if ($order->status == 'reject') {
                continue;
            }

            $productName = $order->product->name;
            $productCode = $order->product->code;
            $productQuantity = $order->quantity;
            $productStatus = $order->status;
            $productPONumber = $order->invoice->nomor_invoice;

            // Jika produk sudah ada dalam array
            if (array_key_exists($productName, $uniqueProductsWithPO)) {
                // Cek apakah nomor invoice sudah ada dalam array
                $index = array_search($productPONumber, $uniqueProductsWithPO[$productName]['nomor_invoice']);
                if ($index !== false) {
                    // Jika nomor invoice sudah ada, tambahkan jumlah dan status ke indeks yang sesuai
                    $uniqueProductsWithPO[$productName]['quantity'][$index] += $productQuantity;
                    $uniqueProductsWithPO[$productName]['status'][$index] = $productStatus;
                } else {
                    // Jika nomor invoice belum ada, tambahkan nomor invoice, jumlah, dan status baru
                    $uniqueProductsWithPO[$productName]['nomor_invoice'][] = $productPONumber;
                    $uniqueProductsWithPO[$productName]['quantity'][] = $productQuantity;
                    $uniqueProductsWithPO[$productName]['status'][] = $productStatus;
                }
            } else {
                $uniqueProductsWithPO[$productName] = [
                    'nomor_invoice' => [$productPONumber],
                    'code' => $productCode,
                    'quantity' => [$productQuantity],
                    'status' => [$productStatus]
                ];
            }
        }

        $pdf = PDF::loadView('print.print-rekap', ['uniqueProducts' => $uniqueProducts, 'uniqueProductsWithPO' => $uniqueProductsWithPO, 'orders' => $orders,'fromMonth' => $fromMonth, 'toMonth' => $toMonth]);
        return $pdf->stream('Rekap Order.pdf' , ['Content-Type' => 'application/pdf']);
    }

    function unpaid() {
        $order = Order::query();
        $instansiId = Auth::user()->id;
        $orderData = null;
        
        if (Auth::user()->level == 'Customer') {
            $order->whereHas('invoice', function ($query) use ($instansiId) {
                $query->where('id_user', $instansiId);
            });
            
            $orderData = Order::where('id_user', $instansiId)
            ->where(function($query) {
                $query->where('status', '!=', 'paid')
                      ->orWhere('status', '!=', 'done');
            })
            ->get();

        }else{ 
            $orderData = Order::all();
        }

        $pdf = PDF::loadView('print.print-unpaind', ['orderData' => $orderData]);
        return $pdf->stream('Unpaid Order Document' , ['Content-Type' => 'application/pdf']);
    }
}
