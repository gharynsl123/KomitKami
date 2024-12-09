@extends('layouts.app')
@section('title-header', 'Persedian Bahan Baku / Inventory')
@section('content')


<div class="mt-4 d-flex align-items-center justify-content-between">
    <form id="filter-form" method="GET" action="{{ url('/local-inventory') }}">
        <div class="card py-2 px-3 border">
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <label class="m-0" for="month">Bulan</label>
                    <select id="month" name="month" class="form-control border py-0 px-3">
                        <option value="">Pilih Bulan</option>
                        @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="me-2">
                    <label class="m-0" for="year">Tahun</label>
                    <select id="year" name="year" class="form-control border py-0 px-3">
                        <option value="">Pilih Tahun</option>
                        @foreach(range(date('Y'), 2000) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn my-0 btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <div class="text-end">
        <a class="btn bg-gradient-dark mb-0" id="btn-create"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah
            Bahan Baku</a>
    </div>
</div>
<div class="card p-3 mt-4" id="form-create" style="display: none;">
    <h6 class="mb-4">Create Products</h6>
    <form action="{{url('/store-bahanbaku')}}" class="row" method="post">
        @csrf
        <div class="col-md-4">
            <div class="input-group input-group-outline mb-3">
                <label for="name" class="form-label">Nama Barang</label>
                <input name="name" id="name" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-outline mb-3">
                <label for="code" class="form-label">Kode Barang</label>
                <input name="code" id="code" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-outline mb-3">
                <label for="stock" class="form-label">Stok Awal</label>
                <input name="stok" id="stock" type="number" class="form-control">
            </div>
        </div>
        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

<div class="table-div">
    <div class="card mt-4 px-4 tab-content" id="nav-tabContent">
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCreate = document.getElementById('btn-create');
    const formCreateItem = document.getElementById('form-create');
    const filterForm = document.getElementById('filter-form');
    const divTable = document.querySelector('.table-div');

    btnCreate.addEventListener('click', function() {
        if (formCreateItem.style.display === 'none') {
            btnCreate.textContent = "Tutup Form";
            formCreateItem.style.display = 'block';
            divTable.style.display = 'none';
            filterForm.style.display = 'none';
        } else {
            btnCreate.textContent = "Tambah Bahan Baku";
            formCreateItem.style.display = 'none';
            divTable.style.display = 'block';
            filterForm.style.display = 'block';
        }
    });
});
</script>
@endsection