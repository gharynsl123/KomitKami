@extends('layouts.app')
@section('title-header', 'Create Product')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Create Products</h6>

    <form action="{{url('/store-products')}}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <select name="brand_id" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Merek --</option>
                    @foreach($brand as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-outline">
                <label class="form-label">Stok</label>
                <input name="stok" type="text" class="form-control">
            </div>
            <p class="small">*jika belum ada. maka bisa di dilewati dan di isi belakangan</p>
        </div>
        <div class="col-md-6">

        <div class="input-group input-group-outline mb-3">
                <label class="form-label">Code Product</label>
                <input name="code" type="text" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Harga produk</label>
                <input name="price" type="number" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Deskripsi</label>
                <input name="description" type="text" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <input name="photo" type="file" class="form-control">
            </div>
        </div>
        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
            <a href="/products" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection