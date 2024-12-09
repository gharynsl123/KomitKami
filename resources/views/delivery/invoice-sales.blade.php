<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Layout</title>
    <style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        position: relative;
    }

    .footer-wrapper {
        display: flex;
        font-size: 9px;
        position: absolute;
        /* Mengunci posisi */
        bottom: 0;
        width: 100%;
        /* Memastikan footer memenuhi lebar layar */
    }

    img {
        max-width: 200px;
    }

    .company-info {
        text-align: right;
        font-size: 9px;
    }

    .costumer-info {
        font-size: 9px;
    }

    .invoice-details {
        padding: 1rem;
        text-align: right;
        background: #EFEFEF90;
        font-size: 9px;
    }

    .informasi-payment {
        font-size: 9px;
    }

    .costumer-refrens {
        font-size: 9px;
    }

    .totals {
        width: 60%;
        font-size: 9px;
        margin-left: auto;
        align-self: end;
    }

    .totals th,
    .totals td {
        text-align: right;
        border-left: 0px;
        /* atau properti lainnya */
        border-right: 0px;
        /* atau properti lainnya */
        border-top: 0px;
    }

    .totals th {
        width: 70%;
    }

    .footer {
        font-size: 14px;
        text-align: center;
    }

    .tableBorderless {
        border: none;
        border-collapse: collapse;
        width: 100%;
    }

    .tableBorderless td,
    .tableBorderless th {
        border: none;
        padding: 0;
        width: 50%;
        text-align: left;
    }

    .tableBorderless tr {
        border: none;
    }

    p {
        margin: 0px;
        font-size: 9px;
    }

    h3 {
        margin: 0px;
        font-style: normal;
        font-weight: normal;
    }

    .itemTable {
        width: 100%;
        border-collapse: collapse;
        font-size: 9px;
        margin: 0;
    }

    .itemTable th,
    .itemTable td {
        padding: 5px 10px;
        text-align: left;
        border-left: 0px;
        /* atau properti lainnya */
        border-right: 0px;
        /* atau properti lainnya */
    }

    .itemTable th {
        font-weight: bold;
        text-transform: uppercase;
    }

    .itemTable td:last-child,
    .itemTable td:nth-child(4) {
        text-align: right;
        /* Kolom harga dan total rata kanan */
    }

    .itemTable td {
        vertical-align: middle;
        /* Untuk memastikan semua teks rata di tengah */
    }

    .bg-info {
        background: #000000
    }
    </style>
</head>

@php
    $subtotal = 0;
    foreach ($readyOrders as $item) {
        $quantity = intval($item->quantity); // Konversi kuantitas menjadi integer
        $price = floatval(str_replace(['Rp', '.', ','], ['', '', '.'], $item->order->product->price)); // Format harga
        $subtotal += $quantity * $price; // Hitung subtotal
    }
@endphp

<body>
    <div class="container">
        <table class="tableBorderless">
            <tr>
                <td>
                    <img src="https://komitkami.com/images/logo.png" alt="KOMITKAMI Logo" class="logo"
                        style="margin-top:0.7 rem; height: 50px;">
                </td>
                <td>
                    <div class="company-info">
                        <h3 style="font-weight: bold; margin: 0px 0px 1rem 0px;">PT Komitkami Intinusa Gemilang</h3>
                        <h3>KAWASAN BIZPARK 3 BLOK E/20</h3>
                        <h3>JL. SULTAN AGUNG KM 28, BEKASI, JAWA BARAT, 17131</h3>
                        <h3>komitkami@gmail.com</h3>
                    </div>
                </td>
            </tr>
        </table>

        <table class="tableBorderless" style="margin-top: 2rem;">
            <tr>
                <td>
                    <div class="costumer-info">
                        <h3>{{$readyOrders->first()->order->user->name}}</h3>
                        <h3 style="text-transform: uppercase; margin-top:5px;">
                            {{$readyOrders->first()->order->user->address}}
                        </h3>
                    </div>
                </td>
                <td>
                    <div class="invoice-details">
                        <h3 style="margin-bottom: 8px;">Invoice #: {{$readyOrders->first()->invoice->nomor_invoice}}</h3>
                        <h3 style="margin-bottom: 8px;">Date: {{$readyOrders->first()->created_at->format('d/m/Y')}}</h3>
                        <h3 style="margin-bottom: 8px;">Terms: Net 30</h3>
                        <h3 style="margin-bottom: 8px;">Due Date: {{$readyOrders->first()->estimate ?? "null"}}</h3>
                        <h1 style="margin:0px;">Rp. {{number_format($subtotal, 2, ',', '.') }}</h1>
                    </div>
                </td>
            </tr>
        </table>

        <!-- INFORMASI BARANG INVOICE -->
        <table class="itemTable">
            <tr>
                <th>QTY</th>
                <th>DESCRIPTION</th>
                <th>DISCOUNT</th>
                <th>UNIT PRICE (Rp.)</th>
                <th>AMOUNT (Rp.)</th>
            </tr>
            <tbody>
                @foreach($readyOrders as $item)
                <tr>
                    <td>{{ $item->quantity }} - {{$item->order->product->tipe}}</td>
                    <td>{{ $item->order->product->name }}</td>
                    <td></td>
                    <td>{{ $item->order->product->price}}</td>
                    @php
                    // Ambil nilai kuantitas sebagai integer
                    $quantity = intval($item->quantity);

                    // Bersihkan dan konversi harga produk menjadi float
                    $price = str_replace(['Rp', '.', ','], ['', '', '.'], $item->order->product->price);

                    // Pastikan harga menjadi float
                    $price = floatval($price);

                    // Lakukan perkalian
                    $totalPrice = $quantity * $price;

                    // Format total harga
                    $formattedTotalPrice = number_format($totalPrice, 2, ',', '.');
                    @endphp

                    <td class="amount">{{$formattedTotalPrice}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- END OF INFORMASI ITEM -->
        <table class="totals">
            <tr>
                <th>SUBTOTAL</th>
                <td>{{ number_format($subtotal, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Discount</th>
                <td>-</td>
            </tr>
            <tr>
                <th>BALANCE DUE</th>
                <td>{{ number_format($subtotal, 2, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer-wrapper">
        </div>
        <table class="tableBorderless" style="margin-top: 1.5rem; background: #EFEFEF90; padding: 1rem;">
            <tr>
                <td>
                    <div class="informasi-payment">
                        <h3 style="font-weight: bold; margin: 0px 0px 1rem 0px;">Payment Detail</h3>
                        <h3>Bank Name: BANK MANDIRI</h3>
                        <h3>Bank Branch: CABANG KELAPA GADING BARAT</h3>
                        <br>
                        <h3>Account Name: BANK MANDIRI</h3>
                        <h3>Account Number: 125-003005-2005</h3>
                    </div>
                </td>
                <td class="costumer-refrens">
                    <h3 style="font-weight: bold; margin: 0px 0px 1rem 0px;">Other Information</h3>
                    <h3>Harga Sudah Termasuk PPN (Pajak)</h3> <br>
                    <h3>Customer Reference:</h3>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>