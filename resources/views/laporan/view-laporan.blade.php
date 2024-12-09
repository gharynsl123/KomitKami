@extends('layouts.app')
@section('title-header', 'Laporan Order')
@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column w-100 ">
                            <div class="row">
                                <div>
                                    <h6 class="mb-1">Ordering Information</h6>
                                    <p class="text-sm">Nomor PO : {{$invoice->nomor_invoice}}</p>
                                </div>
                                <hr class="horizontal dark mt-0 mb-2">
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Company Name:
                                        <span class="text-dark font-weight-bold ms-sm-2">
                                            {{$orderInformation->user->name}}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="text-xs mb-2">Status:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            {{$orderInformation->status}}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="text-xs mb-2">Estimate Arrive:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            {{ $orderInformation->invoice->estimate_arrive ? \Carbon\Carbon::parse($orderInformation->invoice->estimate_arrive)->format('d-F-Y') : '*Belum Ditentukan' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Nomor Telepon:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            {{$orderInformation->user->nomor_telepon}}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Total Harga:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            {{$invoice->total_harga}}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            @if(!empty($laporan))
                            <div class="card mt-3 p-3">
                                <h6>Laporan</h6>
                                <div class="table-responsive">
                                    <table class="table m-0 p-0">
                                        @foreach($laporan as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-normal mb-0">{{ $item->isi_laporan }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-dot me-4">
                                                    <i class="bg-danger"></i>
                                                    <span class="text-dark text-xs">{{ $item->status }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->type != 'ketersedian barang')
                                                <div class="m-0 p-0">
                                                    <form action="{{ url('/confirm-laporan/'.$item->id) }}"
                                                        method="post" class="m-0">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="p-0 btn m-0">Confirmed</button>
                                                    </form>
                                                </div>
                                                @else
                                                <a href="{{ url('/confirm-revisi/order/'.$item->invoice->slug) }}"
                                                    class="p-0 m-0 btn">Confirmed</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </li>
                </ul>
                <div class="d-flex gap-3">
                    <a href="{{url('/order-details/'.$invoice->slug)}}"
                        class="btn text-danger btn-outline-danger text-gradient px-3 mb-0">
                        <i class="material-icons text-sm me-2">arrow_back</i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- history table kalau  -->
        <h4 class="mt-5">History</h4>
        <div class="card ">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                pesan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                jenis laporan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $items)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <h6 class="mb-0">{{$items->isi_laporan}}</h6>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark fw-bolder">{{$items->type}}</span>
                            </td>
                            <td>
                                <span class="badge badge-dot me-4">
                                    <span class="text-dark text-xs">{{$items->status}}</span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection