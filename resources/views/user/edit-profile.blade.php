@extends('layouts.app')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Edit User</h6>

    <form action="{{ url('/update-user/' . $user->id) }}" class="row" method="post">
        @csrf
        @method('put') {{-- Tambahkan method put untuk update --}}

        <div class="col-md-6">
            <label class="form-label">Name</label>
            <div class="input-group input-group-outline mb-3">
                <input name="name" type="text" class="form-control" value="{{ $user->name }}">
            </div>
            <!-- Sisipkan data lainnya seperti phone_number, email, dan sebagainya -->
            <label class="form-label">Phone Number</label>
            <div class="input-group input-group-outline mb-3">
                <input name="phone_number" value="{{ $user->phone_number}}" type="number" class="form-control">
            </div>
            <label class="form-label">E-mail</label>
            <div class="input-group input-group-outline mb-3">
                <input name="email" value="{{ $user->email}}" type="email" class="form-control">
            </div>
            <label class="form-label">Instansi</label>
            <div class="input-group input-group-outline mb-3">
                <input name="id_instansi" class="form-control" value="{{$user->instansi->id}}" hidden id="exampleFormControlSelect1">
                <input name="" class="form-control" disabled readonly value="{{$user->instansi->name}}">
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">User Name</label>
            <div class="input-group input-group-outline mb-3">
                <input name="username" type="text" class="form-control" value="{{ $user->username }}">
            </div>

            <label class="form-label">Level</label>
            <div class="input-group input-group-outline mb-3">
                <select name="level" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Level --</option>
                    <option value="Customer" @if($user->level == 'Customer') selected @endif>Customer</option>
                    <option value="Production Manager" @if($user->level == 'Production Manager') selected
                        @endif>Production Manager</option>
                    <option value="Production QC" @if($user->level == 'Production QC') selected @endif>Production QC
                    </option>
                    <option value="Seles" @if($user->level == 'Seles') selected
                        @endif>Marketing Communication</option>
                    <option value="Production SPV" @if($user->level == 'Production SPV') selected @endif>Production
                        SPV</option>
                    <option value="Producer" @if($user->level == 'Producer') selected @endif>Producer</option>
                    <option value="Admin" @if($user->level == 'Admin') selected @endif>Admin</option>
                </select>
            </div>

            <label class="form-label">Password</label>
            <div class="input-group input-group-outline mb-3">
                <input name="password" type="password" class="form-control">
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
            <a href="/user-configuration" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection