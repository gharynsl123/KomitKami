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

             <input type="hidden" id="formula-id" name="formula_id">

             <div class="warp-tikects row col-md-12" id="ticket-container">
                 <div class="col-md-3 mb-3">
                     <div class="input-group-outline input-group">
                         <input type="text" id="noBatch" name="batch_number" class="form-control" readonly>
                     </div>
                     <small class="text-danger">*nomor batch akan otomatis terisi oleh sistem</small>
                 </div>
                 <div class="col-md-3 mb-3">
                     <div class="input-group-outline input-group">
                         <input type="text" name="batch_size" placeholder="batch size" class="form-control">
                     </div>
                 </div>
                 <div class="col-md-3 mb-3">
                     <div class="input-group-outline input-group">
                         <input type="text" placeholder="Hasil Produk jadi" class="form-control">
                     </div>
                 </div>
                 <div class="col-md-3 mb-3">
                     <div class="input-group-outline input-group">
                         <input type="month" name="tanggal_expired" class="text-decoration-none form-control">
                     </div>
                     <small>-bulan dan tahun expired-</small>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-auto">
                 <h4>Formula view</h4>
                 <div class="table-responsive">
                     <!-- Tempat untuk menampilkan formula -->
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Nama Barang/Bahan</td>
                                <td>Jumlah</td>
                                <td>Satuan</td>
                                <td>Stok Akhir Persediaan</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody class="formula-produksi">

                        </tbody>
                      </table>
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
    const invoiceSelect = document.getElementById('invoice-select');
    const productList = document.getElementById('product-list');
    const formulaContainer = document.querySelector('.formula-produksi');

    invoiceSelect.addEventListener('change', function () {
        const invoiceId = this.value;

        if (invoiceId) {
            fetch(`/get-products/${invoiceId}`)
                .then(response => response.json())
                .then(products => {
                    if (products.length > 0) {
                        let listItems = '';
                        products.forEach(product => {
                            listItems += `<li>${product.product_name} - ${product.brand_name} ( ${product.jumlah_yang_di_pesan} pcs )</li>`;
                        });
                        productList.innerHTML = `<ul>${listItems}</ul>`;
                        getLastBatchNumberAndGenerateTickets(products);
                        getFormulasAndGenerateTickets(products, invoiceId);
                    } else {
                        productList.innerHTML = '<p>Tidak ada produk untuk invoice ini.</p>';
                        document.getElementById('ticket-container').innerHTML = '';
                    }
                })
                .catch(error => console.error('Error fetching products:', error));
        }
    });

    function getFormulasAndGenerateTickets(products, invoiceId) {
        const currentYear = new Date().getFullYear();

        const totalTickets = products.reduce((sum, product) => sum + product.jumlah_tiket, 0);

        // Ambil data formula untuk invoice ini
        fetch(`/get-formulas/${invoiceId}`)
            .then(response => response.json())
            .then(formulas => {
                displayFormulas(formulas, totalTickets); // Tampilkan formula yang didapat
                getLastBatchNumberAndGenerateTickets(products); // Lanjutkan dengan tiket
            })
            .catch(error => console.error('Error fetching formulas:', error));
    }

    function displayFormulas(formulas, totalTickets) {
        formulaContainer.innerHTML = ''; // Kosongkan dulu isi formula
        
        formulas.forEach(formula => {
            const totalJumlah = formula.jumlah * totalTickets;
            const status = formula.stok_akhir >= totalJumlah ? 'Cukup' : 'Tidak Cukup';
            const formulaHtml = `
                <tr class="formula-item">
                    <td>${formula.nama_bahan_baku}</td>
                    <td>${totalJumlah}</td>
                    <td>${formula.satuan}</td>
                    <td>${formula.stok_akhir}</td>
                    <td>${status}</td> <!-- Menampilkan status -->
                </tr>
            `;

            formulaContainer.innerHTML += formulaHtml;
            formulaId = formula.id;
        });

        document.getElementById('formula-id').value = formulas.length ? formulas[formulas.length - 1].id : '';

    }

    function getLastBatchNumberAndGenerateTickets(products) {
        const currentYear = new Date().getFullYear();
        fetch(`/get-last-batch-number?year=${currentYear}`)
            .then(response => response.json())
            .then(data => {
                const lastProductionNumber = data.success ? data.lastProductionNumber : 0;
                generateTicketInputs(products, lastProductionNumber + 1);
            })
            .catch(error => console.error('Error fetching last batch number:', error));
    }

    function generateBatchNumber(productCode, currentYear, currentMonth, runningNumber) {
        const yearCode = (currentYear % 1000).toString().padStart(3, '0'); // 3 digit tahun
        const monthCode = currentMonth.toString().padStart(2, '0'); // 2 digit bulan
        const productCodeNumeric = extractNumericCode(productCode); // Ambil angka saja dari kode produk
        const runningCode = runningNumber.toString().padStart(3, '0'); // 3 digit angka urut

        return `${yearCode}${monthCode}${productCodeNumeric}${runningCode}`;
    }

    function extractNumericCode(codeProduct) {
        const numericCode = codeProduct.match(/\d+/g)?.join('') || '000'; // Jika tidak ada angka, default '000'
        return numericCode.slice(-3); // Ambil hanya 3 digit terakhir
    }

    function generateTicketInputs(products, startingNumber) {
        const ticketContainer = document.getElementById('ticket-container');
        ticketContainer.innerHTML = '';

        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;
        let runningNumber = startingNumber; // Mulai dari nomor batch terakhir + 1

        products.forEach(product => {
            const totalTickets = product.jumlah_tiket;

            for (let i = 1; i <= totalTickets; i++) {
                const batchNumber = generateBatchNumber(product.code_product, currentYear, currentMonth, runningNumber);
                runningNumber++; // Increment nomor urut

                const ticketHtml = `
                    <div class="warp-tikects row col-md-12">
                        <div class="col-md-3 mb-3">
                            <div class="input-group-outline input-group">
                                <input type="text" id="noBatch" name="batch_number[]" class="form-control" value="${batchNumber}" readonly>
                            </div>
                            <small class="text-danger">*nomor batch akan otomatis terisi oleh sistem</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group-outline input-group">
                                <input type="text" name="batch_size[]" placeholder="batch size" class="form-control" value="${product.ukurang_batch}">
                            </div>
                            <small>-Batch Size-</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group-outline input-group">
                                <input type="text" name="batch_size[]" placeholder="batch size" class="form-control" value="${product.hasil_satu_batch}">
                            </div>
                            <small>-Batch Size-</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group-outline input-group">
                                <input type="month" name="tanggal_expired[]" class="text-decoration-none form-control">
                            </div>
                            <small>-bulan dan tahun expired-</small>
                        </div>
                        <input type="hidden" id="product-id" name="product_id[]" value="${product.product_id}">
                    </div>
                `;

                ticketContainer.innerHTML += ticketHtml;
            }
        });
    }
});
 </script>

 @endsection