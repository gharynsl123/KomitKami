@extends('layouts.app')
@section('content')

<style>
table {
    width: 100%;
    border-collapse: collapse;
    color: #000000;
    margin-top: 1rem;
}

td.label {
    text-align: left;
    padding-right: 10px;
    white-space: nowrap;
    width: 16%;
    font-weight: bold;
}

td.separator {
    text-align: center;
    width: 1%;
}

.nav-tabs .nav-item {
    border-radius: 8px !important;
}
</style>
<div class="card p-2 mb-3">
    <div class="text-center">
        <p class="fw-bold m-0">Catatan Bembuatan Batch Alkessi</p>
        <small>Pemeriksaan Kebersihan</small>
    </div>
    <div class="d-flex table-responsive">
        <!-- poroduksi saat ini -->
        <table class="w-50 border-0">
            <tr>
                <td>
                    Produksi Saat ini
                </td>
            </tr>
            <tr>
                <td class="label">Nama Produk</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->product->name}}</td>
            </tr>
            <tr>
                <td class="label">Kode Produk</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->product->code}}</td>
            </tr>
            <tr>
                <td class="label">Batch Number</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->batch_number}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Produksi</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->tanggal_produksi}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Kadaluarsa</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->tanggal_expired}}</td>

            </tr>
            <tr>
                <td class="label">Batch Size</td>
                <td class="separator">:</td>
                <td>{{$produksiSaatini->batch_size}}</td>
            </tr>
        </table>
        <!-- poroduksi sebelum ini -->
        <table class="w-50 border-0">
            <tr>
                <td>
                    Produksi Sebelum ini
                </td>
            </tr>
            <tr>
                <td class="label">Nama Produk</td>
                <td class="separator">:</td>
                <td>{{$produksiSebelumIni->product->name ?? 'tidak ada'}}</td>
            </tr>
            <tr>
                <td class="label">Batch Number</td>
                <td class="separator">:</td>
                <td>{{$produksiSebelumIni->batch_number ?? 'tidak ada'}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Produksi</td>
                <td class="separator">:</td>
                <td>{{$produksiSebelumIni->tanggal_produksi ?? 'tidak ada'}}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Kadaluarsa</td>
                <td class="separator">:</td>
                <td>{{$produksiSebelumIni->tanggal_expired ?? 'tidak ada'}}</td>

            </tr>
            <tr>
                <td class="label">Batch Size</td>
                <td class="separator">:</td>
                <td>{{$produksiSebelumIni->batch_size ?? 'tidak ada'}}</td>
            </tr>
        </table>
    </div>
</div>

<div class="mb-4">
    <!-- Nav Tabs -->
    <div class="d-flex overflow-auto">
        <ul class="nav nav-tabs border-0 flex-nowrap" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="btn btn-small text-capitalize nav-link text-dark active nowrap-tab" id="kebersihan-tab"
                    data-bs-toggle="tab" data-bs-target="#kebersihan" type="button" role="tab"
                    aria-controls="kebersihan" aria-selected="true">Daftar Periksa Kebersihan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="btn btn-small text-capitalize nav-link text-dark nowrap-tab" id="penimbangan-tab"
                    data-bs-toggle="tab" data-bs-target="#penimbangan" type="button" role="tab"
                    aria-controls="penimbangan" aria-selected="false">Penimbangan Bahan Baku</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="btn btn-small text-capitalize nav-link text-dark nowrap-tab" id="produksi-tab"
                    data-bs-toggle="tab" data-bs-target="#produksi" type="button" role="tab" aria-controls="produksi"
                    aria-selected="false">Pemeriksaan Proses Produksi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="btn btn-small text-capitalize nav-link text-dark nowrap-tab" id="qc-tab"
                    data-bs-toggle="tab" data-bs-target="#qc" type="button" role="tab" aria-controls="qc"
                    aria-selected="false">Pemeriksaan Quality Control</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="btn btn-small text-capitalize nav-link text-dark nowrap-tab" id="rekonsiliasi-tab"
                    data-bs-toggle="tab" data-bs-target="#rekonsiliasi" type="button" role="tab"
                    aria-controls="rekonsiliasi" aria-selected="false">Rekonsiliasi Bahan Kemas</button>
            </li>
        </ul>
    </div>

    <div class="tab-content mt-2" id="myTabContent">
        <!-- Bagian Kebersihan -->
        <div class="tab-pane fade show active" id="kebersihan" role="tabpanel" aria-labelledby="kebersihan-tab">
            <form action="{{url('/store-periksaan-ruangan')}}" method="post">
                @csrf
                @if($pemeriksaanKebersihan->isNotEmpty())
                @foreach($pemeriksaanKebersihan as $ruangProduksiId => $items)
                <div class="card p-3 mb-3">
                    <h4>{{ $items->first()->bagianKebersihan->ruangProduksi->nama_ruangan }}</h4>
                    <div class="table-responsive">
                        <table class="table m-0 p-0">
                            <thead>
                                <tr>
                                    <th>Bagian Yang Dibersihkan</th>
                                    <th>hasil</th>
                                    <th>Di bersihkan Oleh</th>
                                    <th>Diperiksa Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->bagianKebersihan->nama_bagian }}</td>
                                    <td><input type="text" readonly class="form-control border px-2"
                                            value="{{$item->hasil}}"></td>
                                    <td><input type="text" readonly class="form-control border px-2"
                                            value="{{$item->dibersihkan_oleh}}"></td>
                                    <td><input type="text" readonly class="form-control border px-2"
                                            value="{{$item->diperiksa_oleh}}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                @endif

                @if($pemeriksaanKebersihan->isEmpty())
                @foreach ($rooms as $room)
                <div class="card p-3 mb-3">
                    <h4>{{$room->nama_ruangan}}</h4>
                    <div class="table-responsive">
                        @if ($room->items->isNotEmpty())
                        <table class="table m-0 p-0 ">
                            <thead>
                                <tr>
                                    <th>Bagian yang Dibersihkan</th>
                                    <th>Hasil</th>
                                    <th>Di bersihkan Oleh</th>
                                    <th>Diperiksa Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room->items as $item)
                                <tr>
                                    <td>{{$item->nama_bagian}}</td>
                                    <input type="text" name="bagian_kebersihan_id[]" value="{{$item->id}}"
                                        class="d-none">
                                    <td>
                                        <select name="hasil[]" class="border-1 border px-2 form-control" id="">
                                            <option value="Bersih">Bersih</option>
                                            <option value="Kurang Bersih">Kurang Bersih</option>
                                            <option value="Kotor">Kotor</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dibersihkan_oleh[]" class="border-1 border px-2 form-control"
                                            id="">
                                            <option value="">Pilih User</option>
                                            @foreach($users->where('level', 'Producer') as $row)
                                            <option value="{{$row->name}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="diperiksa_oleh[]"
                                            class="border px-2 border-1 form-control">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-muted">Belum ada barang.</p>
                        @endif
                    </div>
                </div>
                @endforeach
                <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">

                <div class="d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-danger">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Terima</button>
                </div>
                @endif
            </form>
        </div>
        <!-- DONE ONE -->

        <!-- Penimbang -->
        <div class="tab-pane fade" id="penimbangan" role="tabpanel" aria-labelledby="penimbangan-tab">
            <form action="{{ url('/store-penimbangan') }}" method="POST">
                @csrf
                @if($pemeriksaanPenimbang->isNotEmpty())
                <div class="card p-3">
                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Bahan Baku</th>
                                    <th>Takaran (gram)</th>
                                    <th>Hasil Timbang (gram)</th>
                                    <th>Operator Penimbangan</th>
                                    <th>SPV Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemeriksaanPenimbang as $item)
                                <tr>
                                    <td>
                                        <input type="text" readonly value="{{$item->formula->nama_bahan_baku}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$item->formula->jumlah}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$item->hasil_timbang}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$item->operator_penimbangan}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$item->spv_produksi}}"
                                            class="border px-2 form-control">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                    </div>
                </div>
                @endif

                @if($pemeriksaanPenimbang->isEmpty())
                <div class="card p-3">
                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Bahan Baku</th>
                                    <th>Takaran (gram)</th>
                                    <th>Hasil Timbang (gram)</th>
                                    <th>Operator Penimbangan</th>
                                    <th>SPV Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penimbanganBahanBaku as $items)
                                @if($items->inventory)
                                <tr>
                                    <td>
                                        <input type="text" readonly value="{{$items->nama_bahan_baku}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td class="d-none">
                                        <input type="text" hidden name="formula_id[]" value="{{$items->id}}">
                                    </td>
                                    <td><input type="number" readonly value="{{$items->jumlah}}"
                                            class="border px-2 form-control"></td>
                                    <td><input type="number" name="hasil_timbang[]" class="border px-2 form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="operator_penimbangan[]"
                                            class="border px-2 form-control" id="">
                                    </td>
                                    <td><input type="text" name="spv_produksi[]" class="border px-2 form-control"></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                @endif
            </form>
        </div>
        <!-- DONE ONE -->

        <!-- proses prpoduksi -->
        <div class="tab-pane fade" id="produksi" role="tabpanel" aria-labelledby="produksi-tab">
            <form action="{{url('/store-proses-produksi')}}" method="post">
                @if($pemeriksaanProsesProduksi->isNotEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Tahapan Proses</td>
                                    <td>Nilai Actual</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemeriksaanProsesProduksi as $items)
                                <tr>
                                    <td>{!! nl2br(e($items->tapahanProses->nama_proses)) !!}</td>
                                    <td>
                                        <input type="text" readonly value="{{$items->keterangan}}" id="actual nilai"
                                            class="form-control px-2 border">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$items->penanggung_jawab}}"
                                            id="actual nilai" class="form-control px-2 border">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($pemeriksaanProsesProduksi->isEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsice">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Tahapan Proses</td>
                                    <td>Nilai Actual</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tahapan as $items)
                                <tr>
                                    <td>{{$items->nama_proses}}</td>
                                    <td>
                                        <input type="text" name="keterangan[]" id="actual nilai"
                                            class="form-control px-2 border">
                                    </td>
                                    <td>
                                        <select name="penanggung_jawab[]" id="PJ" class="form-control px-2 border">
                                            <option value="#">Pilih Penanggung Jawab</option>
                                            @foreach($users->where('level', 'Producer') as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <input type="text" value="{{$items->id}}" hidden name="tahapan_id[]">
                                </tr>
                                @endforeach
                            </tbody>
                            <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @endif
            </form>
        </div>
        <!-- DONE ONE -->

        <!-- Quality Control -->
        <div class="tab-pane fade" id="qc" role="tabpanel" aria-labelledby="qc-tab">
            <form action="{{url('/store-quality-control-check')}}" method="post">
                @if($pemeriksaanQualityControl->isNotEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Parameter Pengujian</td>
                                    <td>Nilai Standart</td>
                                    <td>Nilai Actual</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemeriksaanQualityControl as $items)
                                <tr>
                                    <td>{{$items->qualityControl->parameter_pengujian}}</td>
                                    <td>{{$items->qualityControl->nilai_standart}}</td>
                                    <td>
                                        <input type="text" readonly value="{{$items->nilai_real}}" id="actual nilai"
                                            class="form-control px-2 border">
                                    </td>
                                    <td>
                                        <input type="text" readonly value="{{$items->petugas_qc}}" id="actual nilai"
                                            class="form-control px-2 border">
                                    </td>
                                </tr>
                                @endforeach
                                <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if($pemeriksaanQualityControl->isEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Parameter Pengujian</td>
                                    <td>Nilai Standart</td>
                                    <td>Nilai Actual</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quality as $items)
                                <tr>
                                    <td>{{$items->parameter_pengujian}}</td>
                                    <td>{{$items->nilai_standart}}</td>
                                    <td>
                                        <input type="text" name="nilai_real[]" id="actual nilai"
                                            class="form-control px-2 border">
                                    </td>
                                    <td>
                                        <select name="petugas_qc[]" id="PJ" class="form-control px-2 border">
                                            <option value="#">Pilih Penanggung Jawab</option>
                                            @foreach($users->where('level', 'Producer') as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <input type="text" value="{{$items->id}}" hidden name="quality_id[]">
                                </tr>
                                @endforeach
                                <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
                @endif
            </form>
        </div>

        <!-- rekonsiliasi bahan kemas -->
        <div class="tab-pane fade" id="rekonsiliasi" role="tabpanel" aria-labelledby="rekonsiliasi">
            <form action="{{url('/rekonsiliasa-bahan-kemas')}}" method="post">
                @if($rekonsiliasiBahanKemas->isNotEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsice">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Bahan kemas</td>
                                    <td>Tersedia</td>
                                    <td>Terpakai</td>
                                    <td>keterangan</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekonsiliasiBahanKemas as $item)
                                <tr>
                                    <td>
                                        <input type="text" readonly value="{{$item->formula->nama_bahan_baku}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td><input type="number" readonly value="{{$item->formula->jumlah}}"
                                            class="border px-2 form-control"></td>
                                    <td><input type="terpakai" value="{{$item->terpakai}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td><input type="text" value="{{$item->keterangan}}"
                                            class="border px-2 form-control"></td>
                                    <td><input type="text" value="{{$item->operator}}" class="border px-2 form-control">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($rekonsiliasiBahanKemas->isEmpty())
                <div class="card p-3 mb-3">
                    @csrf
                    <div class="table-responsice">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Bahan kemas</td>
                                    <td>Tersedia</td>
                                    <td>Terpakai</td>
                                    <td>keterangan</td>
                                    <td>Operator</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekonsiliasiBarang as $item)
                                <tr>
                                    <td>
                                        <input type="text" readonly value="{{$item->nama_bahan_baku}}"
                                            class="border px-2 form-control">
                                    </td>
                                    <td class="d-none">
                                        <input type="text" hidden name="formula_id[]" value="{{$item->id}}">
                                    </td>
                                    <td><input type="number" readonly value="{{$item->jumlah}}"
                                            class="border px-2 form-control"></td>
                                    <td><input type="terpakai" name="terpakai[]" class="border px-2 form-control">
                                    </td>
                                    <td><input type="text" name="keterangan[]" class="border px-2 form-control"></td>
                                    <td>
                                        <select name="operator[]" class="border px-2 form-control" id="">
                                            <option value="">Pilih User</option>
                                            @foreach($users->where('level', 'Supervisor') as $row)
                                            <option value="{{$row->name}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                                <input type="text" name="produksi_id" hidden value="{{$produksiSaatini->id}}">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
                @endif
            </form>
        </div>
    </div>

</div>

@if(in_array($produksiSaatini->status, ['done']))
<button class="btn btn-danger w-100" disabled>Produksi {{$produksiSaatini->status}}</button>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pemeriksaanKebersihan = @json($pemeriksaanKebersihan);
    const pemeriksaanPenimbang = @json($pemeriksaanPenimbang);
    const pemeriksaanProsesProduksi = @json($pemeriksaanProsesProduksi);
    const pemeriksaanQualityControl = @json($pemeriksaanQualityControl);
    const rekonsiliasiBahanKemas = @json($rekonsiliasiBahanKemas);
    const produksiSaatini = @json($produksiSaatini);


    if (
        [pemeriksaanKebersihan, pemeriksaanPenimbang, pemeriksaanProsesProduksi, pemeriksaanQualityControl,
            rekonsiliasiBahanKemas
        ]
        .some(item => item && item.length > 0)
    ) {
        window.addEventListener('load', () => {
            const url = `/update-status-done/${produksiSaatini.id}`;

            fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content // Tambahkan CSRF token
                    },
                    body: JSON.stringify({
                        status: 'done'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Status updated:', data);
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        });
    }


    // Default active tab
    let activeTabId = 'kebersihan'; // Default adalah kebersihan

    console.log(pemeriksaanKebersihan);
    console.log(pemeriksaanPenimbang);
    console.log(pemeriksaanProsesProduksi);
    console.log(pemeriksaanQualityControl);
    console.log(rekonsiliasiBahanKemas);

    // Logika menentukan tab mana yang aktif
    if (pemeriksaanKebersihan.length > 0) {
        activeTabId = 'penimbangan';
    }
    if (pemeriksaanPenimbang.length > 0) {
        activeTabId = 'produksi';
    }
    if (pemeriksaanProsesProduksi.length > 0) {
        activeTabId = 'qc';
    }
    if (pemeriksaanQualityControl.length > 0) {
        activeTabId = 'rekonsiliasi';
    }

    if (rekonsiliasiBahanKemas.length > 0) {
        activeTabId = 'rekonsiliasi';
    }

    // Mengatur tab yang aktif berdasarkan logika di atas
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('show', 'active');
    });

    // Aktifkan tab sesuai dengan logika
    document.getElementById(`${activeTabId}-tab`).classList.add('active');
    document.getElementById(activeTabId).classList.add('show', 'active');

    document.getElementById();
});
</script>
@endsection