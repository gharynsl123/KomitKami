@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="card p-3">
        <form action="{{url('/store-order')}}" method="post" class="row g-3">
            @csrf
            <div class="col-md-6">
                <div class="input-group input-group-outline">
                    <input type="text" name="id_instansi" id="instansi" readonly
                        value="{{ Auth::user()->instansi->id }}" hidden class="form-control ">
                    <input type="text" name=""  id="instansi" readonly
                        value="Perusahaan {{ Auth::user()->instansi->name }}" disabled placeholder="" class="form-control ">
                </div>
            </div>

            <!-- Bagian Merek -->
            <div class="col-md-6">
                <div class="input-group input-group-outline mb-3">
                    <select name="brand_id" class="form-control" id="merek">
                        <option>-- Pilih Merek --</option>
                        @foreach($brand as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <!-- Bagian Produk -->
            <div class="col-md-6">
                <div class="input-group input-group-outline mb-3">
                    <select name="product_id" class="form-control" id="productSelect">
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
                    <input type="number" name="quantity" id="quantity" class="form-control ">
                </div>
            </div>

            <!-- Bagian Harga -->
            <div class="col-md-6">
                <div class="input-group input-group-outline">
                    <input type="text" class="form-control" id="price" disabled readonly>
                </div>
                <p class="small">Price (auto dari DB product)</p>
            </div>

            <!-- Bagian Total Harga -->
            <div class="col-md-6">
                <div class="input-group input-group-outline">
                    <input type="text" name="total_harga" id="total_harga_calculated" class="form-control" readonly>
                </div>
                <p class="small">Total Harga (Calculated price product * Quantity)</p>
            </div>

            <!-- Bagian Catatan -->
            <div class="col-md-12">
                <div class="input-group input-group-outline">
                    <textarea type="text" name="catatan" placeholder="Catatan *opsional"
                        class="form-control"></textarea>
                </div>
            </div>

            <!-- Tombol Submit atau Action lainnya -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/view-order" class="btn btn-outline-secondary">cancel</a>
            </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.getElementById('merek');
    const selectProduct = document.getElementById('productSelect');
    const inputPrice = document.getElementById('price');
    const inputQuantity = document.getElementById('quantity');
    const inputTotalHargaCalculated = document.getElementById('total_harga_calculated');
    const products = @json($product);

    brandSelect.addEventListener('change', function() {
        selectedBrandId = brandSelect.value;

        // Reset pilihan produk
        selectProduct.innerHTML = '<option>-- Pilih Produk --</option>';

        // Filter produk berdasarkan merek yang dipilih
        const filteredProducts = products.filter(product => product.brand_id == selectedBrandId);
        // Tambahkan opsi produk yang sudah difilter
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

    function calculateTotalHarga() {
        const price = parseFloat(inputPrice.value.replace(/[^0-9.-]+/g, "")) || 0;
        const quantity = parseInt(inputQuantity.value) || 0;

        const totalHarga = price * quantity;

        inputTotalHargaCalculated.value = formatCurrency(totalHarga);
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('us-us', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }
});
</script>
@endsection