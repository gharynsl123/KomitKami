@extends('layouts.app')
@section('title-header', 'Our Brand')
@section('content')
<div class="card p-3">
    <h6 class="mb-4">Create Brand/Merek</h6>

    <form action="{{url('/store-merek')}}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control">

            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="id_instansi" class="form-control" id="exampleFormControlSelect1">
                    <option value="" >-- Pilih Instansi --</option>
                    @foreach($instansi as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class=" btn btn-primary">
                Create
            </button>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
        </div>
        <div class="card my-4 px-4">
            <div class="col-6 d-flex mt-4 align-items-center">
                <h5 class="mb-0">Brands</h5>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                        id="brandsTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Merek</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Instansi</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Terdaftar Pada</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brand as $items)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$items->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$items->instansi->name}}</span>
                                </td>
                                <td class="align-middle">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$items->created_at->format('d/m/Y')}}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{route('edit-merek', $items->id)}}" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#brandsTable').DataTable({
        "info": true,
        "ordering": false,
        "lengthChange": false,
        "pageLength": 5,
        "searching": true
    });
});
</script>
@endsection
@push('custom-scripts')
@endpush