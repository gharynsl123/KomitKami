@extends('layouts.app')
@section('content')

<div class="col-lg-4 col-md-12">
    <div class="nav-wrapper position-relative">
        <ul class="nav nav-pills nav-fill p-1" id="nav-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 active " id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">
                    <i class="material-icons text-lg position-relative">apps</i>
                    <span class="ms-1">By Order Product</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 " id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">
                    <i class="material-icons text-lg position-relative">inbox</i>
                    <span class="ms-1">By Invoice</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="mt-4">
    <div class="card h-100 mb-4">
        <div class="card-header pb-0 px-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-0">Purchase Orders Recap</h6>
                </div>
            </div>
        </div>
        <div class="card-body pt-4 p-3">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-1 text-dark text-sm">action</h6>
                                <div class="d-flex ms-1 flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Nama Product</h6>
                                </div>
                            </div>
                            <h6 class="mb-1 text-dark text-sm">status</h6>
                            <h6 class="mb-1 text-dark text-sm">QTY</h6>
                            <div>
                                <h6 class="mb-1 text-dark text-sm">invoice</h6>
                            </div>
                            <div class="d-flex align-items-center text-sm font-weight-bold">
                                total harga
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group">
                        @foreach($orderData as $items)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <a href="{{url('/order-details/'. $items->invoice->slug)}}" class="btn btn-icon-only btn-rounded btn-outline-success 
                                mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="material-icons text-lg">visibility</i>
                                </a>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{$items->product->name}}</h6>
                                    <span class="text-xs">{{$items->created_at->format('d M Y, H:I A')}}</span>
                                </div>
                            </div>
                            <div class="text-sm m-0">
                                <span class="badge badge-sm bg-info">{{$items->status}}</span>
                            </div>
                            <div>
                                <p class="m-0 text-sm text-bold">{{$items->quantity}}</p>
                            </div>
                            <div>
                                <p class="m-0 text-sm text-bold">{{$items->invoice->nomor_invoice}}</p>
                            </div>
                            <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                @currency($items->total_harga)
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">

                    <ul class="list-group">
                        @forelse($invoiceData->reverse() as $items)
                        @include('widget.list-group')
                        @empty
                        <p class="text-center">No orders waiting for requests</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function {
    $('paymentOrder').DataTable({
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 6,
        "searching": true
    });
})
</script>
@endsection