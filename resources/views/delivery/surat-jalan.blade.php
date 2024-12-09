<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat jalan dan terima barang</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        padding: 20px;
        margin: 0 auto;
        max-width: 800px;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: start;
        margin-bottom: 20px;
    }

    .logo {
        margin-right: 20px;
    }

    table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    .table-header th {
        background-color: #f2f2f2;
        width: 12.5%;
    }

    .table-header td {
        width: 37.5%;
    }

    .footer {
        margin-top: 20px;
    }

    .footer table {
        width: 100%;
        border-collapse: collapse;
    }

    .footer th,
    .footer td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 5px 15px;
    }

    .border-box{
        border :solid;
    }

    p {
        font-size: 14px;
    }
    </style>
</head>

<body class="border-box">
    <div class="header">
        <img src="https://komitkami.com/images/logo.png" alt="KOMITKAMI Logo" class="logo" style="height: 50px;">
        <h2 style="flex-grow: 1; text-align: center;">Surat Jalan</h2>
    </div>


    <table>
        <tr>
            <td rowspan="2">
                <p>
                    <strong>From:</strong> <br> PT Komitkami Intinusa Gemilang<br>
                    <strong>Address:</strong> Komplek Bizpark 3 Blok E/20Jl. Sultan Agung, Kelurahan Kali Baru,
                    KecamatanMedan Satria, Kota Bekasi
                </p>
            </td>
            <td>

                <strong>To:</strong> PT. Buana Intiprima Usaha
            </td>
        </tr>
        <tr>
            <td>
                <strong>No. Surat Jalan:</strong> {{$readyOrders->first()->No_SJ}} <br>
                <strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }} <br>
                <strong>No. PO:</strong> {{$readyOrders->first()->order->invoice->nomor_invoice}} <br>
            </td>
        </tr>
    </table>


    <p>Kami kirimkan barang - barang dibawah ini dengan kendaraan ........................ No .....................</p>
    <table>
        <thead>
            <tr>
                <th>Qty</th>
                <th>Kemasan</th>
                <th>Nama Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($readyOrders as $item)
            <!-- Misalnya 'items' adalah relasi dari Order -->
            <tr>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->order->product->tipe }}</td>
                <td>{{ $item->order->product->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <table>
            <tr>
                <th>Penerima</th>
                <th>Hormat Kami</th>
            </tr>
            <tr>
                <td>(Tanda Tangan/Cap)</td>
                <td>(Tanda Tangan/Cap)</td>
            </tr>
        </table>
    </div>

</body>

</html>