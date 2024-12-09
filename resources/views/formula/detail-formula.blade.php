@extends('layouts.app')
@section('title-header', 'Detail Formula')
@section('content')
<div class="container-fluid py-4">
    <div class="card p-3">
        <h6>Nama Product: {{ $productName }}</h6>
        <div class="text-dark shadow bg-gray-300 border-radius-lg p-3">
            @foreach($formulas as $formula)
            <div class="d-flex my-3 justify-content-between">
                <p class="m-0 p-0"> Nama Bahan Baku: <span class="h6">
                        {{ $formula->nama_bahan_baku }}
                    </span>
                </p>
                <p class="text-end m-0 p-0 h6">
                    Jumlah: {{ $formula->jumlah }}{{ $formula->satuan }}
                </p>
            </div>
            <hr class="bg-dark p-0 m-0">
            @endforeach
        </div>
    </div>
</div>
@endsection