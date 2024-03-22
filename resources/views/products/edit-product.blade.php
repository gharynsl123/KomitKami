@extends('layouts.app')
@section('title-header', 'Edit Product')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Edit Product</h6>
    <form action="{{ url('/update-product/'.$product->id) }}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <div class="input-group input-group-static mb-3">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="input-group input-group-static mb-3">
                <label>Brand</label>
                <select name="brand_id" class="form-control" id="exampleFormControlSelect1">
                    @foreach($brand as $row)
                    <option value="{{ $row->id }}" {{ $row->id == $product->brand_id ? 'selected' : '' }}>
                        {{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-static">
                <label>Stok</label>
                <input name="stok" type="text" class="form-control" value="{{ $product->stok }}">
            </div>
            <p class="small">*jika belum ada. maka bisa di lewati dan diisi belakangan</p>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static mb-3">
                <label>Code Product</label>
                <input name="code" type="text" class="form-control" value="{{ $product->code }}">
            </div>
            <div class="input-group input-group-static mb-3">
                <label>Harga produk</label>
                <input name="price" type="number" class="form-control" value="{{ $product->price }}">
            </div>
            <label1>Harga produk</label1>
            <div class="input-group input-group-outline mb-3">
                <input name="photo" type="file" class="form-control">
            </div>
            @if($product->photo)
            <div class="mb-3">
                <img src="{{asset('storage/product_images/'.$product->photo)}}" width="100">
            </div>
            @endif
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