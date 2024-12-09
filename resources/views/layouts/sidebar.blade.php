<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header bg-white">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <div class="navbar-brand m-0">
            <a href="{{url('/')}}">
                <img src="{{asset('images/logo.jpg')}}" width="100%" heigth="100%" alt="" srcset="">
            </a>
        </div>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::user()->level != 'employe')
            @if(!in_array(Auth::user()->level, ['production spv', 'inventory manager']))
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    @if(Auth::user()->level == 'production spv')
                    <span class="nav-link-text ms-1">Jadwal Tiket</span>
                    @else
                    <span class="nav-link-text ms-1">Dashboard</span>
                    @endif
                </a>
            </li>
            @endif


            @if(!in_array(Auth::user()->level, ['production manager', 'production qc', 'production spv', 'inventory manager']))
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('view-order') ? 'active bg-gradient-primary' : '' }}"
                    href="{{('/view-order')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Pesanan Pembelian</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('catatan-po') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/catatan-po')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">content_paste</i>
                    </div>
                    <span class="nav-link-text ms-1">Mutasi Pembelian</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('payment-pre-order') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/payment-pre-order')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">attach_money</i>
                    </div>
                    <span class="nav-link-text ms-1">Pembayaran Belum Lunas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('barang-siap-kirim') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/barang-siap-kirim')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_shipping</i>
                    </div>
                    <span class="nav-link-text ms-1">Product siap dikirim</span>
                </a>
            </li>
            @endif

            @if(in_array(Auth::user()->level, ['production manager', 'production qc', 'production spv']))
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Produksi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('ruang-produksi') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/ruang-produksi')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">insert_chart</i>
                    </div>
                    <span class="nav-link-text ms-1">Mulai Produksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('formula') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/formula')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">create</i>
                    </div>
                    <span class="nav-link-text ms-1">Formula</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('permintaan-material') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/permintaan-material')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_chart</i>
                    </div>
                    <span class="nav-link-text ms-1">Permintaan Material</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->level == 'admin')
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('user-configuration') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/user-configuration')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Konfigurasi Pengguna</span>
                </a>
            </li>
            @endif
            
            @if(Auth::user()->level != 'customer')
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Internal</h6>
            </li>
            @if(Auth::user()->level != 'marketing communication' )
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('transaction/in') ? 'active bg-gradient-primary' : '' }}"
                href="{{url('transaction/in')}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">compare_arrows</i>
                    </div>
                    <span class="nav-link-text ms-1">Proses input barang</span>
                </a>
            </li>
            @if(Auth::user()->level == 'inventory manager')
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('permintaan-material') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/permintaan-material')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_chart</i>
                    </div>
                    <span class="nav-link-text ms-1">Permintaan Material</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('transaction/out') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('transaction/out')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">compare_arrows</i>
                    </div>
                    <span class="nav-link-text ms-1">Proses keluar barang</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('local-inventory') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/local-inventory')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">store</i>
                    </div>
                    <span class="nav-link-text ms-1">Rekap stok Barang</span>
                </a>
            </li>
            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'marketing communication')
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('products') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/products')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">shopping_bag</i>
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('merek') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/merek')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>
                    <span class="nav-link-text ms-1">Merek</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Ruang Produksi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('atur-ruang-produksi') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/atur-ruang-produksi')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">factory</i>
                    </div>
                    <span class="nav-link-text ms-1">Ruang Produksi setting</span>
                </a>
            </li>
            @endif
            @endif
            <hr class="horizontal light mt-0 mb-2">
            @else
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Ruang Produksi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">insert_chart</i>
                    </div>
                    <span class="nav-link-text ms-1">List Produksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('riwayat-produksi') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/riwayat-produksi')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">history</i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Produksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('atur-ruang-produksi') ? 'active bg-gradient-primary' : '' }}"
                    href="{{url('/atur-ruang-produksi')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">factory</i>
                    </div>
                    <span class="nav-link-text ms-1">Ruang Produksi setting</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>