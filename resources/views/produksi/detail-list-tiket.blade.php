@extends('layouts.app')
@section('content')

<div class="d-flex">
    <a href="{{url('/ruang-produksi')}}" class="btn me-3 my-0 btn-secondary">Kembali</a>
    <h4>{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</h4>
</div>

<div class="card mt-3">
    <div class="table-responsive">
        <table class="table m-0 table-striped">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Nomor Batch</th>
                    <th>Batch size</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tikets as $tiket)
                <tr class="">
                    <td>{{ $tiket->product->name }}</td>
                    <td>{{ $tiket->batch_number }}</td>
                    <td>{{ $tiket->batch_size }}</td>
                    <td>{{ $tiket->status }}</td>
                    <td>
                        <a href="{{ url('/detail-produksi', $tiket->batch_number) }}" class="btn m-0 btn-sm btn-outline-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak ada tiket untuk tanggal ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection