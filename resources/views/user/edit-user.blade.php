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
                    <option value="Customer" @if($user->level == 'customer') selected @endif>Customer</option>
                    <option value="Production Manager" @if($user->level == 'production manager') selected
                        @endif>Production Manager</option>
                    <option value="Production QC" @if($user->level == 'production qc') selected @endif>Production QC
                    </option>
                    <option value="Marketing Communication" @if($user->level == 'marketing communication') selected
                        @endif>Marketing Communication</option>
                    <option value="Production SPV" @if($user->level == 'production spc') selected @endif>Production
                        SPV</option>
                    <option value="inventory manager" @if($user->level == 'inventory manager') selected @endif>Inventory
                        Manager</option>

                    <option value="Employe" @if($user->level == 'employe') selected @endif>Employe</option>
                    <option value="Admin" @if($user->level == 'admin') selected @endif>Admin</option>
                </select>
            </div>

            <label class="form-label">Password</label>
            <div class="input-group input-group-outline mb-3">
                <input name="password" type="password" class="form-control">
            </div>

        </div>

        <div class="col-md-12">
            <label for="">Address</label>
            <textarea class="form-control border mb-3 px-2" name="address">
                {{$user->address}}
            </textarea>
        </div>

        <div class="col-md-12 gap-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/user-configuration" class="btn btn-outline-secondary">Cancel</a>

        </div>

    </form>

    <!-- Memisahkan form delete dan tombol cancel di luar form update -->
    <div class="d-flex justify-content-end align-items-center">
        <!-- Form Delete -->
        <form action="{{ url('/delete-user', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Delete User</button>
        </form>

    </div>
</div>
@endsection