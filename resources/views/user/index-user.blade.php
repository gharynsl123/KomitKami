@extends('layouts.main-view')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="mt-4">User Configuration</h1>
    <div>
        <a href="{{url('/create-user')}}" class="btn py-2 px-4 btn-primary">Buat User</a>
    </div>
</div>

<div class="card border border-0 shadow-lg p-3 mt-4">
    <div class="table-responsive">
        <table class="table table-hover border border-0 table-borderless" id="myTable">
            <thead>
                <tr class="bg-dark text-white">
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Level User</th>
                    <th>Instansi</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->level}}</td>
                    <td>{{ $item->instansi->name ?? 'tidak ada' }}</td>
                    <td>
                        <div class="rounded badge badge-success">
                            online
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dataTables = document.getElementById("myTable");
    const dataTable = new DataTable(dataTables, {
        "pageLength": 5,
        "lengthChange": false,
        "ordering": false
    });
});
</script>
@endsection