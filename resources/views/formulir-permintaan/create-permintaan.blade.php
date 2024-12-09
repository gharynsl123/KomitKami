@extends('layouts.app')
@section('content')
<form action="{{ route('permintaan_material.store') }}" method="POST">
    @csrf
    <!-- Hidden field untuk produksi_id -->
    <input type="hidden" name="produksi_id" value="{{ $produksi->id }}"> <!-- Pastikan $produksi ada di controller -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bahan Baku</th>
                <th>Penggunaan Bahan Baku</th>
                <th>Jumlah Permintaan</th>
                <th>Jumlah Yang di sediakan</th>
                <th>Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formula as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_bahan_baku }}</td>
                <td>
                    <input type="hidden" name="formula_id[]" value="{{ $item->id }}">
                    <input type="text" class="form-control" value="{{ $item->product->name ?? '' }}" disabled>
                </td>
                <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                <td>
                    <input type="number" class="form-control" name="jumlah_yang_di_sediakan[]" placeholder="Jumlah yang disediakan">
                </td>
                <td>
                    <select name="persetujuan[]" class="form-control">
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
</form>
@endsection