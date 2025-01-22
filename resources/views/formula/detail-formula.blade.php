@extends('layouts.app')
@section('content')
<style>
.room-container .warp-info {
    max-width: 20rem !important; /* Membatasi lebar */
    word-wrap: break-word; /* Membungkus teks jika lebih panjang */
    word-break: break-word; /* Membuat teks pecah pada kata panjang */
    white-space: normal; /* Memungkinkan pembungkusan teks */
}
</style>
<div class="card p-3">
    <h5>Panduan Produksi {{$product->name}}</h5>
    <p class="small text-danger">*panduan ini berdasarkan perhitungan 1 batch produksi</p>
</div>

<div class="col-lg-auto col-md-auto mt-3">
    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1 active" id="formula-tab" data-bs-toggle="pill"
                    data-bs-target="#formula-content" role="tab" aria-controls="formula-content" aria-selected="true">
                    <span class="ms-1">Formula</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1" id="proses-tab" data-bs-toggle="pill"
                    data-bs-target="#proses-content" role="tab" aria-controls="proses-content" aria-selected="false">
                    <span class="ms-1">Tahapan Proses</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1" id="quality-tab" data-bs-toggle="pill"
                    data-bs-target="#quality-content" role="tab" aria-controls="quality-content" aria-selected="false">
                    <span class="ms-1">Acuan Quality Control</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-0 px-0 py-1" id="quality-tab" data-bs-toggle="pill" data-bs-target="#produk-jadi"
                    role="tab" aria-controls="produk-jadi" aria-selected="false">
                    <span class="ms-1">Hasil Produk Jadi</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="mt-3 tab-content" id="tabContent">
    <div class="tab-pane fade show active card p-3" id="formula-content" role="tabpanel" aria-labelledby="formula-tab">
        <form action="{{url('/store-formula')}}" class="overflow-scroll" id="form-formula" method="post">
            @csrf

            <div class="d-none">
                <input type="text" name="slug" id="slugname">
                <input type="text" name="product_id" value="{{$product->id}}" readonly>
            </div>

            <div class="bahan-baku">
                <div class="const row">
                    <div class="col-md-3">
                        <label class="m-0">Pilih Persediaan Bahan</label>
                        <select name="nama_bahan_baku[]" class="form-control dynamic-select-bahan">
                            <option>-- Pilih persediaan --</option>
                            @foreach($inventory as $row)
                            <option value="{{$row->name}}" data-type="{{$row->type}}" data-id="{{$row->id}}">
                                {{$row->name}} - {{$row->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="inventory_id[]" hidden class="idInvetory">
                    <div class="col-md-3">
                        <label for="" class="m-0">Tipe Persediaan Bahan</label>
                        <input type="text" readonly class="px-2 py-1 form-control border typePersediaan">
                    </div>
                    <div class="col-md-3">
                        <label class="m-0" for="">Nominal Dibutuhkan</label>
                        <input type="text" class="form-control px-2 py-1 border" name="jumlah[]">
                    </div>
                    <div class="col-md-2">
                        <label class="m-0" for="">Satuan</label>
                        <input type="text" readonly name="satuan[]" class="form-control px-2 py-1 border typeSatuan">
                    </div>
                    <div class="text-end col-md-1 d-flex">
                        <button type="button" class="addmultiplealat btn m-0 btn-info">
                            <span class="material-icons">add</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="m-0 btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="btn-cancel-formula" class="m-0 d-none btn btn-danger btn-sm">Batal</button>
            </div>
        </form>

        <div class="d-none" id="warp-formula">
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Nama Bahan Baku</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->formula as $item)
                        <tr>
                            <td>{{ $item->nama_bahan_baku }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->satuan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a id="add-formula" class="btn btn-sm m-0 btn-success">Tambahkan</a>
                <a class="btn-sm m-0 btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
    <div class="tab-pane fade card p-3" id="proses-content" role="tabpanel" aria-labelledby="proses-tab">
        <form action="{{ url('/store-tahapan') }}" method="post">
            @csrf
            <label for="">Simpan Proses Satu persatu</label>
            <textarea name="nama_proses" id="nama_proses" placeholder="Tuliskan Proses"
                class="form-control border px-2 mb-3"></textarea>
            <input type="text" hidden name="product_id" value="{{$product->id}}" readonly>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="m-0 btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-borderless border-0">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Proses</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if($product->tahapanProses->isNotEmpty())
                    @foreach($product->tahapanProses as $items)
                    <tr class="room-container">
                        <td>{{$loop->index + 1}}</td>
                        <td class="warp-info">
                            <p class="m-0 info-proses">
                                {!! nl2br(e($items->nama_proses)) !!}
                            </p>
                            <textarea type="text" name="nama_proses" col="4rem" value="{{$items->nama_proses}}"
                                class="formUbahProses d-none border px-2">{{$items->nama_proses}}</textarea>

                        </td>
                        <td>
                            <button onclick="editItem(this)" class="remove-alat btn btn-sm btn-warning editButton">
                                <span class="material-icons">edit</span>
                            </button>

                            <button class="btn btn-warning btn-sm d-none exitButton">Batal</button>

                            <button class="btn btn-success btn-sm d-none saveButton" data-proses-id="{{ $items->id }}"
                                onclick="saveItem(this)">Simpan</button>

                            <form action="{{ route('tahapanProses.delete', $items->id) }}" method="POST"
                                class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $items->nama_proses }}?')"
                                    class="btn btn-danger btn-sm delete-button">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td>Tidak ada data tahapan proses.</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade card p-3" id="quality-content" role="tabpanel" aria-labelledby="quality-tab">
        <form action="{{url('/store-quality-control')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="m-0" for="nama_proses">Parameter Penguji</label>
                    <input name="parameter_pengujian" id="nama_proses" class="form-control px-2 py-1 border">
                </div>
                <input type="text" hidden name="product_id" value="{{$product->id}}" readonly>
                <div class="col-md-6">
                    <label class="m-0" for="nama_proses">Nilai Standart</label>
                    <input name="nilai_standart" id="nilaiStandart" class="form-control px-2 py-1 border">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="m-0 btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-borderless border-0">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Parameter</td>
                        <td>Nilai Standart</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if($product->qualityControl->isNotEmpty())
                    @foreach($product->qualityControl as $items)
                    <tr class="quality-container">
                        <td>{{$loop->index + 1}}</td>
                        <td>
                            <p class="m-0 info-parameter">
                                {{ $items->parameter_pengujian }}
                            </p>
                            <input type="text" name="parameter_pengujian" value="{{$items->parameter_pengujian}}"
                                class="formUbahParameter d-none border px-2">
                        </td>
                        <td>
                            <p class="m-0 infor-standart">
                                {{ $items->nilai_standart }}
                            </p>
                            <input type="text" name="nilai_standart" value="{{$items->nilai_standart}}"
                                class="formUbahStandart d-none border px-2">
                        </td>
                        <td>
                            <button onclick="editQuality(this)" class="remove-alat btn btn-sm btn-warning editButton">
                                <span class="material-icons">edit</span>
                            </button>

                            <button class="btn btn-warning btn-sm d-none exitButton">Batal</button>

                            <button class="btn btn-success btn-sm d-none saveButton" data-quality-id="{{ $items->id }}"
                                onclick="saveQuality(this)">Simpan</button>

                            <form action="{{ route('qualityControl.delete', $items->id) }}" method="POST"
                                class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $items->parameter_pengujian }}?')"
                                    class="btn btn-danger btn-sm delete-button">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td>Tidak ada data tahapan proses.</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade card p-3" id="produk-jadi" role="tabpanel" aria-labelledby="quality-tab">
        <form action="{{url('/store-acuan-produk-jadi')}}" id="form-produk-jadi" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="m-0" for="nama_proses">Batch Size</label>
                    <div class="input-group mb-3">
                        <input class="form-control px-2 py-1 border " name="size_batch" id="size_batch" value="100">
                        <div class="input-group-append">
                            <span class="input-group-text px-2 py-1 fw-bolder" id="basic-addon2">KG</span>
                        </div>
                    </div>
                </div>
                <input type="text" hidden name="product_id" value="{{$product->id}}" readonly>
                <div class="col-md-6">
                    <label class="m-0" for="nama_proses">Nilai Standart</label>
                    <input name="hasil_acuan" id="nilaiStandart" class="form-control px-2 py-1 border">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="m-0 btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>

        <div id="warp-produk-jadi" class="d-none">
            <div class="row">
                @if($product->produkjadi->isNotEmpty())
                @foreach($product->produkjadi as $items)
                <div class="col-md-5">
                    <input readonly type="text" name="parameter_pengujian" value="{{$items->size_batch}} kg"
                        class="form-control py-1 px-2 border px-2">
                </div>
                <div class="col-md-5">
                    <input readonly type="text" name="nilai_standart" value="{{$items->hasil_acuan}} pcs"
                        class="form-control py-1 px-2 border px-2">
                </div>
                <div class="col-md-2 d-flex gap-2 justify-content-end">
                    <button onclick="editQuality(this)" class="remove-alat btn btn-sm btn-warning editButton">
                        <span class="material-icons">edit</span>
                    </button>

                    <button class="btn btn-warning btn-sm d-none exitButton">Batal</button>

                    <button class="btn btn-success btn-sm d-none saveButton" data-quality-id="{{ $items->id }}"
                        onclick="saveQuality(this)">Simpan</button>

                    <form action="{{ route('qualityControl.delete', $items->id) }}" method="POST"
                        class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $items->parameter_pengujian }}?')"
                            class="btn btn-danger btn-sm delete-button">
                            <span class="material-icons">delete</span>
                        </button>
                    </form>
                </div>
                @endforeach
                @else
                <td>Tidak ada data tahapan proses.</td>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<script>
function addPeralatan() {
    var datamultipleinputalat = `
        <div class="const row mt-3">
            <div class="col-md-3">
                <label for="" class="m-0">Pilih Persediaan Bahan</label>
                <select name="nama_bahan_baku[]" class="form-control dynamic-select-bahan">
                    <option>-- Pilih persediaan --</option>
                    @foreach($inventory as $row)
                    <option value="{{$row->name}}" data-type="{{$row->type}}" data-id="{{$row->id}}">{{$row->name}} - {{$row->type}}</option>
                    @endforeach
                </select>
            </div>
            <input type="text" name="inventory_id[]" hidden class="idInvetory">
            <div class="col-md-3">
                <label for="" class="m-0">Tipe Persediaan Bahan</label>
                <input type="text" readonly class="px-2 py-1 form-control border typePersediaan">
            </div>
            <div class="col-md-3">
                <label class="m-0" for="">Nominal yang Dibutuhkan</label>
                <input type="text" class="form-control px-2 py-1 border" name="jumlah[]">
            </div>
            <div class="col-md-2">
                <label class="m-0" for="">Satuan</label>
                <input type="text" readonly name="satuan[]" class="form-control px-2 py-1 border typeSatuan">
            </div>
            <div class="text-end col-md-1 d-flex">
                <button type="button" class="remove-alat btn btn-danger">
                    <span class="material-icons">remove</span>
                </button>
            </div>
        </div>
    `;
    // Tambahkan elemen baru
    var newElement = $(datamultipleinputalat).appendTo('.bahan-baku');

    // Inisialisasi Select2 hanya untuk elemen yang baru ditambahkan
    newElement.find('.dynamic-select-bahan').select2();
}

function editItem(button) {
    const container = button.closest('.room-container');
    const headText = container.querySelector('.info-proses');
    const inputProses = container.querySelector('.formUbahProses');
    const editButton = container.querySelector('.editButton');
    const simpanButton = container.querySelector('.saveButton');
    const exitButton = container.querySelector('.exitButton');

    headText.classList.add('d-none');
    editButton.classList.add('d-none');
    inputProses.classList.remove('d-none');
    simpanButton.classList.remove('d-none');
    exitButton.classList.remove('d-none');

    exitButton.addEventListener('click', function() {
        headText.classList.remove('d-none');
        editButton.classList.remove('d-none');
        inputProses.classList.add('d-none');
        simpanButton.classList.add('d-none');
        exitButton.classList.add('d-none');
    });
}

function saveItem(button) {
    const container = button.closest('.room-container');
    const prosesId = button.getAttribute('data-proses-id');
    const inputProses = container.querySelector('.formUbahProses');
    const simpanButton = container.querySelector('.saveButton');
    const exitButton = container.querySelector('.exitButton');
    const headText = container.querySelector('.info-proses');
    const editButton = container.querySelector('.editButton');

    const updatedName = inputProses.value;

    if (!updatedName.trim()) {
        alert('Nama ruangan tidak boleh kosong!');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/update-proses/${prosesId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                nama_proses: updatedName
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                headText.textContent = updatedName;
                headText.classList.remove('d-none');
                inputProses.classList.add('d-none');
                simpanButton.classList.add('d-none');
                exitButton.classList.add('d-none');
                editButton.classList.remove('d-none');
            } else {
                alert('Gagal memperbarui nama ruangan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
}

document.addEventListener("DOMContentLoaded", function() {
    const bahanBakuContainer = document.querySelector('.bahan-baku');
    const TamabahFormula = document.getElementById('add-formula');

    const slugInput = document.getElementById('slugname');

    const divFormula = document.getElementById('warp-formula');
    const formulirFormula = document.getElementById('form-formula');

    const divProdukJadi = document.getElementById('warp-produk-jadi');
    const formulirProdukJadi = document.getElementById('form-produk-jadi');
    const products = @json($product);

    if (products.formula && products.formula.length > 0) {
        divFormula.classList.remove('d-none');
        formulirFormula.classList.add('d-none');
    } else {
        divFormula.classList.add('d-none');
        formulirFormula.classList.remove('d-none');
    }

    if (products.produkjadi && products.produkjadi.length > 0) {
        divProdukJadi.classList.remove('d-none');
        formulirProdukJadi.classList.add('d-none');
    } else {
        divProdukJadi.classList.add('d-none');
        formulirProdukJadi.classList.remove('d-none');
    }

    $('#add-formula').on('click', function() {
        $(this).text('Tambah');
        $('#warp-formula').addClass('d-none');
        $('#form-formula').removeClass('d-none');
        $('#btn-cancel-formula').removeClass('d-none');
    });

    $('#btn-cancel-formula').on('click', function() {
        $('#warp-formula').removeClass('d-none');
        $('#form-formula').addClass('d-none');
    });

    if (products) {
        slugInput.value = products.name;
    } else {
        slugInput.value = "Produk tidak ditemukan";
    }

    document.querySelector('.addmultiplealat').addEventListener('click', function() {
        addPeralatan();
    });

    $(bahanBakuContainer).on('click', '.remove-alat', function() {
        $(this).closest('.const').remove();
    });

    $(bahanBakuContainer).on('change', '.dynamic-select-bahan', function() {
        const selectedOption = $(this).find(':selected');
        const inventoryId = selectedOption.data('id');
        const type = selectedOption.data('type');
        $(this).closest('.const').find('.idInvetory').val(inventoryId || '');
        $(this).closest('.const').find('.typePersediaan').val(type || '');

        console.log(inventoryId);
        console.log(type);

        if (type == "Bahan Baku") {
            $(this).closest('.const').find('.typeSatuan').val("gram");
        } else if (type == "Bahan Kemas") {
            $(this).closest('.const').find('.typeSatuan').val("pcs");
        }

        // Debugging untuk memastikan value diinput dengan benar
        const satuanValue = $(this).closest('.const').find('.typeSatuan').val();
        console.log(satuanValue);

    });

    // Inisialisasi Select2 untuk elemen yang sudah ada
    $('.dynamic-select-bahan').select2();
});
</script>
@endsection