@extends('layouts.app')

@section('content')
    <p class="text-center font-weight-bold">Pemesanan di bulan {{ $monthName }} dengan produk {{ $product }}</p>

    <div class="card shadow-lg">
        <div class="card-header">
            <h5 class="mb-0">Detail Pemesanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-striped mb-0 table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah Pemesanan</th>
                        <th scope="col">Nomor Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                <a href="{{url('/order-details', $order->invoice->slug)}}" class="text-primary">
                                    {{ $order->invoice->nomor_invoice }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{url()->previous()}}" class="mt-3 btn btn-secondary">kembali</a>
    
@endsection
