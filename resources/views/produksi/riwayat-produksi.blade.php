@extends('layouts.app')
@section('content')
<style>
    th {
        text-align: left;
        margin: 0px;
        border:1px !important;
    }
    td {
        text-align: left;
        margin: 0px;
    }
    .table {
        border: 1px solid black; /* Border untuk table */
        border-collapse: collapse; /* Agar tidak ada gap di antaranya */
        margin-bottom:0px;
        border-radius: 10px
    }
    th, td {
        padding:10px !important; 
        border: 1px solid black !important; /* Border untuk tiap cell */
    }
</style>
<div class="d-flex justify-content-between">
    <h4>Riwayat Produksi</h4>
</div>
<div class="card p-3 shadow">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>batch number</th>
                    <th>nama produk</th>
                    <th>size</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tikets->whereIn('status', ['close', 'failed']) as $item)
                <tr>
                    <td>{{ $item->batch_number }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->batch_size }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{url('/mulai-produksi', $item->batch_number)}}" class="btn btn-primary m-0 px-3 py-2">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada Produksi yang selesai</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
