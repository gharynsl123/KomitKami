<div class="mb-4">
    <a href="{{ url('/order-details/' . $items->invoice->slug) }}" class="text-decoration-none nav-link">
        <li class="list-group-item border-0 d-flex justify-content-between p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex w-100 flex-column">
                <h6 class="mb-3  text-sm">Nomor Invoice : {{ $items->invoice->nomor_invoice }}</h6>
                @if(Auth::user()->level != 'Customer')
                <span class="mb-2 text-xs">Company Name:
                    <span class="text-dark font-weight-bold ms-sm-2">
                        {{ $items->instansi->name }}
                    </span>
                </span>
                @endif
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-2 text-xs">Arrive Estimation:</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->estimate_arrive ? \Carbon\Carbon::parse($items->invoice->estimate_arrive)->format('d/m/Y') : '*Belum Ditentukan' }}
                        </p>
                    </div>
                    <div>
                        <p class="mb-2 text-xs">Order At:</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->created_at->format('d/m/Y') ? $items->invoice->created_at->format('d/m/Y') : '*Belum Ditentukan' }}
                        </p>
                    </div>
                    <div>
                        <p class="mb-2 text-xs">Total Jenis Barang:</p>
                        <p class="text-dark font-weight-bold">
                            <!-- disini kode hitung barang -->
                        </p>
                    </div>
                    <div>
                        <p class="mb-2 text-xs">Total Harga:</p>
                        <p class="text-dark font-weight-bold">
                            @currency($items->invoice->total_harga)
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-end ms-4">
                <span class="text-xs">status:
                    <br>
                    <span
                        class="  badge @if($items->status == 'pending') bg-gradient-secondary @else bg-gradient-success @endif font-weight-bold">
                        @if($items->status == 'pending')
                        In PT.Komitkami
                        @else
                        {{ $items->status }}
                        @endif
                    </span>
                </span>

                @if(Auth::user()->level != 'Customer' && $items->status == 'pending')
                <div class="ms-1">
                    <btn href="{{ url('/order-details/' . $items->invoice->slug)}}"
                        class="text-xs btn p-0 text-success  mb-0">
                        approve
                    </btn>
                    <i class="material-icons text-success me-2">check</i>
                </div>
                @endif
            </div>
        </li>
    </a>
</div>