<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link rel="icon" href="">

    <title>Welcome To Komitkami!</title>
</head>

<style>
.flag-icon {
    margin-right: 8px;
    width: 24px;
    height: auto;
}
</style>

<body>
    <!-- navbar code -->
    <nav id="navbar" class="navbar py-3 navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="" width="200px" height="10%">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            Language
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ url('lang/en') }}"><img class="flag-icon"
                                                    src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/flags/4x3/gb.svg"
                                                    alt="UK Flag"> English</a></li>
                            <li><a class="dropdown-item" href="{{ url('lang/id') }}"><img class="flag-icon"
                                                    src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/flags/4x3/id.svg"
                                                    alt="Indonesia Flag"> Indonesia</a></li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#produksi">Produksi</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#nilai">Nilai kami</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#ourProduct">Produk Kami</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#siklus">Pelayanan</a>
                    </li>
                    <li class="nav-item {{ Request::is('/') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Kembali</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile-perusahaan') ? 'd-none' : '' }}">
                        <a class="nav-link active" aria-current="page" href="#contact">Kontak Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('profile-perusahaan') }}">Profile
                            Perusahaan</a>
                    </li>
                    <li class="nav-item btn btn-info p-0 rounded-pill">
                        @auth
                        <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">Dashboard</a>
                        @endauth
                        @guest
                        <a class="nav-link active" aria-current="page" href="{{ url('login') }}">Internal Login</a>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navbar code -->

    @yield('content')


    <button id="slideButton" class="visible">
        Kembali
    </button>

    <button id="WAButton">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </button>

    @include('widget.footer-welcome')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();

        document.getElementById('year').textContent = new Date().getFullYear();

        document.getElementById('WAButton').addEventListener('click', function() {
            window.open('https://wa.me/6281291238909', '_blank');
        });

        window.addEventListener('scroll', function() {
            // Show slide button after scrolling down
            const slideButton = document.getElementById('slideButton');
            if (window.scrollY > 50) {
                slideButton.classList.add('visible');
            } else {
                slideButton.classList.remove('visible');
            }
        });

        document.getElementById('slideButton').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>

</html>