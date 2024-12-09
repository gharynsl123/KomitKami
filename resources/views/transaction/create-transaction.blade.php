@extends('layouts.app')

@section('title-header', 'Proses input stok barang')
@section('content')
<div class="card p-3 mb-3" id="div-form">
    <h6 class="mb-4">Proses Input stok barang</h6>

    <form action="{{ url('/store-transaction') }}" class="row" method="post">
        @csrf
        <div class="col-md-6 d-none">
            <div class="input-group input-group-outline mb-3">
                <select name="jenis" class="form-control" id="jenis-tf">
                    <option selected value="in">Barang Masuk</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="vendor" class="form-control" id="pilih-vendor">
                    <option value="">Pilih Vendor</option>
                    @foreach($transaction as $row)
                    <option value="{{$row->vendor}}">{{$row->vendor}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input type="text" name="no_invoice" class="form-control" placeholder="Nomor Invoice">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select name="inventory_id" class="form-control" id="select-Bahan-Baku">
                    <option value="">-- Pilih Bahan Baku --</option>
                    @foreach($inventory as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input disabled type="text" id="autopickbk" placeholder="Code Bahan Baku" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input type="text" name="no_bach" class="form-control" placeholder="Nomor Bach">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <input type="number" id="jumlahbarang" name="jumlah_barang" class="form-control"
                    placeholder="Jumlah Barang Masuk">
            </div>
        </div>

        <div class="col-md-6">
            <label class="small">Tanggal Transaksi</label>
            <div class="input-group input-group-outline mb-3">
                <input readonly name="tanggal_transaksi" type="date" id="date" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <label class="small">Tanggal Expired</label>
            <div class="input-group input-group-outline mb-3">
                <input name="tanggal_ed" type="date" id="date" class="form-control">
            </div>
        </div>

        <div class="col-md-12 mb-0">
            <button type="submit" class="btn btn-primary">Buat</button>
            <button type="button" id="close-btn" class="btn btn-outline-secondary">tutup form</button>
        </div>
    </form>
</div>

<div class="text-end mt-3" style="display:none;" id="create-form">
    <button type="button" class="btn btn-dark">Input Stok
        Barang
    </button>
</div>

@include('widget.table-in')

<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk pilih vendor
    $('#pilih-vendor').select2({
        tags: true,
        createTag: function(params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            };
        },
        insertTag: function(data, tag) {
            data.push(tag);
        }
    });

    // Inisialisasi Select2 untuk select bahan baku
    const codeBahan = $('#select-Bahan-Baku');
    codeBahan.select2();

    // Auto-pick kode bahan baku berdasarkan perubahan di Select2
    codeBahan.on('change', function() {
        const selectedInventoryId = $(this).val(); // Ambil nilai dari Select2
        const inventoryData = @json($inventory); // Data inventori dari server
        
        const selectedInventory = inventoryData.find(item => item.id == selectedInventoryId);
        const bahanBaku = document.getElementById("autopickbk"); // Input bahan baku

        if (selectedInventory) {
            bahanBaku.value = selectedInventory.code; // Auto-pick kode bahan baku
        } else {
            bahanBaku.value = "Code Bahan Baku"; // Default jika tidak ditemukan
        }
    });

    // Auto-set tanggal pada input date
    const autoDate = document.getElementById("date");
    autoDate.valueAsDate = new Date();

    // Fungsi untuk membuka/menutup form
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