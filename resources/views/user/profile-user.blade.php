@extends('layouts.main-view')
@section('content')
<h1 class="mt-4">Profile User</h1>

<div class="card shadow-lg mt-4 border-0 p-3">
    <table class="table bg-info table-borderless">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{$user->username}}</td>
        </tr>
        <tr>
            <td>Level</td>
            <td>:</td>
            <td>{{$user->level}}</td>
        </tr>
        <tr>
            <td>nama</td>
            <td>:</td>
            <td>{{$user->name}}</td>
        </tr>
        @if(Auth::user()->level == 'Customer')
        <tr>
            <td>instansi</td>
            <td>:</td>
            <td>{{$user->instansi->name}}</td>
        </tr>
        @endif
    </table>
</div>

@endsection