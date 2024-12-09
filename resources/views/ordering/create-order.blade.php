@extends('layouts.app')
@section('content')
<style>
    .swal2-icon.swal2-error {
        font-size: 0.5rem;
    }
</style>


<div class="mt-3 col-12">
    <form id="main-form" method="post">
        @csrf
        <div class="card p-3 mb-3">
            <div class="d-flex justify-content-between">
                <div class="col-md-6">
                    <label for="">Nomor PO</label>
                    <div class="input-group align-item-center input-group-outline">
                        <input type="text" name="nomor_po" id="InputPO" placeholder="Nomor PO" class="form-control">
                    </div>
                </div>
                <p class="text-dark my-auto text-bold">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="d-none" id="form-multiple">
            <input id="datatotalsemuahargaInput" name="datatotalsemuaharga" type="text">
        </div>
    </form>
</div>


<div class="card p-3 mb-3">
    <form id="order-form" method="post" class="row g-3">
        @csrf

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" id="instansi" readonly value="{{ Auth::user()->id }}" hidden class="form-control">
                <input type="text" readonly value="Perusahaan {{ Auth::user()->name }}" disabled placeholder=""
                    class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select required class="form-control" id="merek">
                    <option value="">-- Pilih Merek --</option>
                    @foreach($brand as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mb-3">
                <select required class="form-control" id="productSelect">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($product as $row)
                    <option value="{{$row->id}}" data-price="{{$row->price}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input required type="number" id="quantity" placeholder="Quantity" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input required type="text" readonly class="form-control" id="price">
            </div>
            <p class="small">Price (auto dari DB product)</p>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" required id="total_harga_calculated" class="form-control" readonly>
            </div>
            <p class="small">Total Harga (Calculated price product * Quantity)</p>
        </div>

        <div class="col-md-12">
            <div class="input-group input-group-outline">
                <textarea id="catatan" placeholder="Catatan *opsional" class="form-control"></textarea>
            </div>
        </div>

        <!-- ketika di pencet ok maka form akan mengirimkan data ke table bawah dan mengosongkan formulir kembali agar bisa diisi lagi -->
        <div class="text-end mt-3 col-12">
            <button type="button" id="ok-btn" class="btn btn-primary" disabled>OK</button>
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
                        Quantity</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Catatan</th>
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
                    <td id="total-footer"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="mt-3">
    <button type="submit" id="btn-submit" class="btn btn-primary" disabled>Submit</button>
    <a href="/view-order" class="btn btn-outline-secondary">Cancel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#order-form');
    const mainForm = document.querySelector('#main-form');
    const InputPo = document.querySelector('#InputPO');

    const brandSelect = document.getElementById('merek');
    const buttonSub = document.getElementById('btn-submit');
    const selectProduct = document.getElementById('productSelect');
    const inputPrice = document.getElementById('price');
    const inputQuantity = document.getElementById('quantity');
    const inputTotalHargaCalculated = document.getElementById('total_harga_calculated');
    const okButton = document.getElementById('ok-btn');
    const rowOrderTable = document.getElementById('row-order-table');
    const orderTable = document.getElementById('order-table');
    const products = @json($product);
    let totalHargaSemua = 0;

    function validateForm() {
        const isValid = brandSelect.value && selectProduct.value && inputQuantity.value;
        okButton.disabled = !isValid;
        return isValid;
    }

    function updateButtonState() {
        const isFormValid = rowOrderTable.rows.length > 0;
        buttonSub.disabled = !isFormValid;
    }

    buttonSub.addEventListener('click', function() {
        // Check if InputPo is empty
        if (InputPo.value === "") {
            Swal.fire({
                title: 'Perhatian',
                text: 'Nomor PO harus di masukkan',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            // Set the form action and submit the form
            mainForm.action = '{{ url("/store-order") }}'; // Mengatur action pada form
            mainForm.submit(); // Mengirim form
        }
    });

    brandSelect.addEventListener('change', function() {
        const selectedBrandId = brandSelect.value;
        selectProduct.innerHTML = '<option value="">-- Pilih Produk --</option>';
        const filteredProducts = products.filter(product => product.brand_id == selectedBrandId);
        filteredProducts.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.setAttribute('data-price', product.price);
            option.text = product.name;
            selectProduct.add(option);
        });
        validateForm();
    });

    selectProduct.addEventListener('change', function() {
        const selectedProduct = selectProduct.options[selectProduct.selectedIndex];
        const productPrice = selectedProduct.getAttribute('data-price');
        inputPrice.value = formatCurrency(parseFloat(productPrice));
        calculateTotalHarga();
        validateForm();
    });

    inputQuantity.addEventListener('input', function() {
        calculateTotalHarga();
        validateForm();
    });

    okButton.addEventListener('click', function() {
        if (validateForm()) {
            addDataToTable();
            resetForm();
            updateButtonState();
        }
    });

    function calculateTotalHarga() {
        const price = parseFloat(inputPrice.value.replace(/[^0-9,-]+/g, "").replace(',', '.')) || 0;
        const quantity = parseInt(inputQuantity.value) || 0;
        const totalHarga = price * quantity;
        inputTotalHargaCalculated.value = formatCurrency(totalHarga);
    }

    function addDataToTable() {
        const brandName = brandSelect.options[brandSelect.selectedIndex].text;
        const productName = selectProduct.options[selectProduct.selectedIndex].text;
        const brandid = brandSelect.value;
        const productid = selectProduct.value;
        const quantity = parseInt(inputQuantity.value) || 0;
        const price = parseFloat(inputPrice.value.replace(/[^0-9,-]+/g, "").replace(',', '.')) || 0;
        const totalHarga = price * quantity || 0;
        const idInstansi = document.getElementById('instansi').value;
        const viewprice = formatCurrency(price);
        const viewtotalHarga = formatCurrency(totalHarga);
        const catatan = document.getElementById('catatan').value;

        const newRow = `
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
        rowOrderTable.insertAdjacentHTML('beforeend', newRow);

        const datamultipleinputalat = `
            <div>
                <input name="id_instansi[]" value="${idInstansi}" type="hidden">
            </div>
            <div>
                <input name="brand_id[]" value="${brandid}" type="hidden">
            </div>
            <div>
                <input name="product_id[]" value="${productid}" type="hidden">
            </div>
            <div>
                <input name="quantity[]" value="${quantity}" type="hidden">
            </div>
            <div>
                <input name="total_harga[]" value="${viewtotalHarga}" type="hidden">
            </div>
            <div>
                <input name="catatan[]" value="${catatan}" type="hidden">
            </div>
        `;
        document.getElementById('form-multiple').insertAdjacentHTML('beforeend', datamultipleinputalat);

        totalHargaSemua += totalHarga;
        updateTotalHargaFooter();
    }

    function updateTotalHargaFooter() {
        const footerRow = orderTable.querySelector('tfoot tr');
        if (footerRow) {
            const totalHargaCell = footerRow.querySelector('td:last-child');
            if (totalHargaCell) {
                totalHargaCell.innerText = formatCurrency(totalHargaSemua);
                document.getElementById("datatotalsemuahargaInput").value = totalHargaSemua;
            }
        }
    }

    function resetForm() {
        brandSelect.value = '';
        selectProduct.innerHTML = '<option value="">-- Pilih Produk --</option>';
        inputQuantity.value = '';
        inputPrice.value = '';
        inputTotalHargaCalculated.value = '';
        document.getElementById('catatan').value = '';
        validateForm();
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    }
});
</script>
@endsection