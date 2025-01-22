@extends('layouts.app')
@section('title-header', 'Edit Product')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Edit Product</h6>
    <form action="{{ url('/update-product/'.$product->id) }}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label class="m-0">Name</label>
            <div class="input-group mb-3">
                <input name="name" type="text" class="form-control border px-2 py-1" value="{{ $product->name }}">
            </div>
            <label class="m-0">Brand</label>
            <div class="input-group mb-3">
                <select name="brand_id" class="form-control border px-2 py-1" id="exampleFormControlSelect1">
                    @foreach($brand as $row)
                    <option value="{{ $row->id }}" {{ $row->id == $product->brand_id ? 'selected' : '' }}>
                        {{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <label class="m-0">Stok</label>
            <div class="input-group">
                <input name="stok" type="text" class="form-control border px-2 py-1" value="{{ $product->stok }}">
            </div>
            <p class="small">*jika belum ada. maka bisa di lewati dan diisi belakangan</p>
        </div>
        <div class="col-md-6">
            <label class="m-0">Code Product</label>
            <div class="input-group mb-3">
                <input name="code" type="text" class="form-control border px-2 py-1" value="{{ $product->code }}">
            </div>
            <label class="m-0">Harga produk</label>
            <div class="input-group mb-3">
                <input name="price" type="text" class="form-control border px-2 py-1" value="{{ $product->price }}">
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
            <a href="/products" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection