@extends('layouts.app')
@section('title-header', 'Buat Customer Baru')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Create Customer/ Instansi</h6>

    <form action="{{url('/store-customer')}}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Phone Number</label>
                <input name="nomor_telepon" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-group input-group-outline mb-3">
                <input name="photo" type="file" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3">
                <textarea name="alamat" type="text" placeholder="address" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
            <a href="/customer" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection