<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Pre-Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .text-small {
        font-size: 13px;
    }

    .text-extra-small {
        font-size: 12px;
    }

    .small-width {
        max-width: 85%;
    }

    p {
        padding: 0 !important;
        margin: 0 !important;
        font-family: Roboto, sans-serif;
    }

    .font-family {
        font-family: Roboto, sans-serif;
    }

    .width-50 {
        width: 50%;
    }

    /* Tambahkan border untuk seluruh tabel */
    .table-border {
        border-collapse: collapse;
        width: 100%;
    }

    /* Tambahkan border untuk seluruh sel */
    .table-border td,
    .table-border th {
        border: 1px solid black;
        /* Atur ketebalan, jenis, dan warna garis */
        padding: 8px;
        /* Atur jarak antara konten dan tepi sel */
        text-align: left;
        /* Atur perataan teks */
    }

    /* Tambahkan border untuk baris header */
    .table-border thead tr {
        border-bottom: 2px solid black;
        /* Atur border-bottom pada baris header */
    }

    /* Tambahkan border untuk baris tbody */
    .table-border tbody tr {
        border-top: 1px solid black;
        /* Atur border-top pada setiap baris tbody */
    }
    </style>

<body>
    <div class="text-center">
        <p class="fw-bold">
            <ins>
                PURCHASE ORDER
            </ins>
        </p>
        <p>{{$orderInformation->invoice->nomor_invoice}}</p>
    </div>

    <table class="table mt-4">
        <tr>
            <td class="width-50">
                <p class="fw-bold">{{$orderInformation->user->name}}</p>
                <p class="text-small small-width">{{$orderInformation->user->alamat}}</p>
            </td>
            <td class="text-end">

                <p class="fw-bold text-capitalize"> {{$orderInformation->created_at->format('d F Y')}} </p>

                <p class="text-small"> PT. KOMITKAMI INTINUSA GEMILANG</p>
            </td>
        </tr>
    </table>

    <p class="text-extra-small">item information below:</p>
    <table class="table-border font-family text-small">
        <thead>
            <tr class="text-uppercase fw-bold">
                <td>no</td>
                <td>Kode</td>
                <td>nama product</td>
                <td>status</td>
                <td>QTY</td>
                <td>price</td>
                <td>Amount</td>
                <td>keterangan</td>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{$order->product->code ?? 'tidak ada'}}</td>
                <td>{{$order->product->name}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->product->price}}</td>
                <td>{{$order->total_harga}}</td>
                <td>{{$order->catatan ?? 'tidak Ada'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table mt-4">
        <tbody>
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td>@currency($invoice->total_harga)</td>
            </tr>
        </tbody>
    </table>

</body>

</html>