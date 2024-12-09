@extends('layouts.app')
@section('content')
<a href="/local-inventory" class="btn btn-dark m-0 btn-small">Kembali</a>
<div>
    <!-- start table INFORMASI -->
    <div class="card mt-3 px-4 tab-content" id="nav-tabContent">
        <div class="card-body px-0 pb-2 tab-pane fade show active" id="general" role="tabpanel">
            <div class="table-responsive p-0">
                <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                    id="dataTableDefault">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Kode Barang</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                stok awal</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                barang masuk</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                barang keluar</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                stok akhir</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventoryData as $item)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $item['name'] }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <h6 class="mb-0 text-sm">{{ $item['code'] }}</h6>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $item['stok_awal'] }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $item['stok_masuk'] }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $item['stok_keluar'] }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $item['stok_akhir'] }}</span>
                            </td>
                            <td class="align-middle">
                                <a href="/local-inventory/detail/{{$item['slug']}}"
                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                    data-original-title="Edit user">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END TABLE INFORMASI BB -->

    <!-- START DETAIL INVENTORY -->
    <div class="col-lg-4 col-md-6 mt-3 ">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active " id="general" role="button" aria-selected="true">
                        <i class="material-icons text-lg position-relative">home</i>
                        <span class="ms-1">general</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1  " id="in" role="button" aria-selected="true">
                        <i class="material-icons text-lg position-relative">home</i>
                        <span class="ms-1">in</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 " id="out" role="button" aria-selected="false">
                        <i class="material-icons text-lg position-relative">email</i>
                        <span class="ms-1">out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mt-3" id="tabContent">
        <div class="row">
            <div class="col-12">
                <div class="card px-4">
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                                id="dataTableDefault">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Penulis</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Informasi Barang</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Barang Masuk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Invoice Bahan Baku</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Batch Bahan Baku</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody id="table-transaction">
                                    @foreach($transaction as $item)
                                    <tr data-jenis="{{ $item->jenis }}">
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if($item->jenis == "out")
                                                <h6 class="mb-0 text-sm">{{ $item->user->name }}</h6>
                                                @else
                                                <h6 class="mb-0 text-sm">{{ $item->vendor }}</h6>
                                                @endif
                                                <p class="text-xs text-secondary mb-0">{{ $item->tanggal_transaksi }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-xs font-weight-bold mb-0">{{ $item->inventory->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $item->inventory->code }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->jumlah_barang }}</span>
                                        </td>
                                        @if($item->jenis == "in")
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$item->no_invoice}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$item->no_bach}}</span>
                                        </td>
                                        @else
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">None</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">None</span>
                                        </td>
                                        @endif

                                        <td class="align-middle">
                                            <form action="{{ url('/delete-item/'.$item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-secondary btn font-weight-bold text-xs delete-link"
                                                    data-toggle="tooltip" data-original-title="Delete item"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
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
    </div>
</div>

<script>
$(document).ready(function() {
    $('.nav-link').on('click', function() {
        $(this).addClass('active');

        // Get the id of the clicked tab
        var filter = $(this).attr('id');

        // Show/Hide rows based on the filter
        if (filter === 'general') {
            $('#table-transaction tr').show();
        } else {
            $('#table-transaction tr').each(function() {
                if ($(this).data('jenis') === filter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
});
</script>
@endsection