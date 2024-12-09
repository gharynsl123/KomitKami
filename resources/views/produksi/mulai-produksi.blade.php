@extends('layouts.app')
@section('content')

<style>
table {
    width: 100%;
    border-collapse: collapse;
    color: #000000;
    margin-top: 1rem;
}

td.label {
    text-align: left;
    padding-right: 10px;
    white-space: nowrap;
    width: 16%;
    font-weight: bold;
}

td.separator {
    text-align: center;
    width: 1%;
}
</style>
<div class="card p-2">
    <div class="text-center">
        <p class="fw-bold m-0">Catatan Bembuatan Batch Alkessi</p>
        <small>Pemeriksaan Kebersihan</small>
    </div>
    <div class="d-flex">
        <!-- poroduksi saat ini -->
        <table class="w-50 border-0">
            <tr>
                <td>
                    <h6>
                        Current
                    </h6>
                </td>
            </tr>
            <tr>
                <td class="label">Nama Produk</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->product->name}}</td>
            </tr>
            <tr>
                <td class="label">Kode Produk</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->product->code}}</td>
            </tr>
            <tr>
                <td class="label">Batch Number</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->batch_number}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Produksi</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->tanggal_produksi}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Kadaluarsa</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->tanggal_expired}}</td>

            </tr>
            <tr>
                <td class="label">Batch Size</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->batch_size}}</td>
            </tr>
        </table>
        <!-- poroduksi sebelum ini -->
        <table class="w-50">
            <tr>
                <td>
                    <h6>
                        Produksi sebelum ini
                    </h6>
                </td>
            </tr>
            <!-- Do Your Code Here.. -->
        </table>
    </div>
</div>

<div class="text-center mt-3">
    <h4>Daftar Periksa Kebersihan</h4>
</div>

<div class="mb-4">
    <!-- groupbye table ruangan produksi -->
    <!-- Action Pemerikasaan Kebersihan -->
    <form action="{{url('/store-periksaan-ruangan')}}" method="post">
        @csrf
        @foreach ($rooms as $room)
        <div class="card p-3 mb-3">
            <h4>{{$room->nama_ruangan}}</h4>
            <div class="table-responsive">
                <table class="table m-0 p-0 ">
                    <thead>
                        <tr>
                            <th>Bagian yang Dibersihkan</th>
                            <th>Hasil</th>
                            <th>Di bersihkan Oleh</th>
                            <th>Diperiksa Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- item barang -->
                        @if ($room->items->isNotEmpty())
                        @foreach ($room->items as $item)
                        <tr>
                            <td>{{$item->nama_bagian}}</td>
                            <input type="text" name="bagian_kebersihan_id[]" value="{{$item->id}}" class="d-none">
                            <td>
                                <select name="hasil[]" class="border-1 border px-2 form-control" id="">
                                    <option value="Bersih">Bersih</option>
                                    <option value="Kurang Bersih">Kurang Bersih</option>
                                    <option value="Kotor">Kotor</option>
                                </select>
                            </td>
                            <td>
                                <select name="dibersihkan_oleh[]" class="border-1 border px-2 form-control" id="">
                                    <option value="">Pilih User</option>
                                    @foreach($users->where('level', 'employe') as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="diperiksa_oleh[]" class="border px-2 border-1 form-control">
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p class="text-muted">Belum ada barang.</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
        <input type="text" name="produksi_id" class="d-none" value="{{$produksiSaatini->id}}">

        <div class="d-flex gap-2 justify-content-end">
            <button type="submit" class="btn btn-danger">Batalkan</button>
            <button type="submit" class="btn btn-primary">Terima</button>
        </div>
    </form>
</div>
@endsection