@extends('layouts.app')
@section('content')
<a href="{{url('/ruang-produksi')}}" class="btn btn-secondary">kembali</a>
<div class="card p-3">
    <h3>Detail Data Tiket</h3>

    <!-- Form dimulai dari sini -->
    <form method="POST" action="{{url('/confirm-produksi/'. $produksi['id'])}}">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Batch Number -->
            <div class="col-md-6 mb-3">
                <small for="batch_number">Batch Number</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="batch_number" value="{{ $produksi['batch_number'] }}" >
                </div>
            </div>

            <!-- Batch Size -->
            <div class="col-md-6 mb-3">
                <small for="batch_size">Batch Size</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="batch_size" value="{{ $produksi['batch_size'] }}" readonly>
                </div>
            </div>

            <!-- Tanggal Produksi -->
            <div class="col-md-6 mb-3">
                <small for="tanggal_produksi">Tanggal Produksi</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="tanggal_produksi" value="{{ $produksi['tanggal_produksi'] }}" readonly>
                </div>
            </div>

            <!-- Tanggal Expired -->
            <div class="col-md-6 mb-3">
                <small for="tanggal_expired">Tanggal Expired</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="tanggal_expired" value="{{ $produksi['tanggal_expired'] }}" readonly>
                </div>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <small for="status">Status</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="status" value="{{ $produksi['status'] }}" readonly>
                </div>
            </div>

            <!-- Brand ID -->
            <div class="col-md-6 mb-3">
                <small for="brand_id">Brand</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="brand_id" value="{{ $produksi->product->brand->name }}" readonly>
                </div>
            </div>

            <!-- Invoice ID -->
            <div class="col-md-6 mb-3">
                <small for="invoice_id">Nomor Pesanan</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="invoice_id" value="{{ $produksi->invoice->nomor_invoice ?? '-' }}" readonly>
                </div>
            </div>

            <!-- Product ID -->
            <div class="col-md-6 mb-3">
                <small for="product_id">Product ID</small>
                <div class="input-group-outline input-group">
                    <input type="text" class="form-control" id="product_id" value="{{ $produksi->product->name }}" readonly>
                </div>
            </div>

            <!-- Formula Table -->
            <div class="col-md-6">
                <h4>Formula view</h4>
                <div class="table-responsive">
                    <table class="table table-bordered border-1">
                        <thead>
                            <tr>
                                <th>Nama Bahan Baku/kemas</th>
                                <th>Jumlah di butuhkan</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formula as $item)
                            <tr>
                                <td>{{$item->nama_bahan_baku}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->satuan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($produksi['status'] != "confirm" && Auth::user()->level == "Supervisor")
        <button type="submit" class="btn btn-success">Confirm</button>
        @endif
    </form>
</div>
@endsection