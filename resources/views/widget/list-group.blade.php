<div class="mb-2">
    <a href="{{ url('/order-details/' . $items->invoice->slug) }}" class="text-decoration-none nav-link">
        <li class="list-group-item border-0 d-flex justify-content-between bg-gray-100 border-radius-lg">
            <div class="d-flex w-100 m-0 flex-column">
                <div class="mb-3">
                    @if(Auth::user()->level != 'Customer')
                    <span class="text-xs">Nama Perusahaan:
                        <span class="text-dark font-weight-bold ms-sm-2">
                            {{ $items->instansi->name }}
                        </span>
                    </span>
                    @endif
                </div>

                <div class="d-flex row">
                    <div class="col-md-3" >
                        <p class="m-0 text-xs">Nomor PO :</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->nomor_invoice }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="m-0 text-xs">Di Pesan Pada Tanggal:</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->created_at->format('d/m/Y')}}
                        </p>
                    </div> 
                    <div class="col-md-3">
                        <p class="m-0 text-xs">Estimasi Kedatangan:</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->estimate_arrive ? \Carbon\Carbon::parse($items->invoice->estimate_arrive)->format('d/m/Y') : '*Belum Ditentukan' }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="m-0 text-xs">Total Harga:</p>
                        <p class="text-dark font-weight-bold">
                            @currency($items->invoice->total_harga)
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <span class="text-xs">Status:
                    <br>
                    <span
                        class="badge @if($items->status == 'pending') bg-gradient-secondary @else bg-gradient-success @endif font-weight-bold">
                        @if($items->status == 'pending')
                        Di PT.Komitkami
                        @else
                        {{ $items->status }}
                        @endif
                    </span>
                </span>

                @if(Auth::user()->level != 'Customer' && $items->status == 'pending')
                <div>
                    <btn href="{{ url('/order-details/' . $items->invoice->slug)}}"
                        class="text-xs btn p-0 text-success  mb-0">
                        Disetujui
                    </btn>
                    <i class="material-icons text-success me-2">check</i>
                </div>
                @endif
            </div>
        </li>
    </a>
</div>