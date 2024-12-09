@extends('layouts.app')
@section('content')

<div class="col-lg-6 col-md-12">
    <div class="nav-wrapper position-relative">
        <ul class="nav nav-pills nav-fill p-1" id="nav-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 active " id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">
                    <i class="material-icons text-lg position-relative">apps</i>
                    <span class="ms-1">Berdasarkan Produk</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 " id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">
                    <i class="material-icons text-lg position-relative">inbox</i>
                    <span class="ms-1">Berdasarkan Faktur</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 " id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#product-filters" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">
                    <i class="material-icons text-lg position-relative">inbox</i>
                    <span class="ms-1">Filter Produk</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="mt-4">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0">Rekap Pesanan Pembelian</h6>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('unpaid.print')}}" target="_blank" class="btn btn-outline-secondary text-dark text-gradient">Cetak PDF</a>
        </div>
    </div>
    <div class="card h-100 mb-4">
        <div class="card-body pt-4 p-3">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover border-0" id="dataTableDefault">
                            <thead>
                                <tr>
                                    <th class="text-xxs text-uppercase">action</th>
                                    <th class="text-xxs text-uppercase">Nama Produk</th>
                                    <th class="text-xxs text-uppercase">Status</th>
                                    <th class="text-xxs text-uppercase">Jumlah</th>
                                    <th class="text-xxs text-uppercase">Nomor PO</th>
                                    <th class="text-xxs text-uppercase">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderData as $items)
                                <tr>
                                    <td><a href="{{url('/order-details/'. $items->invoice->slug)}}" class="btn btn-icon-only btn-rounded btn-outline-success 
                                mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="material-icons text-lg">visibility</i>
                                </a></td>
                                    <td><h6 class="mb-1 text-dark text-sm">{{$items->product->name}}</h6>
                                    <span class="text-xs">{{$items->created_at->format('d M Y, H:I A')}}</span></td>
                                    <td>
                                        <span class="badge bg-info text-xxs">
                                            @if($items->status == 'arrived')
                                                an-paid
                                            @else
                                                {{$items->status}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{$items->quantity}}</td>
                                    <td>{{$items->invoice->nomor_invoice}}</td>
                                    <td>{{$items->total_harga}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                <div class="tab-pane fade" id="product-filters" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="d-flex">
                        <div class=" ms-auto">
                            <select name="product" id="filter-products" class="form-select mb-3 border-1 px-2">
                                <option value="">none</option>
                                @foreach($product as $row)
                                <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


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
                    <ul class="list-group" id="product-list">
                        @foreach($byproduct as $items)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <a href="{{url('/order-details/'. $items->invoice->slug)}}" class="btn btn-icon-only btn-rounded btn-outline-success 
                                mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="material-icons text-lg"></i>
                                </a>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{$items->product->name}}</h6>
                                    <span class="text-xs">{{$items->created_at->format('d M Y, H:I A')}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="list-group" id="footer-list">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-1 text-dark text-sm"></h6>
                                <div class="d-flex ms-1 flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Total QTY & Harga :</h6>
                                </div>
                            </div>
                            <h6 class="mb-1 text-dark text-sm"></h6>
                            <h6 class="mb-1 text-dark text-sm" id="total-quantity">0</h6>
                            <div>
                                <h6 class="mb-1 text-dark text-sm"></h6>
                            </div>
                            <div class="d-flex align-items-center text-sm font-weight-bold" id="total-harga">

                            </div>
                        </li>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterSelect = document.getElementById('filter-products');
    const productList = {!! json_encode($byproduct) !!}; // Ubah menjadi objek JavaScript

    filterSelect.addEventListener('change', function() {
        const selectedProduct = this.value;
        const filteredList = selectedProduct ? productList.filter(item => item.product.name === selectedProduct) : productList;
        renderList(filteredList);
    });

    function renderList(list) {
        const listGroup = document.getElementById('product-list');
        listGroup.innerHTML = ''; // Bersihkan isi list

        let totalQuantity = 0;
        let totalHarga = 0;

        list.forEach(item => {
            const createdAt = new Date(item.created_at);
            const formattedDate =
                `${createdAt.getDate()} ${monthNames[createdAt.getMonth()]} ${createdAt.getFullYear()}, ${createdAt.getHours()}:${createdAt.getMinutes()} ${createdAt.getHours() >= 12 ? 'PM' : 'AM'}`;
            const formattedTotalHarga = item.total_harga;

            const listItem = `
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <a href="{{url('/order-details/')}}/${item.invoice.slug}" class="btn btn-icon-only btn-rounded btn-outline-success 
                        mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                            <i class="material-icons text-lg">visibility</i>
                        </a>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">${item.product.name}</h6>
                            <span class="text-xs">${formattedDate}</span>
                        </div>
                    </div>
                    <div class="text-sm m-0">
                        <span class="badge badge-sm bg-info">${item.status}</span>
                    </div>
                    <div>
                        <p class="m-0 text-sm text-bold">${item.quantity}</p>
                    </div>
                    <div>
                        <p class="m-0 text-sm text-bold">${item.invoice.nomor_invoice}</p>
                    </div>
                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                        ${formattedTotalHarga}
                    </div>
                </li>
            `;
            listGroup.insertAdjacentHTML('beforeend', listItem);

            totalQuantity += parseInt(item.quantity);
            totalHarga += parseFloat(item.total_harga.replace(/[Rp\s]/g, '').replace(/\./g, '').replace(',', '.'));
        });

        document.getElementById('total-quantity').textContent = totalQuantity;
        document.getElementById('total-harga').textContent = formatCurrency(totalHarga);
    }

    // Array untuk menyimpan nama bulan
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    }

    renderList(productList);
});
</script>
@endsection