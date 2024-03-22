@extends('layouts.app')
@section('title-header', 'Create Bahan Baku')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Create Products</h6>


    <form action="{{url('/store-bahanbaku')}}" class="row" method="post">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Nama Bahan Baku</label>
                <input name="name" type="text" class="form-control">
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
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Nominal yang tersedia</label>
                <input name="stok" type="text" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="satuan" class="form-control" id="exampleFormControlSelect1">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="liter">liter</option>
                    <option value="kilogram">kilogram</option>
                    <option value="pcs">pcs</option>
                    <option value="gram">gram</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
            <a href="/local-inventory" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
@push('custom-scripts')
@endpush