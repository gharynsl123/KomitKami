@extends('layouts.app')
@if(Auth::user()->level == 'customer')

@section('title-header', 'Dashboar Member King')
@include('home.costumer')

@elseif(Auth::user()->level == 'marketing communication')

@section('title-header', 'Dashboar Merketinng Communication')
@include('home.markom')

@elseif(in_array(Auth::user()->level, ['production qc', 'production spv']))

@include('produksi.index-produksi')

@elseif(Auth::user()->level == 'inventory manager')

@include('transaction.create-transaction')

@elseif(Auth::user()->level == 'employe')

@include('produksi.list-produksi')

@else

@section('title-header', 'Dashboard')
@section('content')
<div class="row mt-4">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Informasi Pemesanan</h6>
                    </div>

                    @if(Auth::user()->level == 'admin')
                    <div class="col-6 text-end">
                        <a href="{{('/view-order')}}" class="btn btn-outline-primary btn-sm mb-0">Lihat Semua</a>
                    </div> 
                    @endif
                </div>
            </div>
            <div id="orderCard" class="card-body pt-4 p-3">
                <ul class="list-group">
                    @if(Auth::user()->level != 'production manager')
                    @forelse($groupedOrders->where('status' , 'pending')->reverse() as $items)                    
                    @include('widget.list-group')
                    @empty
                    <p class="text-center">Tidak ada pesanan menunggu permintaan</p>
                    @endforelse
                    @else
                    @forelse($groupedOrders->reverse() as $items)                    
                    @include('widget.list-group')
                    @empty
                    <p class="text-center">Tidak ada pesanan menunggu permintaan</p>
                    @endforelse
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@endif