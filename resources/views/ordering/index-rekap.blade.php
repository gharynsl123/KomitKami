@extends('layouts.app')
@section('title-header', 'Rangkuman Pembelian')
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
                    <h6 class="mb-0">Atur Rentang Rekap</h6>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <form action="{{ route('rekap.po') }}" method="GET">
                <!-- Menentukan rute dan metode HTTP -->
                <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <p class="m-0">Dari</p>
                        <div
                            class="card card-body border card-plain border-radius-lg d-flex align-items-center py-0 px-3 flex-row">
                            <input type="date" id="start_date" name="fromMonth" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-md-0 mb-4">
                        <p class="m-0">Ke</p>
                        <div
                            class="card card-body border card-plain border-radius-lg d-flex align-items-center py-0 px-3 flex-row">
                            <input type="date" id="end_date" name="toMonth" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3 m-0">
                        <button class="btn btn-primary" id="btn-get" type="submit">Cari</button>
                        <a href="{{ route('rekap.print', ['fromMonth' => request()->input('fromMonth'), 'toMonth' => request()->input('toMonth')]) }}" target="_blank" class="btn btn-outline-secondary text-dark text-gradient">Cetak PDF</a>
                        <a href="{{ route('rekap.detail', ['fromMonth' => request()->input('fromMonth'), 'toMonth' => request()->input('toMonth')]) }}" class="btn btn-outline-secondary text-dark text-gradient">Detail Data</a>
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
                id="dataTableDefault">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nama Produk</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Kode Produk</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Harga Produk</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Barang Terkirim</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Dalam Proses</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Total Kuantitas</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Total Harga</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uniqueProducts as $productName => $product)
                    <tr>
                        <td>{{ $productName }}</td>
                        <td>{{ $product['code'] }}</td>
                        <td>@currency($product['price'])</td>
                        <td>{{ $product['shipped'] ?? 0 }}/{{ $product['quantity'] }}</td>
                        <td>{{ $product['inProcess'] ?? 0 }}/{{ $product['quantity'] }}</td>
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
// Mendapatkan elemen input tanggal
const startDateInput = document.getElementById('start_date');
const endDateInput = document.getElementById('end_date');

// Menambahkan event listener untuk memvalidasi tanggal saat input berubah
startDateInput.addEventListener('change', function() {
    // Ambil tanggal dari input tanggal mulai
    const startDate = new Date(startDateInput.value);

    // Set tanggal minimal untuk input tanggal akhir menjadi tanggal awal
    endDateInput.min = startDateInput.value;

    // Jika tanggal akhir yang dipilih kurang dari tanggal awal, atur tanggal akhir menjadi tanggal awal
    if (endDateInput.value && new Date(endDateInput.value) < startDate) {
        endDateInput.value = startDateInput.value;
    }
});

endDateInput.addEventListener('change', function() {
    // Ambil tanggal dari input tanggal akhir
    const endDate = new Date(endDateInput.value);

    // Set tanggal maksimal untuk input tanggal mulai menjadi tanggal akhir
    startDateInput.max = endDateInput.value;

    // Jika tanggal akhir yang dipilih kurang dari tanggal awal, atur tanggal awal menjadi tanggal akhir
    if (startDateInput.value && new Date(startDateInput.value) > endDate) {
        startDateInput.value = endDateInput.value;
    }
});
</script>
@endsection