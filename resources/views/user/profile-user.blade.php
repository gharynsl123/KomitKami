@extends('layouts.app')

@section('content')
<div class="page-header min-height-200 border-radius-xl"
    style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
    <span class="mask  bg-gradient-primary  opacity-6"></span>
</div>
<div class="card card-body mx-3 mx-md-4 mt-n6">
    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h5 class="mb-0">Profile Information</h5>
                            </div>
                            <div class="col-md-4 text-end">
                                <a @if(Auth::user()->level == 'Customer') href="{{url('/edit-profile/' . Auth::user()->id)}}"  @else href="{{url('/edit-user/'. Auth::user()->id)}}" @endif >
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Profile"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                    Name:</strong> &nbsp; {{Auth::user()->name}}</li>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">User
                                    Name:</strong> &nbsp; {{Auth::user()->username}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                    class="text-dark">Position:</strong> &nbsp; {{Auth::user()->level}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                &nbsp; {{Auth::user()->phone_number}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                &nbsp; {{Auth::user()->email}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                    class="text-dark">Location:</strong> &nbsp; {{Auth::user()->address}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                    class="text-dark">Password:</strong> &nbsp; {{Auth::user()->view_pass}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush