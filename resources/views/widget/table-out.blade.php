<div class="row">
    <div class="col-12">
        <div class="card px-4">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-borderless table-hover border border-0 align-items-center mb-0"
                        id="dataTableDefault">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    penanggung jawab
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Informasi Barang</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nomor Pengambilan</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Jumlah Barang Keluar</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction as $transaction)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $transaction->user ? $transaction->user->name : 'no user' }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $transaction->tanggal_transaksi }}</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-xs font-weight-bold mb-0">{{$transaction->inventory->name}}</h6>
                                    <p class="text-xs text-secondary mb-0">{{$transaction->inventory->code}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="mb-0 text-sm">{{ $transaction->nomor_pengambilan ?? 'none' }}</h6>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{$transaction->jumlah_barang}}</span>
                                </td>
                                <!-- tombol delete -->
                                <td class="align-middle">
                                    <form action="{{ url('/delete-item/'.$transaction->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-secondary btn font-weight-bold text-xs delete-link"
                                            data-toggle="tooltip" data-original-title="Delete item"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>