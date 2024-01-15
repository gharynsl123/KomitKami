<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <div class="navbar-brand m-0">
            <span class="ms-1 font-weight-bold text-white">Komitkami Intinusa Gemilang</span>
        </div>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{url('/dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('transaction') ? 'active bg-gradient-primary' : '' }}" href="{{url('transaction')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">monetization_on</i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('costumer') ? 'active bg-gradient-primary' : '' }}" href="{{url('/costumer')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">business</i>
                    </div>
                    <span class="nav-link-text ms-1">Costumer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('view-order') ? 'active bg-gradient-primary' : '' }}" href="{{('/view-order')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('user-configuration') ? 'active bg-gradient-primary' : '' }}" href="{{url('/user-configuration')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">User Configuration</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Internal</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('products') ? 'active bg-gradient-primary' : '' }}" href="{{url('/products')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">shopping_bag</i>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('merek') ? 'active bg-gradient-primary' : '' }}" href="{{url('/merek')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>
                    <span class="nav-link-text ms-1">Merek</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('formula') ? 'active bg-gradient-primary' : '' }}" href="{{url('/formula')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">create</i>
                    </div>
                    <span class="nav-link-text ms-1">Formula</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('local-inventory') ? 'active bg-gradient-primary' : '' }}" href="{{url('/local-inventory')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">store</i>
                    </div>
                    <span class="nav-link-text ms-1">Inventory</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('profile-user') ? 'active bg-gradient-primary' : '' }}" href="{{url('/profile-user')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('archive') ? 'active bg-gradient-primary' : '' }}" href="{{url('/archive')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">archive</i>
                    </div>
                    <span class="nav-link-text ms-1">Archive</span>
                </a>
            </li>
        </ul>
    </div>
</aside>