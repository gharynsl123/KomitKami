@extends('layouts.app')
@section('content')
<div class="card p-3 mb-4">
    <form method="post" class="row g-3">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" id="instansi" readonly value="{{ Auth::user()->instansi->id }}" hidden
                    class="form-control ">
                <input type="text" readonly value="Perusahaan {{ Auth::user()->instansi->name }}" disabled
                    placeholder="" class="form-control ">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control" id="merek">
                    <option>-- Pilih Merek --</option>
                    @foreach($brand as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control" id="productSelect">
                    <option>-- Pilih Produk --</option>
                    @foreach($product as $row)
                    <option value="{{$row->id}}" data-price="{{$row->price}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" class="form-control ">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" class="form-control" id="price"  >
            </div>
            <p class="small">Price (auto dari DB product)</p>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" id="total_harga_calculated" class="form-control" readonly>
            </div>
            <p class="small">Total Harga (Calculated price product * Quantity)</p>
        </div>

        <div class="col-md-12">
            <div class="input-group input-group-outline">
                <textarea id="catatan" placeholder="Catatan *opsional" class="form-control"></textarea>
            </div>
        </div>


        <!-- ketika di pencet ok maka form akan mengirimkan data ke table bawah dan mengosong kan formulir kembali agar bisa di isi lagi -->
        <div class="text-end mt-3 col-12">
            <button type="button" id="ok-btn" class="btn btn-primary">OK</button>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0" id="order-table">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        quantity</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        catatan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Total Harga</th>
                </tr>
            </thead>
            <tbody id="row-order-table">

            </tbody>
            <tfoot>
                <tr>
                    <td>Total Harga</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="mt-3 col-12">
    <form action="{{url('/store-order')}}" method="post">
        @csrf
        <div class="d-none" id="form-multiple">

            <input id="datatotalsemuahargaInput" name="datatotalsemuaharga">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/view-order" class="btn btn-outline-secondary">cancel</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form Inisialisasi
    const form = document.querySelector('form');
    const brandSelect = document.getElementById('merek');
    const selectProduct = document.getElementById('productSelect');
    const inputPrice = document.getElementById('price');
    const inputQuantity = document.getElementById('quantity');
    const inputTotalHargaCalculated = document.getElementById('total_harga_calculated');
    const okButton = document.getElementById('ok-btn');

    // table oreder inisialisasi
    const orderTable = document.getElementById('order-table');
    const rowOrderTable = document.getElementById('row-order-table');
    const products = @json($product);
    let totalHargaSemua = 0;

    brandSelect.addEventListener('change', function() {
        selectedBrandId = brandSelect.value;

        selectProduct.innerHTML = '<option>-- Pilih Produk --</option>';

        const filteredProducts = products.filter(product => product.brand_id == selectedBrandId);
        filteredProducts.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.setAttribute('data-price', product.price);
            option.text = product.name;
            selectProduct.add(option);
        });
    });

    selectProduct.addEventListener('change', function() {
        const selectedProduct = selectProduct.options[selectProduct.selectedIndex];
        const productPrice = selectedProduct.getAttribute('data-price');

        inputPrice.value = formatCurrency(productPrice);

        calculateTotalHarga();
    });

    inputQuantity.addEventListener('input', function() {
        calculateTotalHarga();
    });

    okButton.addEventListener('click', function() {
        addDataToTable();
        updateTotalHargaFooter();
        resetForm();
        totalHargaSemua;
    });


    function calculateTotalHarga() {
        const price = parseFloat(inputPrice.value.replace(/[^0-9.-]+/g, "")) || 0;
        const quantity = parseInt(inputQuantity.value) || 0;

        const totalHarga = price * quantity;

        inputTotalHargaCalculated.value = formatCurrency(totalHarga);
    }

    function addDataToTable() {
        const brandName = brandSelect.options[brandSelect.selectedIndex].text;
        const productName = selectProduct.options[selectProduct.selectedIndex].text;
        const brandid = brandSelect.options[brandSelect.selectedIndex].value;
        const productid = selectProduct.options[selectProduct.selectedIndex].value;
        const quantity = inputQuantity.value;
        const price = parseFloat(inputPrice.value.replace(/[^0-9.-]+/g, "")) || 0;
        const totalHarga = price * parseInt(quantity) || 0;
        const idInstansi = document.getElementById('instansi').value; // Ambil nilai langsung


        console.log(brandSelect.options[brandSelect.selectedIndex].value)
        console.log(selectProduct.options[selectProduct.selectedIndex].value)

        const viewprice = inputPrice.value;
        const viewtotalHargaform = price * parseInt(quantity) || 0;
        const viewtotalHarga = formatCurrency(price * parseInt(quantity) || 0);

        // Mengambil nilai dari textarea catatan
        const catatanElement = document.getElementById('catatan');
        const catatan = catatanElement.value;

        // Tambahkan data ke dalam tabel
        const newRowProduct = rowOrderTable.insertRow();
        newRowProduct.innerHTML = `
            <tr>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xs">${productName} (${brandName})</h6>
                            <p class="text-xs text-secondary mb-0">${viewprice}</p>
                        </div>
                    </div>
                </td>
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-normal">${quantity}</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">${catatan}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${viewtotalHarga}</p>
                </td>
            </tr>

        `;

        // Membuat string HTML untuk input multiple
        var datamultipleinputalat = `
            <div>
                <input name="id_instansi[]" value="${idInstansi}" type="text">
            </div>
            <div>
                <input name="brand_id[]" value="${brandid}" type="text">
            </div>
            <div>
                <input name="product_id[]" value="${productid}" type="text">
            </div>
            <div>
                <input name="quantity[]" value="${quantity}" type="text">
            </div>
            <div>
            <input name="total_harga[]" value="${viewtotalHargaform}" type="text">
            </div>
            <div>
            <input name="catatan[]" value="${catatan}" type="text">
            </div>
        `;

        $('#form-multiple').append(datamultipleinputalat);

        // Tambahkan total harga ke dalam variabel global
        totalHargaSemua += totalHarga;

        // Perbarui total harga di footer
        updateTotalHargaFooter();

        resetForm();
    }

    function updateTotalHargaFooter() {
        // Ambil elemen footer dan perbarui nilai total harga
        const footerRow = orderTable.querySelector('tfoot tr');
        if (footerRow) {
            const totalHargaCell = footerRow.querySelector('td:last-child');
            if (totalHargaCell) {
                var datatotalsemuaharga = totalHargaCell.innerText = formatCurrency(totalHargaSemua);
                document.getElementById("datatotalsemuahargaInput").value = totalHargaSemua;
            }
        }
    }


    function resetForm() {
        brandSelect.value = '-- Pilih Merek --';
        selectProduct.innerHTML = '<option>-- Pilih Produk --</option>';
        inputQuantity.value = '';
        inputPrice.value = '';
        inputTotalHargaCalculated.value = '';
        document.getElementById('catatan').value = '';
    }
});


function parseCurrency(currencyString) {
    return parseFloat(currencyString.replace(/[^0-9.-]+/g, "")) || 0;
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('us-us', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2
    }).format(amount);
}
</script>

@endsection