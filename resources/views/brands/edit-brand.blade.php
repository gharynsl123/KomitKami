@extends('layouts.app')
@section('title-header', 'Edit Brand')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Edit Brand/Merek</h6>

    <form action="{{ url('/update-merek/'.$brand->id) }}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Gunakan method PUT untuk update --}}
        <div class="col-md-6">
            <div class="input-group input-group-static mb-3">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value="{{ $brand->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static mb-3">
                <label>-- Pilih Instansi --</label>
                <select name="id_user" class="form-control" id="exampleFormControlSelect1">
                    @foreach($user->where('level', 'Customer') as $row)
                    <option value="{{ $row->id }}" {{ $row->id == $brand->id_user ? 'selected' : '' }}>{{ $row->name }}
                    </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </form>
</div>
@endsection