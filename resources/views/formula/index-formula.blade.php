@extends('layouts.app')
@section('title-header', 'Formula')
@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">All List</h6>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="{{('/buat-formula-baru')}}"><i
                                class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Card</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    @foreach($formulas as $productId => $groupedFormulas)
                    <h6 class="text-sm"> Product Name:&nbsp;&nbsp;<span class="text-xs p">{{ $productNames[$productId] }}</span></h6>
                    <a href="{{ route('formula.detail', ['slug' => $formulaSlugs[$productId] ?? '' ]) }}"   class="text-decoration-none nav-link border-radius-lg">
                        <li class="list-group-item border-0 d-flex p-3 mb-4 bg-gray-300 border-radius-lg">
                            <div class="d-flex  m-0 p-0 flex-column">
                                <p class="mb-2 text-bold text-dark">Formula</p>
                                @foreach($groupedFormulas as $formula)
                                <span class="mb-2 text-xs">
                                    {{ $formula->nama_bahan_baku }}:
                                    <span class="text-dark font-weight-bold ms-sm-2">
                                        {{ $formula->jumlah }} {{ $formula->satuan }}
                                    </span>
                                </span>
                                @endforeach
                            </div>
                        </li>
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush