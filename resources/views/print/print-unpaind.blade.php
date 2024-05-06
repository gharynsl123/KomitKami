<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Unpaid </title>
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
                REKAP UNPAID ORDER PRODUCT
            </ins>
        </p>
    </div>

    <table class="table mt-4">
        <tr>
            <td class="text-end">
                <p class="fw-bold text-capitalize"> jakarta, 21 maret 2024 </p>
                <p class="text-small">
                    @if(Auth::user()->level == 'Customer')
                     {{Auth::user()->instansi->name}}
                     @else
                     PT. Komitkami Intinusa Gemilang
                     @endif
                    </p>
            </td>
        </tr>
    </table>

    <p class="text-extra-small">informasi barang:</p>
    <table class="table-border font-family text-small">
        <thead>
            <tr class="text-uppercase fw-bold">
                <td>Nama Produk</td>
                <td>Tanggal Pesan</td>
                <td>status</td>
                <td>Jumlah pesanann</td>
                <td>Nomor PO</td>
                <td>Harga Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($orderData as $items)
            <tr>
                <td>{{ $items->product->name }}</td>
                <td>{{ $items->created_at->format('d M Y, H:I A')}}</td>
                <td>{{$items->status}}</td>
                <td>{{ $items->quantity }}</td>
                <td>{{ $items->invoice->nomor_invoice }}</td>
                <td>@currency($items->total_harga)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>