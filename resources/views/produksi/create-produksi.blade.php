@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center">
    <a href="{{url()->previous()}}" class="btn m-0 btn-secondary">Kembali</a>
    <h6 class="mx-4 my-0"> Buat tiket</h6>
</div>
<form action="{{url('/store-data-tiket')}}" method="POST">
    @csrf
    <div class="card mt-4 p-3 shadow">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <select name="invoice_id" class="form-control" id="invoice-select">
                        <option value="">-- pilih PO --</option>
                        @foreach($invoice as $row)
                        <option value="{{$row->id}}">{{$row->nomor_invoice}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div id="product-list">
                    <!-- Produk yang dipesan akan muncul di sini -->
                </div>
            </div>

            <hr class="border border-1">
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <select name="brand_id" class="form-control">
                        <option value="">-- pilih merek --</option>
                        @foreach($brand as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <select name="product_id" class="form-control">
                        <option value="">-- pilih produk --</option>
                        @foreach($product as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="date" id="tangal-produksi" name="tanggal_produksi" class="form-control">
                </div>
                <small>-tanggal produksi-</small>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="month" name="tanggal_expired" class="text-decoration-none form-control">
                </div>
                <small>-bulan dan tahun expired-</small>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="text" id="product-code" readonly class="form-control">
                </div>
                <small class="text-danger">*Code produk akan otomatis terisi oleh sistem</small>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="text" id="noBatch" name="batch_number" class="form-control" readonly>
                </div>
                <small class="text-danger">*nomor batch akan otomatis terisi oleh sistem</small>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="text" name="batch_size" placeholder="batch size" class="form-control">
                </div>
            </div>
            <input type="hidden" id="formula-id" name="formula_id" value="">
            <div class="col-md-6 mb-3">
                <div class="input-group-outline input-group">
                    <input type="text" name="acuan_barang_jadi"placeholder="actual total barang jadi" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Formula view</h4>
                <div class="formula-produksi">
                    <!-- Tempat untuk menampilkan formula -->
                </div>
            </div>
            <div class="col-md-6">
                <h4>Persediaan stok</h4>
                <div class="d-none">
                    <!-- Tempat untuk menampilkan Perbandinagan antara stok dan kebutuhan -->
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Tiket</button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.querySelector('select[name="brand_id"]');
    const productSelect = document.querySelector('select[name="product_id"]');
    const productCodeInput = document.getElementById('product-code');
    const invoiceSelect = document.getElementById('invoice-select');
    const autoDate = document.getElementById("tangal-produksi");
    const batchInput = document.getElementById('noBatch');
    const products = @json($product);
    const formula = @json($formula); // Formula dari produk yang dipilih
    const inventoryData = @json($inventoryData); // Stok akhir yang dinamis dari server
    const formulaContainer = document.querySelector('.formula-produksi');
    const stockContainer = document.querySelector('.col-md-6 .d-none'); // Container untuk stok

    autoDate.valueAsDate = new Date();

    invoiceSelect.addEventListener('change', function() {
        var invoiceId = this.value;

        // Kosongkan daftar produk saat invoice baru dipilih
        var productList = document.getElementById('product-list');
        productList.innerHTML = '';

        if (invoiceId) {
            // Kirim permintaan AJAX untuk mengambil produk berdasarkan invoice_id
            fetch('/get-products/' + invoiceId)
                .then(response => response.json())
                .then(products => {
                    if (products.length > 0) {
                        var listItems = '';
                        products.forEach(product => {
                            listItems += '<li>' + product.product_name + ' - ' + product
                                .brand_name + '</li>';
                        });
                        productList.innerHTML = '<ul>' + listItems + '</ul>';
                    } else {
                        productList.innerHTML = '<p>Tidak ada produk untuk invoice ini.</p>';
                    }
                })
                .catch(error => console.error('Error fetching products:', error));
        }
    });

    // Event listener for brand select change
    brandSelect.addEventListener('change', function() {
        const selectedBrandId = this.value;

        // Clear the product select options
        productSelect.innerHTML = '<option value="">-- pilih produk --</option>';

        // Filter and populate products based on selected brand
        products.forEach(function(product) {
            if (product.brand_id == selectedBrandId) {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.name;
                productSelect.appendChild(option);
            }
        });
    });

    // Event listener for product select change
    productSelect.addEventListener('change', function() {
        const selectedProductID = this.value;

        // Find the selected product in the products array
        const selectedProduct = products.find(product => product.id == selectedProductID);

        // If product found, set the product code in the input field
        if (selectedProduct) {
            productCodeInput.value = selectedProduct.code;

            // Generate and set the batch number
            generateBatchNumber(selectedProduct.code);

            console.log(selectedProduct.code);

            // Display the related formula and stock comparison
            displayFormula(selectedProductID);
        } else {
            productCodeInput.value = ''; // Clear the input if no product is selected
            batchInput.value = ''; // Clear batch number input
            formulaContainer.innerHTML = ''; // Clear formula display
            stockContainer.innerHTML = ''; // Clear stock display
        }
    });

    function generateBatchNumber(productCode) {
        const year = new Date().getFullYear().toString().slice(-3); // 3 digits of year
        const month = ("0" + (new Date().getMonth() + 1)).slice(-2); // 2 digits of current month
        const productCodeDigits = productCode.slice(-3); // Last 3 digits of product code

        // Fetch the last production number based on year, product code, and month
        fetch(`/get-last-production-number?year=${year}&month=${month}&productCode=${productCodeDigits}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const lastProductionNumber = data.lastProductionNumber;
                    const newProductionNumber = ("00" + (parseInt(lastProductionNumber) + 1)).slice(-3); // Increment by 1
                    batchInput.value = `${year}${productCodeDigits}${month}${newProductionNumber}`;
                } else {
                    // If no last production number found, start with 001
                    batchInput.value = `${year}${productCodeDigits}${month}001`;
                }
            })
            .catch(error => {
                console.error('Error fetching production number:', error);
            });
    }

    // Function to display the related formula based on selected product
    function displayFormula(productId) {
        formulaContainer.innerHTML = ''; // Clear previous formula display
        stockContainer.innerHTML = ''; // Clear previous stock comparison
        let formulaId = null; // Variable to hold the formula ID

        const formulaDiv = document.createElement('div');
        formulaDiv.className = 'table-responsive'; // menggunakan class yang benar
        let tableHTML = `
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Barang/Bahan</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>`;

        // Tabel persediaan stok
        let stockHTML = `
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Barang/Bahan</th>
                        <th>Stok Tersedia</th>
                        <th>Jumlah Dibutuhkan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>`;

        // Loop untuk menambahkan setiap item ke dalam tabel formula dan stok
        formula.forEach(function(item) {
            if (item.product_id == productId) {
                // Tambahkan item ke dalam tabel Formula
                tableHTML += `
                    <tr>
                        <td>${item.nama_bahan_baku}</td>
                        <td>${item.jumlah}</td>
                        <td>${item.satuan}</td>
                    </tr>`;

                // Set formula ID
                formulaId = item.id;

                // Find the stock for the corresponding bahan baku
                const stock = inventoryData.find(inv => inv.name === item.nama_bahan_baku);

                if (stock) {
                    // Tambahkan item ke dalam tabel Stok
                    const statusClass = parseFloat(stock.stok_akhir) >= parseFloat(item.jumlah) ?
                        'text-success' : 'text-danger';
                    const statusText = parseFloat(stock.stok_akhir) >= parseFloat(item.jumlah) ?
                        'Cukup' : 'Tidak Cukup';
                    stockHTML += `
                        <tr>
                            <td>${item.nama_bahan_baku}</td>
                            <td>${stock.stok_akhir} ${item.satuan}</td>
                            <td>${item.jumlah} ${item.satuan}</td>
                            <td class="${statusClass}">${statusText}</td>
                        </tr>`;
                } else {
                    // Jika stok tidak ditemukan
                    stockHTML += `
                        <tr>
                            <td>${item.nama_bahan_baku}</td>
                            <td>Tidak tersedia</td>
                            <td>${item.jumlah} ${item.satuan}</td>
                            <td class="text-danger">Tidak Cukup</td>
                        </tr>`;
                }
            }
        });

        // Akhiri tabel Formula
        tableHTML += `
                </tbody>
            </table>`;

        // Akhiri tabel Stok
        stockHTML += `
                </tbody>
            </table>`;

        // Tambahkan tabel yang sudah jadi ke dalam formulaDiv
        formulaDiv.innerHTML = tableHTML;
        formulaContainer.appendChild(formulaDiv);

        // Tampilkan tabel stok di stockContainer
        const stockDiv = document.createElement('div');
        stockDiv.className = 'table-responsive';
        stockDiv.innerHTML = stockHTML;
        stockContainer.appendChild(stockDiv);

        // Set the formula ID to the hidden input
        document.getElementById('formula-id').value = formulaId;

        // Show stock container when data is available
        stockContainer.classList.remove('d-none');
    }

});
</script>

@endsection