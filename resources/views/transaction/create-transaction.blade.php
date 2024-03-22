@extends('layouts.app')
@section('title-header', 'Pembelian Stok')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Buat Pemesanan stok</h6>

    <form action="{{url('/store-transaction')}}" class="row" method="post">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Instansi --</option>
                    @foreach($instansi as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="brand_id" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Merek --</option>
                    @foreach($merek as $row)
                    <option value="{{$row->id}}">{{$row->name}} - {{$row->instansi->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="jenis" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Jenis --</option>
                    <option value="cair">cair</option>
                    <option value="kering">kering</option>
                    <option value="kemasan">kemasan</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex input-group mb-3">
                <div class="form-control input-group-outline p-0">
                    <input type="text" name="jumlah" class="form-control px-2 border"
                        placeholder="jumlah yang di pesan">
                </div>
                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown">Satuan</button>
                <ul class="dropdown-menu border dropdown-menu-end" name="satuan">
                    <li><a class="dropdown-item" value="liter" href="#">liter</a></li>
                    <li><a class="dropdown-item" value="kilogram" href="#">kilogram</a></li>
                    <li><a class="dropdown-item" value="liter" href="#">pcs</a></li>
                    <li><a class="dropdown-item" value="gram" href="#">gram</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-group input-group-outline mb-3">
                <textarea name="catatan" type="text" placeholder="Catatan PO" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
            <a href="/transaction" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection