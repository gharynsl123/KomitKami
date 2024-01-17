@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">List Ordering</h6>
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
                        @foreach($order as $items)
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Nomor Invoice : {{$items->nomor_invoice}}</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">{{$items->instansi->name}}</span></span>
                                <span class="mb-2 text-xs">Nomor Telepon: <span
                                        class="text-dark ms-sm-2 font-weight-bold">{{$items->instansi->nomor_telepon}}</span></span>
                                <span class="text-xs mb-2">Catatan Pesanan: <span
                                        class="text-dark ms-sm-2 font-weight-bold">{{$items->catatan}}</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <span class="text-xs ms-auto text-end">status: <span
                                        class="ms-sm-2 badge bg-gradient-secondary font-weight-bold">pending</span></span>
                                @if(Auth::user()->level != 'Customer')
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href=""><i
                                        class="material-icons text-sm me-2">delete</i>rejected</a>
                                <a class="btn btn-link text-success text-gradient px-3 mb-0" href=""><i
                                        class="material-icons text-sm me-2">check</i>approve</a>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection