@extends('layouts.app')

<style>
.form-select {
    padding: 0.25rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
    border: 1px solid #ddd;
    width: auto;
}
</style>

@section('content')
<div class="card">
    <div class="pb-0 px-3">
        <div class="row mt-3">
            <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Draft Pengiriman</h6>
            </div>
            @if(Auth::user()->level != "customer")
            <div class="col-6 text-end">
                <a class="btn bg-gradient-dark btn-sm mb-0" href="{{url('/buat-devilery')}}"><i
                        class="material-icons text-sm">add</i>&nbsp;&nbsp;tambahkan draft</a>
            </div>
            @endif
        </div>
    </div>
    <div class=" pt-4 p-3">
        @forelse($readyOrders as $invoice_id => $delivery)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between ">
                    <div class="d-flex gap-4">
                        <p><strong>Nomor PO:</strong> {{ $delivery->first()->invoice->nomor_invoice }}</p>
                        <p><strong>Estimasi Sampai:</strong> {{ $delivery->first()->estimate }}</p>
                        @if(Auth::user()->level != "customer")
                        <p><strong>Nama User:</strong> {{ $delivery->first()->order->user->name }}</p>
                        @endif
                    </div>
                    <a href="{{url('/lihat-surat', urlencode($delivery->first()->No_SJ))}}" class="btn btn-primary">lihat surat
                        </a>
                </div>
                <ul class="list-group">
                    @foreach($delivery as $deliverys)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Order ID: {{ $deliverys->order->product->name }}</span>
                        <span>Quantity Ready: {{ $deliverys->quantity }} </span>
                        @php
                        // Ambil nilai kuantitas sebagai integer
                        $quantity = intval($deliverys->quantity);

                        // Bersihkan dan konversi harga produk menjadi float
                        $price = str_replace(['Rp', '.', ','], ['', '', '.'], $deliverys->order->product->price);

                        // Pastikan harga menjadi float
                        $price = floatval($price);

                        // Lakukan perkalian
                        $totalPrice = $quantity * $price;

                        // Format total harga
                        $formattedTotalPrice = number_format($totalPrice, 2, ',', '.');
                        @endphp

                        <span>Harga x QTY : {{$formattedTotalPrice}}</span>

                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @empty
        <p>Tidak ada ready orders yang ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection