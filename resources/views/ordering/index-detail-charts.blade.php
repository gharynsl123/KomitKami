@extends('layouts.app')

@section('content')
    <p>Pemesanan di bulan {{ $monthName }} dengan produk {{ $product }}</p>

    <div class="card shadow-lg">
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Purchase Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
