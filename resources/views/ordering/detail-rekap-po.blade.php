@extends('layouts.app')
@section('content')
<a href="{{ route('rekap.po', ['fromMonth' => request()->input('fromMonth'), 'toMonth' => request()->input('toMonth')]) }}" class="btn btn-outline-secondary text-dark text-gradient">Kemabli</a>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered border border-2">
            <thead class="text-uppercase fw-bold">
                <tr>
                    <th>Nama Produk</th>
                    <th>Nomor PO</th>
                    <th>Jumlah</th>
                    <th>Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uniqueProductsWithPO as $productName => $productInfo)
                @foreach ($productInfo['nomor_invoice'] as $index => $poNumber)
                <tr>
                    @if ($index === 0)
                    <td class="text-center" rowspan="{{ count($productInfo['nomor_invoice']) }}">{{ $productName }}</td>
                    @endif
                    <td>{{ $poNumber }}</td>
                    <td>{{ $productInfo['quantity'][$index] }}</td>
                    <td>{{ $productInfo['status'][$index] }}</td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
