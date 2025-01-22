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
                <tr>
                    <td>{{ $tiket->product->name }}</td>
                    <td>{{ $tiket->batch_number }}</td>
                    <td>{{ $tiket->batch_size }}</td>
                    <td>{{ $tiket->status }}</td>
                    <td>
                        @if(in_array($tiket->status, ['done']))
                            <small>Input hasil produk jadi</small>
                            <form action="{{ route('kirim-barang-jadi', $tiket->id) }}" method="post" class="d-flex flex-column">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="produksi_id" value="{{ $tiket->id }}">
                                <input type="text" name="nilai_actual" class="form-control border px-2 py-1">
                                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                            </form>
                        @elseif(in_array($tiket->status, ['close']))
                            <a href="{{url('/mulai-produksi', $tiket->batch_number)}}" class="btn btn-primary m-0 px-3 py-2">detail</a>
                        @else
                            <a href="{{ url('/detail-produksi', $tiket->batch_number) }}" class="btn m-0 btn-sm btn-outline-primary">View</a>
                        @endif
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