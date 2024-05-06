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
                                            {{$orderInformation->instansi->name}}
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
                                            {{$orderInformation->instansi->nomor_telepon}}
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
                                                <a href="{{ url('/confirm-revisi/order/'.$item->invoice->slug) }}" class="p-0 m-0 btn">Confirmed</a>
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
                        Back
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
                                Project</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Budget</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Completion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-slack.svg"
                                            class="avatar avatar-sm rounded-circle me-2">
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-xs">Slack</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-normal mb-0">$1,000</p>
                            </td>
                            <td>
                                <span class="badge badge-dot me-4">
                                    <i class="bg-danger"></i>
                                    <span class="text-dark text-xs">canceled</span>
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-xs">0%</span>
                                </div>
                            </td>

                            <td class="align-middle">
                                <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="material-icons">
                                        more_vert
                                    </span>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-webdev.svg"
                                            class="avatar avatar-sm rounded-circle me-2">
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-xs">Webdev</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-normal mb-0">$14,000</p>
                            </td>
                            <td>
                                <span class="badge badge-dot me-4">
                                    <i class="bg-info"></i>
                                    <span class="text-dark text-xs">working</span>
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-xs">80%</span>
                                </div>
                            </td>

                            <td class="align-middle">
                                <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="material-icons">
                                        more_vert
                                    </span>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-xd.svg"
                                            class="avatar avatar-sm rounded-circle me-2">
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-xs">Adobe XD</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-normal mb-0">$2,300</p>
                            </td>
                            <td>
                                <span class="badge badge-dot me-4">
                                    <i class="bg-success"></i>
                                    <span class="text-dark text-xs">done</span>
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-xs">100%</span>
                                </div>
                            </td>

                            <td class="align-middle">
                                <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="material-icons">
                                        more_vert
                                    </span>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection