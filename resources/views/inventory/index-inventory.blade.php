@extends('layouts.app')
@section('title-header', 'Persedian Bahan Baku / Inventory')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row px-4">
        <div class="card mt-4 px-4 tab-content" id="nav-tabContent">
            <div class="card-body px-0 pb-2 tab-pane fade show active" id="general" role="tabpanel">
                <div class="table-responsive p-0">
                    <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                        id="dataTableDefault">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    nama</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    persediaan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    jenis</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Employed</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventory as $items)
                            <tr class="jenis-{{$items->jenis}}">
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$items->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="mb-0 text-sm">{{$items->stok}}&nbsp;{{$items->satuan}}</h6>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$items->jenis}}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Detail
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

    const tabs = document.querySelectorAll('.nav-link');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const jenis = this.getAttribute('data-jenis');

            // Semua baris di-hide
            const rows = document.querySelectorAll('#dataTableDefault tbody tr');
            rows.forEach(row => {
                row.style.display = 'none';
            });

            // Jika tab yang diklik adalah "General", tampilkan semua baris
            if (jenis === 'general') {
                rows.forEach(row => {
                    row.style.display = '';
                });
            } else {
                // Baris dengan jenis yang sesuai di-show
                const selectedRows = document.querySelectorAll(`.jenis-${jenis}`);
                selectedRows.forEach(row => {
                    row.style.display = '';
                });
            }
        });
    });
});
</script>
@endsection
@push('custom-scripts')
@endpush