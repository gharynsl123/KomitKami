@extends('layouts.app')
@section('title-header', 'Detail Order')
@section('content')
<img src="{{asset('images/logo.png')}}" alt="" style="width:15rem; margin-bottom:1rem;">
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column w-100 ">
                            <div class="row">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Informasi Pemesanan</h6>
                                        <p class="text-sm">Nomor PO : {{$invoice->nomor_invoice}}</p>
                                    </div>

                                    <div class="text-end">
                                        <div>
                                            <span class="text-xs text-dark mb-2">Status:
                                                <span class="text-dark ms-sm-2 font-weight-bold">
                                                    {{$orderInformation->status}}
                                                </span>
                                            </span>
                                        </div>
                                        <span class="text-xs text-dark mb-2">Estimasi Kedatangan:
                                            <span class="text-dark ms-sm-2 font-weight-bold">
                                                {{ $orderInformation->invoice->estimate_arrive ? \Carbon\Carbon::parse($orderInformation->invoice->estimate_arrive)->format('d-F-Y') : '*Belum Ditentukan' }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-0 mb-2">
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Nama Perusahaan:
                                        <span class="text-dark font-weight-bold ms-sm-2">
                                        {{$orderInformation->user->name}}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Nomor Telepon:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                        {{$orderInformation->user->phone_number}}
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <span class="mb-2 text-xs">Total Barang yang Dipesan:
                                        <span class="text-dark ms-sm-2 font-weight-bold">
                                            {{$orders->count()}}
                                        </span>
                                    </span>
                                </div>
                                <div class="mt-5">
                                    <h6 class="mb-1">Informasi Barang</h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nomor</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Kode</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nama Produk</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    status</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Jumlah</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Harga Satuan</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Total Harga</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0 ms-3 text-xs">
                                                        {{ $loop->iteration }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-normal mb-0">
                                                        {{$order->product->code ?? 'tidak ada'}}</p>
                                                </td>
                                                <td>
                                                    <h6 class="text-dark text-xs">{{$order->product->name}}</h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">{{$order->status}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">{{$order->quantity}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="me-2 text-xs">{{$order->product->price}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">{{$order->total_harga}}</span>
                                                    </div>
                                                </td>

                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2 text-xs">
                                                            {{$order->catatan ?? 'tidak Ada'}}

                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="border">
                                            <tr>
                                                <td>Total Harga</td>
                                                <td>:</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>@currency($invoice->total_harga)</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="modal fade" id="modal-for-revisi" tabindex="-1" role="dialog"
                    aria-labelledby="modal-for-revisi-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-for-revisi-label">Kirim Revisi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{url('revisi-order')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label>Revisi</label>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="tag p-2 px-4 btn shadow-none">
                                            <input class="form-check-input" type="radio" name="type"
                                                id="ketersediaan_barang" value="ketersedian barang">
                                            <label class="form-check-label m-0" for="ketersediaan_barang">
                                                Ketersediaan Barang
                                            </label>
                                        </div>
                                        <div class="tag p-2 px-4 btn shadow-none">
                                            <input class="form-check-input" type="radio" name="type" id="proses"
                                                value="proses">
                                            <label class="form-check-label m-0" for="proses">
                                                Proses
                                            </label>
                                        </div>
                                        <div class="tag p-2 px-4 btn shadow-none">
                                            <input class="form-check-input" type="radio" name="type" id="lainnya"
                                                value="lainnya">
                                            <label class="form-check-label m-0" for="lainnya">
                                                Lainnya
                                            </label>
                                        </div>
                                    </div>

                                    <div class="input-group input-group-outline">
                                        <textarea id="revisi" name="revisi" cols="80" class="form-control"></textarea>
                                        <input id="revisi" hidden name="invoice_id" value="{{$order->invoice->id}}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                @if($order->status == 'pending' )
                @if(Auth::user()->level != 'customer')
                <div class="mt-4">
                    <form action="{{ url('/accept-order/' . $invoice->id) }}" style="display:inline;" method="post">
                        @csrf
                        @method('put')
                        <div class="">
                            <div class="row">
                                <h6 class="col-6 mb-1">Input Estimasi Pengiriman</h6>
                                <div class="col-6 text-end">
                                    <span class="text-xs ms-auto ">status: <span
                                            class="ms-sm-2 badge bg-gradient-secondary font-weight-bold">{{$order->status}}</span></span>
                                </div>
                            </div>
                            <div class="input-group row input-group-static my-3">
                                <label>Tanggal</label>
                                <div class="col-md-6">
                                    <input id="estimate" name="estimate_arrive" type="date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <a href="{{url()->previous()}}" class="btn btn-outline-warning text-warning text-gradient px-3 mb-0">
                            <i class="material-icons text-sm me-2">arrow_back</i>
                            Kembali
                        </a>
                        <a href="#" modal="true" class="btn btn-outline-warning text-warning text-gradient px-3 mb-0"
                            data-bs-toggle="modal" data-bs-target="#modal-for-revisi">
                            <i class="material-icons text-sm me-2">task</i>
                            Berikan Laporan
                        </a>
                        <button type="submit" disabled id="acc-btn"
                            class="btn btn-outline-success text-success text-gradient px-3 mb-0">
                            <i class="material-icons text-sm me-2">check</i>Selesai
                        </button>
                    </form>
                </div>
                @endif
                @if(Auth::user()->level == 'customer')
                <a href="{{url()->previous()}}" class="btn mt-2 btn-outline-warning text-warning text-gradient px-3 mb-0">
                    <i class="material-icons text-sm me-2">arrow_back</i>
                    Kembali
                </a>

                @if($invoice->status == 'pending')
                <form action="{{ url('/reject-order/' . $order->invoice->id) }}" style="display:inline;" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" onclick="return confirm('apakah anda yakin ingin membatalakan pesanan ini?')"
                        class="btn btn-outline-danger text-danger text-gradient mt-2 px-3 mb-0">
                        <i class="material-icons text-sm me-2">delete</i>Batalkan Pesanan
                    </button>
                </form>
                @endif

                <a href="{{url('/laporan-pesanan/'. $order->invoice->slug)}}"
                    class="btn mt-2  btn-outline-success text-success text-gradient px-3 mb-0">
                    <i class="material-icons text-sm me-2">task</i>
                    Lihat Laporan
                </a>

                <a href="{{route('po.print', $order->invoice->slug)}}"
                    class="btn mt-2  btn-outline-secondary text-dark text-gradient px-3 mb-0">
                    <i class="material-icons text-sm me-2">task</i>
                    Cetak PO
                </a>

                @endif
                @endif

                <form action="{{ url('/change-time/' . $order->invoice->id) }}" style="display:none;"
                    id="form-estimasi-pengiriman" method="post">
                    @csrf
                    @method('put')
                    <div class="d-flex mb-3 justify-content-center  align-items-center">
                        <h6>Input Estimasi Pengiriman</h6>
                        <div class=" input-group input-group-static my-3">
                            <label>Date</label>
                            <input id="estimate" name="estimate_arrive" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit"
                            class="btn text-end btn-outline-success text-success text-gradient px-3 mb-0">
                            <i class="material-icons text-sm me-2">check</i>Done
                        </button>
                        <a id="cancel-button"
                            class="btn text-end btn-outline-danger text-danger text-gradient px-3 mb-0">
                            <i class="material-icons text-sm me-2">close</i>Cancel
                        </a>
                    </div>
                </form>

                @if($order->status != 'pending' && $order->status != 'reject')
                <div id="tracking-progress">
                    <h6 class="text-center my-5">Tracking Progress Order</h6>
                    <div class="w-100 d-flex justify-content-center align-items-center">
                        <ul class="progress-list">
                            <li id="step1">
                                <i class="icon fas fa-check"></i>
                                <div class="progress one">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">Approving & Estimate</p>
                            </li>
                            <li id="step2">
                                <i class="icon fas fa-cog"></i>
                                <div class="progress two">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">Prosess</p>
                            </li>
                            <li id="step3">
                                <i class="icon fas fa-box"></i>
                                <div class="progress three">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">Packaging</p>
                            </li>
                            <li id="step4">
                                <i class="icon fas fa-truck"></i>
                                <div class="progress four">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">On The Way</p>
                            </li>
                            <li id="step5">
                                <i class="icon fas fa-flag-checkered"></i>
                                <div class="progress five">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">Order Arrived</p>
                            </li>
                            <li id="step6">
                                <i class="icon fas fa-money-bill-wave"></i>
                                <div class="progress five">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text">Order Paid</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{url()->previous()}}" class="btn text-danger btn-outline-danger text-gradient px-3 mb-0">
                        <i class="material-icons text-sm me-2">arrow_back</i>
                        Kembali
                    </a>
                    @if(Auth::user()->level != 'customer')
                    <form action="{{ url('/reject-order/' . $order->invoice->id) }}" style="display:inline;"
                        method="post">
                        @csrf
                        @method('put')
                        <button type="submit"
                            onclick="return confirm('apakah anda yakin ingin membatalakan pesanan ini?')"
                            class="btn btn-outline-danger text-danger text-gradient px-3 mb-0">
                            <i class="material-icons text-sm me-2">delete</i>Batalkan Pesanan
                        </button>
                    </form>
                    <button id="ubah-waktu-button" class="btn text-warning btn-outline-warning text-gradient px-3 mb-0">
                        <i class="material-icons text-sm me-2">access_time</i>
                        Ubah Waktu Datang
                    </button>
                    <a href="#" modal="true" class="btn btn-outline-warning text-warning text-gradient px-3 mb-0"
                        data-bs-toggle="modal" data-bs-target="#modal-for-revisi">
                        <i class="material-icons text-sm me-2">task</i>
                        Berikan Laporan
                    </a>
                    @endif
                    @if(Auth::user()->level == 'customer')
                    <a href="{{url('/laporan-pesanan/'. $order->invoice->slug)}}"
                        class="btn btn-outline-success text-success text-gradient px-3 mb-0">
                        <i class="material-icons text-sm me-2">task</i>
                        Lihat Laporan
                    </a>
                    @endif
                    <a href="{{route('po.print', $order->invoice->slug)}}"
                        class="btn btn-outline-secondary text-dark text-gradient px-3 mb-0">
                        <i class="material-icons text-sm me-2">task</i>
                        Cetak PO
                    </a>

                </div>

                @endif


                @if($order->status == 'reject')
                <h6 class="text-center my-5">Kamu Membatalkan Pesanan ini.
                    jika ingin kamu bisa memesann lagi</h6>
                <a href="{{url()->previous()}}" class="btn text-danger btn-outline-danger text-gradient px-3 mb-0">
                    <i class="material-icons text-sm me-2">arrow_back</i>
                    Kembali
                </a>
                @endif
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener("DOMContentLoaded", function() {
    const ubahWaktuButton = document.querySelector('#ubah-waktu-button');
    const formEstimasiPengiriman = document.querySelector('#form-estimasi-pengiriman');
    const trackingProgress = document.querySelector('#tracking-progress');
    const cancelButton = document.querySelector('#cancel-button');

    const step1 = document.getElementById("step1");
    const step2 = document.getElementById("step2");
    const step3 = document.getElementById("step3");
    const step4 = document.getElementById("step4");
    const step5 = document.getElementById("step5");
    const step6 = document.getElementById("step6");
    const estimateInput = document.getElementById('estimate');
    const accBtn = document.getElementById('acc-btn');
    const order = @json($invoice);

    if (order.status === "accept") {
        step1.classList.add("active");
        step2.classList.remove("active");
        step3.classList.remove("active");
        step4.classList.remove("active");
        step5.classList.remove("active");
        step6.classList.remove("active");
    } else if (order.status === "process") {
        step1.classList.add("active");
        step2.classList.add("active");
        step3.classList.remove("active");
        step4.classList.remove("active");
        step5.classList.remove("active");
        step6.classList.remove("active");
    } else if (order.status === "packaging") {
        step1.classList.add("active");
        step2.classList.add("active");
        step3.classList.add("active");
        step4.classList.remove("active");
        step5.classList.remove("active");
        step6.classList.remove("active");
    } else if (order.status === "On The Way") {
        step1.classList.add("active");
        step2.classList.add("active");
        step3.classList.add("active");
        step4.classList.add("active");
        step5.classList.remove("active");
        step6.classList.remove("active");
    } else if (order.status === "arrived") {
        step1.classList.add("active");
        step2.classList.add("active");
        step3.classList.add("active");
        step4.classList.add("active");
        step5.classList.add("active");
        step6.classList.remove("active");
    } else if (order.status === "done") {
        step1.classList.add("active");
        step2.classList.add("active");
        step3.classList.add("active");
        step4.classList.add("active");
        step5.classList.add("active");
        step6.classList.add("active");
    };

    estimateInput.addEventListener('input', function() {
        // Periksa apakah input date telah diisi
        const isDateFilled = estimateInput.value !== '';

        // Aktifkan atau nonaktifkan tombol berdasarkan hasil pemeriksaan
        accBtn.disabled = !isDateFilled;
    });

    ubahWaktuButton.addEventListener('click', function() {
        // Tampilkan formulir
        formEstimasiPengiriman.style.display = 'block';
        // Sembunyikan tracking progress
        trackingProgress.style.display = 'none';
        ubahWaktuButton.style.display = 'none';
    });

    cancelButton.addEventListener('click', function() {

        // Tampilkan formulir
        formEstimasiPengiriman.style.display = 'none';
        // Sembunyikan tracking progress
        trackingProgress.style.display = 'block';
        ubahWaktuButton.style.display = 'block';
    });
});
</script>
@endsection