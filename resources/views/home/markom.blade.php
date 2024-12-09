@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Requesting Approval Order</h6>
                    </div>

                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark btn-sm mb-0" href="{{url('/view-order')}}"><i
                                class="material-icons text-sm">visibility</i>&nbsp;&nbsp;View All Order</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    @forelse($groupedOrders->where('status' , 'pending') as $items)
                    @include('widget.list-group')
                    @empty
                    <p class="text-center">no orders waiting for requests</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection