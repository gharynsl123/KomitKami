@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                        <h4 class="mb-0">$53k</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                        <h4 class="mb-0">2,300</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">New Clients</p>
                        <h4 class="mb-0">3,462</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sales</p>
                        <h4 class="mb-0">$103,430</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-7 mb-3">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Ordering Information</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{('/view-order')}}" class="btn btn-outline-primary btn-sm mb-0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Oliver Liam</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">delete</i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">edit</i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Lucas Harper</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">delete</i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">edit</i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Ethan James</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">delete</i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="material-icons text-sm me-2">edit</i>Edit</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Invoices</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{url('/transaction')}}" class="btn btn-outline-primary btn-sm mb-0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
                                <span class="text-xs">#MS-415646</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $180
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                        class="material-icons text-lg position-relative me-1">picture_as_pdf</i>
                                    PDF</button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10, 2021</h6>
                                <span class="text-xs">#RV-126749</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $250
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                        class="material-icons text-lg position-relative me-1">picture_as_pdf</i>
                                    PDF</button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>
                                <span class="text-xs">#FB-212562</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $560
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                        class="material-icons text-lg position-relative me-1">picture_as_pdf</i>
                                    PDF</button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>
                                <span class="text-xs">#QW-103578</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $120
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                        class="material-icons text-lg position-relative me-1">picture_as_pdf</i>
                                    PDF</button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>
                                <span class="text-xs">#AR-803481</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $300
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                        class="material-icons text-lg position-relative me-1">picture_as_pdf</i>
                                    PDF</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush