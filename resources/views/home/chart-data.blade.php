@extends('layouts.app')

@section('content')
<style>
/* Sembunyikan scrollbar di Chrome, Safari, dan Opera */
.table-responsive::-webkit-scrollbar {
    display: none;
}

/* Sembunyikan scrollbar di IE, Edge, dan Firefox */
.table-responsive {
    -ms-overflow-style: none;
    /* IE dan Edge */
    scrollbar-width: none;
    /* Firefox */
}

/* Membuat header tetap di atas */
.table-responsive thead th {
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 1;
}

/* Membuat kolom pertama tetap di tempat */
.table-responsive tbody td:first-child,
.table-responsive thead th:first-child {
    position: sticky;
    left: 0;
    background: #fff;
    z-index: 2;
    /* Tingkatkan z-index untuk kolom pertama */
}

/* Membuat header kolom pertama tetap di tempat */
.table-responsive thead th:first-child {
    z-index: 3;
    /* Tingkatkan z-index lebih tinggi untuk header kolom pertama */
}

.table-responsive,
.card {
    min-height: 25rem;
    max-height: 30rem;
}
</style>

<h1 class="text-center">Data Pembelian Product</h1>
<div class="card p-3">
    <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    @foreach($months as $month)
                    <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($monthlyPurchases as $productName => $purchases)
            <tr>
                <td>{{ $productName }}</td>
                @foreach($months as $month)
                <td>{{ $purchases[$month] }}</td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    <a href="{{url()->previous()}}" class="btn  btn-secondary">kembali</a>
    <a href="{{ route('download.excel') }}" class="btn btn-primary">Download</a>
</div>

@endsection