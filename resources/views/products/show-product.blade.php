@extends('layouts.app')

@section('content')
<div class="min-vh-77 d-flex align-items-center">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        @if($product->photo)
                        <div class="col-md-12 text-center mb-3">
                            <img src="{{ asset('storage/product_images/'.$product->photo) }}" class="img-fluid"
                                alt="product">
                        </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <p><strong>Code:</strong> {{ $product->code }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Owner:</strong> {{ $product->brand->users->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Created At:</strong> {{ $product->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Price:</strong> {{$product->price}}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><strong>Description:</strong>
                                {{ $product->description ?? 'tidak ada description untuk product ini ' }}</p>
                        </div>
                    </div>
                    <div class="justify-content-center gap-2 d-flex mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <form action="{{ route('products.delete', $product->id) }}" method="post"
                            onsubmit="return confirm('Apakah yakin mau menghapus produk {{ $product->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Buang <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection