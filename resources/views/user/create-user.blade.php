@extends('layouts.app')
@section('title-header', 'Buat User Baru')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Create User</h6>

    <form action="{{url('/store-user')}}" class="row" method="post">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input name="name" type="text" class="form-control" placeholder="Nama">
            </div>
            <div class="input-group input-group-outline mb-3">
                <input name="phone_number" type="number" class="form-control" placeholder="Nomor Telpone">
            </div>
            <div class="input-group input-group-outline mb-3">
                <input name="email" type="email" class="form-control" placeholder="e-mail">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input name="username" type="text" class="form-control" placeholder="UserName">
            </div>
            <div class="input-group input-group-outline mb-3">
                <select name="level" class="form-control" id="exampleFormControlSelect1">
                    <option>-- Pilih Level --</option>
                    <option value="Customer">Customer</option>
                    <option value="Production Manager">Production Manager</option>
                    <option value="Production QC">Production QC</option>
                    <option value="Marketing Communication">Marketing Communication</option>
                    <option value="Production SPV">Production SPV</option>
                    <option value="inventory manager">Inventory Manager</option>
                    <option value="Employe">Employe</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="input-group input-group-outline mb-3">
                <input name="password" type="password" class="form-control" placeholder="password">
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-group input-group-outline mb-3">
                <textarea name="address" type="text" placeholder="address" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
            <a href="/user-configuration" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection