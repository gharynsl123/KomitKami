@extends('layouts.app')
@section('title-header', 'Proses Keluar Stok Barang')
@section('content')
<div class="card p-3 mb-3" id="div-form">
    <h6 class="mb-4">Proses Keluar Stok Barang</h6>

    <form action="{{ url('/store-out') }}" method="post" class="row">
        @csrf
        <div class="col-md-6 d-none">
            <div class="input-group input-group-outline mb-3">
                <select name="jenis" class="form-control" id="jenis-tf">
                    <option selected value="out">Barang Keluar</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input type="text" readonly name="id_user" value="{{Auth::user()->id}}" hidden class="form-control">
                <input type="text" readonly value="{{Auth::user()->name}}" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input type="text" readonly name="divisi" value="{{Auth::user()->level}}" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="batch_number" class="form-control" id="batch-number">
                    <option value="">Pilih Nomor Batch</option>
                    @foreach($batches as $batchGroup)
                        @php $firstBatch = $batchGroup->first(); @endphp
                        <option value="{{ $firstBatch->produksi->batch_number }}">{{ $firstBatch->produksi->batch_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered d-none" id="formula-table">
                    <thead>
                        <tr>
                            <th>Nama Bahan Baku</th>
                            <th>Jumlah yang di butuhkan</th>
                            <th class="d-none">Inventory ID</th>
                            <th>Stok Akhir</th>
                            <th>Jumlah yang di ambil</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari AJAX akan diisi di sini -->
                    </tbody>
                </table>
            </div>
        </div> 

        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" id="close-btn" class="btn btn-outline-secondary">Tutup Form</button>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-for-expired-date" tabindex="-1" role="dialog" aria-labelledby="batchNumberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchNumberModalLabel">Detail Batch Number</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nomor Batch</th>
                            <th>Tanggal Expired</th>
                        </tr>
                    </thead>
                    <tbody id="batch-details">
                        <!-- Data batch akan ditambahkan di sini oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="text-end mt-3" style="display:none;" id="create-form">
    <button type="button" class="btn btn-dark">Input Keluar Stok Barang</button>
</div>

@include('widget.table-out')

<script>
document.addEventListener('DOMContentLoaded', function() {
    function showBatchDetails(namaBahanBaku) {
        $.ajax({
            url: '/get-batch-details', // Sesuaikan URL API
            type: 'GET',
            data: { nama_bahan_baku: namaBahanBaku },
            success: function(response) {
                // Kosongkan isi tabel batch-details
                $('#batch-details').empty();

                // Cek apakah ada data batch
                if (response.data && response.data.length > 0) {
                    // Iterasi setiap item dalam response dan tambahkan baris ke tabel
                    $.each(response.data, function(index, item) {
                        $('#batch-details').append(`
                            <tr>
                                <td>${item.no_bach || 'Tidak tersedia'}</td>
                                <td>${item.tanggal_ed || 'Tidak tersedia'}</td>
                            </tr>
                        `);
                    });
                } else {
                    // Jika tidak ada data, tampilkan pesan "Tidak tersedia"
                    $('#batch-details').append(`
                        <tr>
                            <td colspan="2">Data batch tidak tersedia</td>
                        </tr>
                    `);
                }
            },
            error: function() {
                alert('Gagal mengambil data batch.');
            }
        });
    }

    window.showBatchDetails = showBatchDetails; 
    
    $('#batch-number').change(function () {
        var batchNumber = $(this).val();

        if (batchNumber) {
            $.ajax({
                url: '/get-formulas-by-batch/' + batchNumber,
                type: 'GET',
                success: function (response) {
                    if (!response.formulas || response.formulas.length === 0) {
                        alert('No formulas found for this batch number');
                        return;
                    }

                    $('#formula-table').removeClass('d-none');
                    $('#formula-table tbody').empty();

                    $.each(response.formulas, function (index, formula) {
                        var row = `
                        <tr>
                            <td>
                                <a href="#" class="btn m-0" data-bs-toggle="modal" data-bs-target="#modal-for-expired-date" modal="true" onclick="showBatchDetails('${formula.nama_bahan_baku}')">
                                    ${formula.nama_bahan_baku}
                                </a>
                            </td>
                            <td>${formula.jumlah} ${formula.satuan}</td>
                            <td class="d-none">
                                <input type="text" name="inventory_id[]" value="${formula.inventory_id}">
                            </td>
                            <td>${formula.stok_akhir}</td>
                            <td>
                                <input type="number" class="form-control px-2 py-0 border border-1" name="jumlah_barang[]" required>
                            </td>
                            <td><input type="date" class="form-control border border-1 px-2 py-0" name="tanggal_transaksi[]" value="${new Date().toISOString().slice(0, 10)}" readonly></td>
                        </tr>`;

                        $('#formula-table tbody').append(row);
                    });

                    // Event listener untuk link batch
                    $('.batch-link').click(function () {
                        var batchNumber = $(this).data('batch');
                        var expiredDate = $(this).data('expired');
                        
                        // Kosongkan isi batch data sebelumnya
                        $('#batch-data').empty();
                        
                        // Tambahkan informasi batch ke dalam modal
                        var batchRow = `
                        <tr>
                            <td>${batchNumber}</td>
                            <td>:</td>
                            <td>${expiredDate}</td>
                        </tr>`;
                        
                        $('#batch-data').append(batchRow);
                    });
                },
                error: function (e) {
                    alert('error');
                }
            });
        }
    });

    const btnClose = document.getElementById("close-btn");
    const divForm = document.getElementById("div-form");
    const btnOpen = document.getElementById("create-form");

    btnClose.addEventListener('click', function() {
        divForm.style.display = 'none';
        btnOpen.style.display = 'block';
    });

    btnOpen.addEventListener('click', function() {
        divForm.style.display = 'block';
        btnOpen.style.display = 'none';
    });
});
</script>
@endsection