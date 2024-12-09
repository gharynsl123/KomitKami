@extends('layouts.app')

@section('title-header', 'Detail Order')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column w-100">
                            <div class="row">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Ordering Information</h6>
                                        <p class="text-sm">Nomor PO: {{$invoice->nomor_invoice}}</p>
                                    </div>

                                    <div class="text-end">
                                        <div>
                                            <span class="text-xs text-dark mb-2">Status:
                                                <span
                                                    class="text-dark ms-sm-2 font-weight-bold">{{$orderInformation->status}}</span>
                                            </span>
                                        </div>
                                        <span class="text-xs text-dark mb-2">Estimate Arrive:
                                            <span class="text-dark ms-sm-2 font-weight-bold">
                                                {{ $orderInformation->invoice->estimate_arrive ? \Carbon\Carbon::parse($orderInformation->invoice->estimate_arrive)->format('d-F-Y') : '*Belum Ditentukan' }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-0 mb-2">
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Company Name:
                                        <span
                                            class="text-dark font-weight-bold ms-sm-2">{{$orderInformation->user->name}}</span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Nomor Telepon:
                                        <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{$orderInformation->user->nomor_telepon}}</span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Total Barang Yang Dipesan:
                                        <span class="text-dark ms-sm-2 font-weight-bold">{{$orders->count()}}</span>
                                    </span>
                                </div>
                                <div class="mt-5">
                                    <h6 class="mb-1">Items Information</h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Kode</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nama Product</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    QTY</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Harga satuan</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Total Harga</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0 ms-3 text-xs">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-normal mb-0">
                                                        {{$order->product->code ?? 'tidak ada'}}</p>
                                                </td>
                                                <td>
                                                    <h6 class="text-dark text-xs">{{$order->product->name}}</h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">{{$order->quantity}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="me-2 text-xs">{{$order->product->price}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">{{$order->total_harga}}</span>
                                                    </div>
                                                </td>

                                                <td class="align-middle">
                                                    <a href="#" modal="true" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editOrderModal{{ $order->id }}">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="border">
                                            <tr>
                                                <td>Total Harga</td>
                                                <td>:</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>@currency($invoice->total_harga)</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="mt-3">
                    <div class="m-0 p-0">
                        <form action="{{ url('/confirm-laporan/'.$laporan->id) }}" method="post" class="m-0">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Confirmed</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@foreach($orders as $order)
<!-- Modal Edit Order -->
<div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
    aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit {{$order->product->name}}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="quantity">Quantity</label>
                    <div class="input-group mb-3 input-group-outline">
                        <input type="number" id="quantity" name="quantity" class="form-control"
                            value="{{ $order->quantity }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection