@extends('layouts.app')
@section('title-header', 'Rekap PO')
@section('content')
<style>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
<div class="col-md-12 mb-lg-0 mb-4">
    <div class="card mt-4">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Atur Jarak Rekapan</h6>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <form action="{{ route('rekap.po') }}" method="GET">
                <!-- Menentukan rute dan metode HTTP -->
                <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <p class="m-0">From</p>
                        <div
                            class="card card-body border card-plain border-radius-lg d-flex align-items-center py-0 px-3 flex-row">
                            <input type="month" name="fromMonth" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-md-0 mb-4">
                        <p class="m-0">To</p>
                        <div
                            class="card card-body border card-plain border-radius-lg d-flex align-items-center py-0 px-3 flex-row">
                            <input type="month" name="toMonth" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3 m-0">
                        <button class="btn btn-primary" id="btn-get" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card mt-4 px-4">
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                id="TransactionTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nama Product</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Code Product</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Product Price</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Jumlah Yang Terkirim</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Dalam Proses</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Total Quantity</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Total Price</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uniqueProducts as $productName => $product)
                    <tr>
                        <td>{{ $productName }}</td>
                        <td>{{ $product['code'] }}</td>
                        <td>@currency($product['price'])</td>
                        <td>{{ $productName }}</td>
                        <td>{{ $productName }}</td>
                        <td>{{ $product['quantity'] }}X</td>
                        <td>@currency($product['totalPrice'])</td>
                        <td>
                            <a href="{{url('/order-details/'. $product['slug'])}}">
                                view
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    $('#TransactionTable').DataTable({
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 6,
        "searching": true
    });
});
</script>
@endsection