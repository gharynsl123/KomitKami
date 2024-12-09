<style>
.form-select {
    padding: 0.25rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
    border: 1px solid #ddd;
    width: auto;
}
</style>

<div class="mb-2">
    <li class="list-group-item border-0 d-flex justify-content-between bg-gray-100 border-radius-lg">
        <a href="{{ url('/order-details/' . $items->invoice->slug) }}" class="text-decoration-none w-100 nav-link">
            <div class="d-flex w-100 m-0 flex-column">
                <div class="mb-3">
                    @if(Auth::user()->level != 'Customer')
                    <span class="text-xs">Nama Perusahaan:
                        <span class="text-dark font-weight-bold ms-sm-2">
                            {{ $items->user->name }}
                        </span>
                    </span>
                    @endif
                </div>

                <div class="d-flex row">
                    <div class="col-md-3">
                        <p class="m-0 text-xs">Nomor PO :</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->nomor_invoice }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="m-0 text-xs">Di Pesan Pada Tanggal:</p>
                        <p class="text-dark font-weight-bold">
                            {{ $items->invoice->created_at->format('d/m/Y H:m:s')}}
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
        </a>
        <div>
            <span class="text-xs">Status:
                <br>
                @if($items->invoice->status != 'pending' && in_array(Auth::user()->level, ['admin', 'marketing communication']))
                <form action="{{ route('update-status', $items->invoice->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="accept" @if($items->invoice->status == 'accept') selected @endif>diterima</option>
                        <option value="process" @if($items->invoice->status == 'process') selected @endif>diproses</option>
                        <option value="On The Way" @if($items->invoice->status == 'On The Way') selected @endif>Dikirim</option>
                        <option value="arrived" @if($items->invoice->status == 'arrived') selected @endif>Telah Sampai</option>
                        <option value="done" @if($items->invoice->status == 'done') selected @endif>Paid (Lunas)</option>
                    </select>
                </form>
                @elseif (Auth::user()->level == 'customer')
                <span
                    class="badge bg-gradient-success font-weight-bold">
                    {{$items->invoice->status}}
                </span>
                @else
                <span
                    class="badge bg-gradient-secondary font-weight-bold">
                    {{$items->invoice->status}}
                </span>
                @endif
            </span>

            @if((Auth::user()->level == 'admin' || Auth::user()->level == 'marketing communication') && $items->status == 'pending')
            <div>
                <a href="{{ url('/order-details/' . $items->invoice->slug)}}"
                    class="text-xs btn p-0 text-success  mb-0">
                    Setujui
                </a>
                <i class="material-icons text-success me-2">check</i>
            </div>
            @endif
        </div>
    </li>
</div>