@extends('layouts.app')
@if(Auth::user()->level == "Customer")

@section('title-header', 'Dashboar Member King')
@include('home.costumer')

@elseif(Auth::user()->level == "Marketing Communication")

@section('title-header', 'Dashboar Merketinng Communication')
@include('home.markom')

@else

@section('title-header', 'Dashboar Admin')
@section('content')
<div class="row mt-4">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Informasi Pemesanan</h6>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{('/view-order')}}" class="btn btn-outline-primary btn-sm mb-0">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div id="orderCard" class="card-body pt-4 p-3">
                <ul class="list-group">
                    @forelse($groupedOrders->where('status' , 'pending')->reverse() as $items)                    
                    @include('widget.list-group')
                    @empty
                    <p class="text-center">Tidak ada pesanan menunggu permintaan</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush
@endif