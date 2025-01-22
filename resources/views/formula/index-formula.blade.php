@extends('layouts.app')
@section('title-header', 'Formula')
@section('content')
<style>
    .table {
        border: 1px solid black; /* Border untuk table */
        border-collapse: collapse; /* Agar tidak ada gap di antaranya */
        margin-bottom:0px;
        border-radius: 10px
    }
    th, td {
        padding:10px !important; 
        border: 0.5px solid black !important; /* Border untuk tiap cell */
    }
</style>
<h5 class="mb-2">Panduan Produksi All Item</h5>
<div class="card p-3 shadow">
    <div class="table-responsive">
        <table class="table border-0 table-borderless table-hover" id="dataTableDefault">
            <thead>
                <tr>
                    <th>Nama produk</th>
                    <th>Formula</th>
                    <th>Tahapan Proses Produksi</th>
                    <th>Acuan quality produk</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $items)
                <tr>
                    <td>{{$items->name}}</td>
                    <td>
                        @if($items->formula->first())
                        <spand class="badge rounded-pill bg-success">Sudah ada</spand>
                        @else
                        <spand class="badge rounded-pill bg-danger">Belum ada</spand>
                        @endif
                    </td>
                    <td>
                        @if($items->tahapanProses->first())
                        <spand class="badge rounded-pill bg-success">Sudah ada</spand>
                        @else
                        <spand class="badge rounded-pill bg-danger">Belum ada</spand>
                        @endif
                    </td>
                    <td>
                        @if($items->qualityControl->first())
                        <spand class="badge rounded-pill bg-success">Sudah ada</spand>
                        @else
                        <spand class="badge rounded-pill bg-danger">Belum ada</spand>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('detail-formula', $items->id)}}" class="btn m-0 btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection