@extends('layouts.main-view')
@section('content')
<h1 class="mt-4">Create User</h1>

<div class="card shadow-lg border-0 p-3">
    <form action="#" method="post" class="row">
        @csrf
        <div class="col-md-6 form-group">
            <input type="text" placeholder="name" name="name" id="" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <input type="text" placeholder="Username" name="username" id="" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <input type="email" placeholder="Email" name="email" id="" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <input type="password" placeholder="password" name="password" id="" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <select class="form-select" name="level">
                <option selected>Level</option>
                <option value="Customer">Customer</option>
                <option value="Production Manager">Production Manager</option>
                <option value="Production QC">Production QC</option>
                <option value="Marketing Communication">Marketing Communication</option>
                <option value="Production SPV">Production SPV</option>
                <option value="Employe">Employe</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <div class="col-md-6 form-group">
            <select class="form-select" name="id_instansi">
                <option selected>Pilih Instansi</option>
                @foreach($instansi as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn px-4 btn-primary">Buat</button>
            <a href="/user" class="btn px-4 btn-secondary">cancel</a>
        </div>
    </form>
</div>
@endsection