@extends('layouts.app')

@section('content')
<style>
.order-item {
    background-color: #f8f9fa;
    /* Warna abu-abu terang */
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.order-item:hover {
    background-color: #e9ecef;
    /* Warna lebih gelap saat hover */
}
</style>

<div class="container mt-4">
    <!-- Estimated Date Card -->
    <div class="card p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estimate_date">Tanggal Sampai:</label>
                    <input type="date" class="form-control" id="estimate_date"
                        value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div id="filter-section">
                    <div class="form-group">
                        <label for="estimate_date">Pilih Instansi:</label>
                        <select name="id_user" class="border px-2 py-0 form-control" id="pilih-instansi">
                            <option value="none">Filter Instansi</option>
                            @foreach($users as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List of Orders Grouped by Invoice -->
    <div class="card p-3 mb-3">
        <h5>Order List Grouped by Invoice</h5>
        <div id="order-list">
            @forelse($invoices as $invoice)
            @php
            // Filter orders dengan status 'process'
            $processOrders = $invoice->orders->where('status', 'process');
            @endphp

            @if($processOrders->isNotEmpty())
            <div class="card mb-3 p-3 invoice-card" data-user-id="{{ $invoice->orders->first()->user->id }}">
                <div class="d-flex gap-4 text-dark ">
                    <p class="fw-bolder">Nomor PO: {{ $invoice->nomor_invoice }}</p>
                    <p class="fw-bolder">Nama User:
                        @if($invoice->orders->isNotEmpty())
                        {{ $invoice->orders->first()->user->name }}
                        @else
                        Tidak ada user terkait
                        @endif
                    </p>
                </div>

                @foreach($processOrders as $order)
                <div class="d-flex justify-content-between align-items-center mb-2 order-item">
                    <div>
                        Product: {{ $order->product->name }} | Quantity Ordered: {{ $order->quantity }}
                    </div>
                    <button type="button" class="btn btn-primary add-to-list" data-toggle="modal"
                        data-target="#addItemModal" data-order-id="{{ $order->id }}"
                        data-invoice-id="{{ $invoice->id }}" data-user-id="{{ $order->user->id }}"
                        data-product-name="{{ $order->product->name }}" data-quantity-ordered="{{ $order->quantity }}">
                        Add
                    </button>
                </div>
                @endforeach
            </div>
            @endif
            @empty
            <p class="text-center m-0">tidak ada order saat ini</p>
            @endforelse
        </div>
    </div>

    <!-- Tambahkan Modal di sini -->
    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item to Delivery List</h5>
                    <button type="button" class="close btn px-2 py-0 btn-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-item-form">
                        <div class="form-group">
                            <label for="product-name">Product</label>
                            <input type="text" class="form-control" id="product-name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantity-ordered">Quantity Ordered</label>
                            <input type="number" class="form-control" id="quantity-ordered" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantity-ready">Quantity Ready to Deliver</label>
                            <input type="number" class="form-control" id="quantity-ready" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-add-item">Add to List</button>
                </div>
            </div>
        </div>
    </div>

    <!-- List of Items to be Delivered -->
    <div class="card p-3 mb-3">
        <h5>Ready to Deliver Items</h5>
        <ul id="delivery-list" class="list-group">
            <!-- Items will be added here dynamically -->
        </ul>
    </div>

    <!-- Submit Button -->
    <div class="text-end mt-3">
        <button type="button" id="submit-button" class="btn btn-success" disabled>Submit</button>
    </div>
</div>

<!-- Tambahkan script jQuery dan Bootstrap JS di sini -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let orderID, productName, quantityOrdered, invoiceID, userID;

    // Ketika tombol "Add" diklik, simpan data order
    document.querySelectorAll('.add-to-list').forEach(button => {
        button.addEventListener('click', function() {
            orderID = this.getAttribute('data-order-id');
            productName = this.getAttribute('data-product-name');
            quantityOrdered = this.getAttribute('data-quantity-ordered');
            invoiceID = this.getAttribute('data-invoice-id');
            userID = this.getAttribute('data-user-id');
            document.getElementById('product-name').value = productName;
            document.getElementById('quantity-ordered').value = quantityOrdered;
        });
    });

    // Ketika tombol konfirmasi di modal diklik, tambahkan item ke daftar pengiriman
    document.getElementById('confirm-add-item').addEventListener('click', function() {
        const quantityReady = parseInt(document.getElementById('quantity-ready').value, 10);

        if (quantityReady > 0 && quantityReady <= quantityOrdered) {
            const listItem = `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${productName} | Quantity: ${quantityReady}
                    <input type="hidden" name="order_id[]" value="${orderID}">
                    <input type="hidden" name="quantity_ready[]" value="${quantityReady}">
                    <input type="hidden" name="invoice_id[]" value="${invoiceID}">
                    <input type="hidden" name="user_id[]" value="${userID}">
                </li>
            `;
            document.getElementById('delivery-list').insertAdjacentHTML('beforeend', listItem);
            document.querySelector('#addItemModal').classList.remove('show');
            document.querySelector('.modal-backdrop').remove(); // Menghapus backdrop modal
            document.querySelector('body').classList.remove('modal-open'); // Menghapus class modal-open dari body
            document.getElementById('submit-button').disabled = false;
        } else {
            alert('Quantity ready to deliver must be between 1 and ' + quantityOrdered);
        }
    });

    // Submit the delivery list
    document.getElementById('submit-button').addEventListener('click', function() {
        const estimateDate = document.getElementById('estimate_date').value;
        const items = [];

        document.querySelectorAll('#delivery-list li').forEach(item => {
            const orderID = item.querySelector('input[name="order_id[]"]').value;
            const quantityReady = item.querySelector('input[name="quantity_ready[]"]').value;
            const invoiceID = item.querySelector('input[name="invoice_id[]"]')
                .value; // Ambil invoice ID
            const userID = item.querySelector('input[name="user_id[]"]').value; // Ambil user ID
            items.push({
                order_id: orderID,
                quantity: quantityReady,
                invoice_id: invoiceID, // Masukkan invoice ID ke dalam item
                user_id: userID // Masukkan user ID ke dalam item
            });
        });

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("/store-ready-order") }}';
        form.innerHTML = `
            @csrf
            <input type="hidden" name="estimate_date" value="${estimateDate}">
            <input type="hidden" name="items" value='${JSON.stringify(items)}'>
        `;
        document.body.appendChild(form);
        form.submit();
    });

    // Function untuk melakukan filter berdasarkan instansi
    function filterInstansi() {
        const selectedUserId = document.getElementById('pilih-instansi').value;
        const invoiceCards = document.querySelectorAll('.invoice-card');

        invoiceCards.forEach(card => {
            const cardUserId = card.getAttribute('data-user-id');

            if (selectedUserId === 'none' || cardUserId === selectedUserId) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Listen to changes in the filter dropdown
    document.getElementById('pilih-instansi').addEventListener('change', filterInstansi);

    // Initial call to show all invoices
    filterInstansi();
});
</script>

@endsection