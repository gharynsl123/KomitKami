@extends('layouts.app')
@section('title-header', 'Buat Formula Baru')
@section('content')
<div class="card shadow p-3">
    <form action="{{url('/store-formula')}}" method="post">
        @csrf
        <div class="row bahan-baku">

            <input type="text" name="slug" readonly hidden id="slugname" class="border form-control">
            <div class="col-md-12 mb-5">
                <div class="input-group input-group-outline">
                    <select name="product_id" class="form-control" id="produkSlect">
                        <option>-- Pilih produk --</option>
                        @foreach($product as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="cosnt p-0 m-0 row col-md-12">
                <div class="col-md-4 mb-3">
                    <div class="input-group input-group-outline">
                        <select name="nama_bahan_baku[]" class="form-control dynamic-select">
                            <option>-- Pilih bahan baku --</option>
                            @foreach($inventory as $row)
                            <option value="{{$row->name}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="input-group input-group-outline">
                        <label class="form-label" for="">Nominal Yang Di butuh kan</label>
                        <input type="text" class="form-control" name="jumlah[]">
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="input-group input-group-outline mb-3">
                        <select name="satuan[]" class="form-control dynamic-select">
                            <option value="">-- Pilih Satuan --</option>
                            <option value="liter">liter</option>
                            <option value="kilogram">kilogram</option>
                            <option value="pcs">pcs</option>
                            <option value="gram">gram</option>
                        </select>
                    </div>
                </div>
                <div class="text-end col-md-1">
                    <button type="button" class="addmultiplealat btn btn-info">
                        <span class="material-icons">add</span>
                    </button>
                </div>
            </div>

        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary">Done</button>
            <a href="/formula" class="btn mx-2 btn-outline-secondary">cancel</a>
        </div>
    </form>
</div>

<script>
function addPeralatan() {
    var datamultipleinputalat = `
                <div class="cosnt p-0 m-0 row col-md-12">
                    <div class="col-md-4 mb-3">
                        <div class="input-group input-group-outline">
                            <select name="nama_bahan_baku[]" class="form-control dynamic-select">
                                <option>-- Pilih bahan baku --</option>
                                @foreach($inventory as $row)
                                <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <input type="text" class="border border-primary px-3 form-control" placeholder="Nominal Yang Di butuh kan" name="jumlah[]">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group input-group-outline mb-3">
                            <select name="satuan[]" class="form-control dynamic-select">
                                <option value="">-- Pilih Satuan --</option>
                                <option value="liter">liter</option>
                                <option value="kilogram">kilogram</option>
                                <option value="pcs">pcs</option>
                                <option value="gram">gram</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end col-md-1 remove-alat">
                        <button type="button" class="btn btn-danger">
                            <span class="material-icons">remove</span>
                        </button>
                    </div>
                </div>
        `;
    $('.bahan-baku').append(datamultipleinputalat);
}

document.addEventListener("DOMContentLoaded", function() {
    const addMoreButton = document.querySelector('.addmultiplealat');
    const produkSelect = document.querySelector('#produkSlect');
    const inputSlug = document.querySelector('#slugname');

    addMoreButton.addEventListener('click', function() {
        addPeralatan();
    });

    $('.bahan-baku').on('click', '.remove-alat', function() {
        $(this).parent().remove();
    });

    produkSelect.addEventListener('input', function() {
        inputSlug.value = produkSelect.options[produkSelect.selectedIndex].text;
    });



});
</script>
@endsection