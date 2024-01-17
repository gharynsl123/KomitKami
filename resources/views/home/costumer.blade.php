@section('content')
<div class="container-fluid py-4">
    <div class="row card mx-4">
        <div class="col-12 mt-4">
            <div class="mb-5 row ps-3">
                <div class="col-6 d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-1">Persediaan Produk Anda</h6>
                        <p class="text-sm">{{Auth::user()->instansi->name ?? 'anda belum masuk instansi manapun'}}</p>
                    </div>
                </div>

                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark btn-sm mb-0" href="{{url('/view-order')}}"><i
                            class="material-icons text-sm">visibility</i>&nbsp;&nbsp;view order</a>
                </div>
            </div>
            <div class="row">
                @foreach($product as $items)
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain mb-4">
                        <div class="card-header p-0 mt-n4 mx-3">
                            <a class="d-block shadow-xl border-radius-xl">
                                <img src="{{asset('storage/product_images/'.$items->photo)}}" alt="img-blur-shadow"
                                    class="img-fluid shadow border-radius-xl w-50">
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-0 text-sm">Stok Tersedia {{$items->stok ?? '0'}}</p>
                            <a href="javascript:;">
                                <h5>
                                    {{$items->name}}
                                </h5>
                            </a>
                            <p class="mb-4 text-sm">
                                merek dari produk ini adalah 
                                <strong>
                                    {{$items->brand->name}}
                                </strong>
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection