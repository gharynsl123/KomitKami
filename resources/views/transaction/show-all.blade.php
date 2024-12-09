@extends('layouts.app')
@section('content')
<a href="{{url('/permintaan-material')}}" class="btn btn-secondary">kembali</a>
<div class="card p-3">
    @forelse($permintaan_material as $batch_number => $groupedMaterials)
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <p class="m-0"><strong>Batch Number:</strong> {{ $batch_number }}</p>
            <small class="mb-2">Barang Produksi:
                {{ $groupedMaterials->first()->produksi->product->name ?? 'Tidak ada produk' }}
            </small>
        </div>
        <div class="d-flex">
            @if(Auth::user()->level == 'inventory manager')
            <a href="{{url('/transaction/out')}}" class="text-info mx-2 text-decoration-underline">Proses</a>
            @endif
            <p class="fw-bolder badge badge-dot bg-info">
                {{ $groupedMaterials->first()->persetujuan ?? 'Belum ada status' }}</p>
        </div>
    </div>

    <div class="mb-4 card shadow-sm">
        <div class="p-2 rounded bg-light">
            <h5><strong>Material Yang Di Butuhkan</strong></h5>
            <!-- Mengganti gap-3 dengan g-3 -->
            <div class="row g-3">
                @foreach($groupedMaterials as $index => $item)
                <div class="mb-1 col-md-6 ">
                    <div class="bg-white p-3 rounded">
                        <strong>{{ $item->formula->nama_bahan_baku }}:</strong>
                        {{ $item->formula->jumlah }} {{ $item->formula->satuan }} <br>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @empty
    <p class="text-center m-0">Belum ada data permintaan material.</p>
    @endforelse
</div>
@endsection