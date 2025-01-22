@extends('layouts.app')
@section('title-header', 'Produk')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row px-4">
            <div class="col-6 d-flex align-items-center">
                <h5 class="mb-0">Produk Kita</h5>
            </div>
            <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="{{('/create-products')}}"><i
                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Produk Baru</a>
            </div>
        </div>
        <div class="card my-4 px-4">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                        id="dataTableDefault">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kode</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    stok</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Dimiliki oleh</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    harga</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $items)
                            <tr data-href="{{ route('products.show', $items->id) }}" class="clickable-row">
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$items->code}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$items->stok ? $items->stok : '0'}}</p>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$items->name}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$items->brand->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$items->brand->users->name}}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{$items->price}}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{url('/edit-products', $items->id)}}"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                        data-original-title="Edit product">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#productTable').DataTable({
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 6,
        "searching": true
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});
</script>
@endsection