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
                REKAP ORDER PRODUCT
            </ins>
        </p>
    </div>

    <table class="table mt-4">
        <tr>
            <td class="width-50">
                <p class="fw-bold">Waktu Rekap</p>
                <p class="text-small small-width">From <strong>{{$fromMonth->formatLocalized('%d %B %Y') }}</strong>
                    <br> To <strong>{{ $toMonth->formatLocalized('%d %B %Y') }}</strong></p>
            </td>
            <td class="text-end">
                <p class="fw-bold text-capitalize"> jakarta, 21 maret 2024 </p>
                <p class="text-small"> PT. KOMITKAMI INTINUSA GEMILANG</p>
            </td>
        </tr>
    </table>

    <p class="text-extra-small">informasi barang:</p>
    <table class="table-border font-family text-small">
        <thead>
            <tr class="text-uppercase fw-bold">
                <td>Nama Produk</td>
                <td>Kode Produk</td>
                <td>Harga Produk</td>
                <td>Barang Terkirim</td>
                <td>Dalam Proses</td>
                <td>Total Kuantitas</td>
                <td>Total Harga</td>
            </tr>
        </thead>
        <tbody>
            @foreach($uniqueProducts as $productName => $product)
            <tr>
                <td>{{ $productName }}</td>
                <td>{{ $product['code'] }}</td>
                <td>@currency($product['price'])</td>
                <td>{{ $productName }}</td>
                <td>{{ $productName }}</td>
                <td>{{ $product['quantity'] }}X</td>
                <td>@currency($product['totalPrice'])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-extra-small mt-4">detailed data:</p>
    <table class="table-border font-family text-small">
        <thead>
            <tr class="text-uppercase fw-bold">
                <td>Nama Produk</td>
                <td>Nomor PO</td>
                <td>Jumlah</td>
                <td>Status Pesanan</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($uniqueProductsWithPO as $productName => $productInfo)
                @foreach ($productInfo['nomor_invoice'] as $index => $poNumber)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($productInfo['nomor_invoice']) }}">{{ $productName }}</td>
                        @endif
                        <td>{{ $poNumber }}</td>
                        <td>{{ $productInfo['quantity'][$index] }}</td>
                        <td>{{ $productInfo['status'][$index] }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>

</html>