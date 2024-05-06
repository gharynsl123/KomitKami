@extends('layouts.app')
@section('title-header', 'Pesanan Pembelian')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Informasi Pemesanan</h6>
                    </div>
                    @if(Auth::user()->level == "Customer")
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark btn-sm mb-0" href="{{url('/buat-order')}}"><i
                                class="material-icons text-sm">add</i>&nbsp;&nbsp;order produk</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    @forelse($groupedOrders->reverse() as $items)
                    @include('widget.list-group')
                    @empty
                    <p class="text-center">No orders waiting for requests</p>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush