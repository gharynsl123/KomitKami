@extends('layouts.app')
@section('title-header', 'Archive')
@section('content')

<div class="col-md-12 mb-lg-0 mb-4">
    <div class="row px-4">
        <div class="col-6 d-flex align-items-center">
            <h5 class="mb-0">Order List</h5>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body p-3">
        <div class="table-responsive p-0">
            <table class="table table-borderless table-hover border border-0 align-items-center mb-0" id="archiveTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nomor PO
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Produk
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Status
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            quantity
                        </th>
                        <th class="text-secondary opacity-7"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $items)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{$items->invoice->nomor_invoice}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{$items->product->name}}</p>
                            <p class="text-xs text-secondary mb-0">{{$items->product->brand->name}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-danger">{{$items->status}}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="">{{$items->quantity}}x </span>
                        </td>

                        <td class="align-middle">
                            <a href="{{url('/order-details/'. $items->invoice->slug)}}"
                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                data-original-title="Edit user">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#archiveTable').DataTable({
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 6,
        "searching": true
    });
    $('[data-toggle="modal"]').click(function() {
        var targetModal = $(this).data('target');
        $(targetModal).modal('show');
    });
});
</script>
@endsection
@push('costum-scripts')
@endpush