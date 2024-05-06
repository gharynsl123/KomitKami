@extends('layouts.app')
@section('title-header', 'Member KING')
@section('content')
<div class="col-md-12 mb-lg-0">
    <div class="row px-4">
        <div class="col-6 d-flex align-items-center">
            <h5 class="mb-0">Pelanggan Kita</h5>
        </div>
        <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="{{url('/create-customer')}}"><i
                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Pelanggan Baru</a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body p-3">
            <div class="table-responsive p-0">
                <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                    id="dataTableDefault">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Perusahaan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Nomor Telepon</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Alamat</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Terdaftar Pada</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instansi as $items)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    @if($items->photo)
                                    <div>
                                        <img src="{{ asset('storage/instansi_images/'.$items->photo) }}"
                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                    @endif
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$items->name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{$items->nomor_telepon}}</p>
                            </td>
                            <td class="align-middle">
                                <span class="text-secondary text-xs font-weight-bold">{{$items->alamat}}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span
                                    class="text-secondary text-xs font-weight-bold">{{$items->created_at->format('d/m/Y')}}</span>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                    data-toggle="tooltip" data-original-title="Edit user">
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
@endsection
@push('custom-scripts')
@endpush