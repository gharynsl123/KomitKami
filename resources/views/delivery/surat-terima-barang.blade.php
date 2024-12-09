<style>
.signature {
    margin-top: 50px;
    width: 100%;
    text-align: center;
}

.signature div {
    display: inline-block;
    width: 30%;
}

.signature div p {
    margin-top: 50px;
    text-align: center;
}
</style>

<body class="border-box">
    <div class="header">
        <div class="logo">
            <img src="https://komitkami.com/images/logo.png" alt="KOMITKAMI Logo" class="logo" style="height: 50px;">
        </div>
    </div>
    <div class="content">
        <div style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 20px;">TANDA TERIMA BARANG</div>
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 50%;">
                    Kepada Yth :<br>
                    PT. Komitkami Instinusa Gemilang (Cikarang)<br>
                    Kawasan Industri Delta Silicon 5 Jl. Cendana Raya Blok G5 No.5 Kav 9, Cibatu Cikarang Pusat Bekasi,
                    Jawa Barat.
                </td>
                <td style="width: 25%;">
                    Tanggal :<br>
                    [{Tanggal}]
                </td>
                <td style="width: 25%;">
                    No PO :<br>
                    {{$readyOrders->first()->order->invoice->nomor_invoice}} <br>
                </td>
            </tr>
        </table>

        <table class="table" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($readyOrders as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->order->product->code }}</td>
                    <td>{{ $item->order->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->order->catatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature">
            <div>
                <p>Diterima Oleh :</p>
                <p>--------------------</p>
            </div>
            <div>
                <p>Diserahkan & Diperiksa Oleh :</p>
                <p>--------------------</p>
            </div>
            <div>
                <p>Hormat Kami,</p>
                <p>Dedy Marvadi, S.Kom</p>
            </div>
        </div>
    </div>
</body>