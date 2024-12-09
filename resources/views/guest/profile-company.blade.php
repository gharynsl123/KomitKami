@extends('welcome')

@section('content')
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

.hero {
    background: url('images/komitkami.jpeg') no-repeat center center/cover;
    color: white;
    height: 35rem;
    padding: 100px 0;
}

.investment-image img,
.product-requirement-content img,
.product-item img,
.gallery-images img {
    width: 100%;
    height: auto;
}

.gallery .slider {
    display: flex;
    overflow: hidden;
    position: relative;
    width: 100%;
    height: 300px;
    /* Adjust height as needed */
}

.gallery .slide {
    min-width: 300px;
    /* Set a fixed width for the slide */
    height: 300px;
    /* Set a fixed height for the slide */
    transition: transform 0.5s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    box-sizing: border-box;
    padding: 10px;
    /* Add some padding if needed */
}

.gallery .slide img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    /* Ensure image fits within the box */
}

.slider-pagination {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.slider-pagination .dot {
    height: 10px;
    width: 10px;
    margin: 0 5px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    cursor: pointer;
}

.slider-pagination .dot.active {
    background-color: #717171;
}
</style>

<!-- Hero Section -->
<section class="hero d-flex align-items-center">
    <div class="container">
        <p class="m-0 fw-bolder">THE COMPANY PROFILE</p>
        <p class="mb-3 fs-2 fw-lighter">PT Komitkami Intinusa Gemilang</p>
        <h1 class="fw-bolder">BUSINESS <br> COOPERATION</h1>
    </div>
</section>

<!-- Investment Section -->
<section class="investment py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div style="width:70%">
                    <h2>INVESTMEN</h2>
                    <hr>
                    <h3 class="fw-bolder">NEW
                        GROWTH
                        ENGINE</h3>
                    <p>For your business</p>

                    <p class="text-justify">Ada banyak alasan mengapa Anda harus memilih kami. <br> <br>

                        Kami membuat produk untuk merek Anda, membangun perusahaan Anda dengan produk berkualitas, dan
                        layanan pelanggan yang sangat baik. <br> <br>

                        Dengan banyaknya jenis produk dalam satu lini bisnis akan membuat promosi Anda lebih efektif.
                        <br> <br>

                        Gunakan kesempatan ini sebagai mesin penghasil keuntungan perusahaan Anda dengan cepat.
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="{{asset('images/gudang.jpeg')}}" class="div-hover" height="600px" alt="Investment">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values py-5 bg-light">
    <div class="container bg-light py-5">
        <!-- Vision and Mission Section -->
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="{{asset('images/icon.png')}}" alt="Company Image" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-8">
                <h3 class="text-primary">VISI KAMI</h3>
                <hr class="text-warning" style="height: 2px; width: 50px; margin-left: 0;">
                <p>"Menjadi perusahaan manufaktur alat kesehatan dan terintegrasi dengan institusi kesehatan dalam
                    menciptakan produk berkualitas tinggi dan jaminan mutu berkelanjutan"</p>
                <h3 class="text-primary">MISI KAMI</h3>
                <hr class="text-warning" style="height: 2px; width: 50px; margin-left: 0;">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Menghasilkan produk berkualitas tinggi dengan jaminan mutu sebagai prioritas utama.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Mewujudkan produk inovatif yang ramah lingkungan untuk kebutuhan praktisi kesehatan.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Membuat metode produksi yang baik, dan didukung teknologi dalam meningkatkan nilai perusahaan.
                    </li>
                </ul>
            </div>
        </div>
        <!-- Cooperation and Quality Policy Section -->
        <div class="row align-items-center mt-5">
            <div class="col-md-12">
                <h3 class="text-primary">KERJASAMA DENGAN KAMI</h3>
                <hr class="text-warning" style="height: 2px; width: 50px; margin-left: 0;">
                <p>Pabrik kami bergerak di bidang industri alat kesehatan, khusus cairan medis anti mikroba, yang diisi
                    oleh tenaga ahli dan berpengalaman dari Indonesia sebagai kekuatan kami dalam bekerja.</p>
                <h3 class="text-primary">KEBIJAKAN KUALITAS</h3>
                <hr class="text-warning" style="height: 2px; width: 50px; margin-left: 0;">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Mematuhi peraturan perundang-undangan yang berlaku dari Kementerian Kesehatan Republik
                        Indonesia.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Uji mutu produk di lembaga laboratorium yang memiliki sertifikasi akreditasi nasional.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Setiap produk memiliki kandungan dalam negeri untuk mendukung peraturan kementerian
                        perindustrian republik Indonesia.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Product Requirement Section -->
<section class="product-requirement py-5">
    <div class="container">
        <p class="m-0">we are following</p>
        <h2 class="fw-bolder">Product <span class="text-info">Requirement</span></h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{asset('images/produk-promosi.png')}}" alt="Product Requirement" class="img-fluid">
            </div>
            <div class="col-md-6">
                <img src="{{asset('images/proses-pembuatan.png')}}" alt="Product Requirement"
                    class="div-hover img-fluid">
            </div>
            <div class="col-md-12">
                <h3 class="text-primary">MISI KAMI</h3>
                <hr class="text-warning" style="height: 2px; width: 50px; margin-left: 0;">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Kami memproduksi produk dengan memberikan jaminan kualitas dan mengikuti peraturan produksi
                        sesuai dengan peraturan dari kementerian perindustrian dan kementerian kesehatan republik
                        Indonesia.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        Produk diuji secara berkala dengan catatan produksi yang dilaporkan langsung melalui formulir
                        online Kementerian Kesehatan.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-primary me-2"></i>
                        PT Komitkami Intinusa Gemilang sedang memproses sertifikat Cara Produksi Alat Kesehatan.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="products py-5 bg-light">
    <div class="container rounded-3 card border-0 shadow-lg p-0">
        <img src="{{asset('images/header-photos.png')}}" width="20%" alt="nilai kami">
        <div class="row row-cols-1 row-cols-md-4 justify-content-center my-4 g-4 px-4">
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center  h-auto">
                    <img src="{{asset('images/Botol-Hand-rub-Gel-Bracket-500ml.png')}}" class="div-hover" width="50%"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title">HAND SANITIZER</h5>
                        <p class="card-text text-justify">Dalam bentuk Cair dan bentuk Gel dengan variasi kemasan,
                            5L, 500ml, 100ml. Menggunakan zat aktif seperti Chlorhexidine dan Benzhol Konium.</p>
                    </div>
                </div>
            </div>
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center h-auto">
                    <img src="{{asset('images/Botol-HAND-SCRUB-500ml.png')}}" class="div-hover" width="50%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">HAND SCRUB</h5>
                        <p class="card-text text-justify">Sabun khusus untuk medis, dengan kandungan Chlorhexidine,
                            dalam variasi kemasan, 5L, 500ml, 75ml.</p>
                    </div>
                </div>
            </div>
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center h-auto">
                    <img src="{{asset('images/Botol-Disinfectant-5L.png')}}" class="div-hover" width="50%" class=""
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title">DISINFECTANT</h5>
                        <p class="card-text text-justify">Disinfektan untuk permukaan dengan bahan aktif H2o2 yang
                            sesuai untuk kebutuhan disinfectan permukaan. Kemasan 5 Liter.</p>
                    </div>
                </div>
            </div>
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center h-auto">
                    <img src="{{asset('images/Detergent-03-02.png')}}" class="div-hover" width="50%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">DETERGENT</h5>
                        <p class="card-text text-justify">Deterjen untuk pencucian peralatan medis, dengan model
                            manual perendaman dan mesin pencucian, dengan jenis kandungan Alkaline, Enzyme dan Rinse
                            Aid sebagai pembilas, kemasan tersedia 5 Liter.</p>
                    </div>
                </div>
            </div>
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center h-auto">
                    <img src="{{asset('images/Kotak-Alcohol-Swab-dan-Sandsetan.png')}}" class="div-hover" width="50%"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ALCOHOL SWAB</h5>
                        <p class="card-text text-justify">Tersedia dengan box isi 100 Pcs, dengan spesifikasi 2 Ply,
                            4 Ply, menggunakan Isoprophyl Alcohol dan Ethyl di tambah dengan zat aktif seperti
                            Chlorhexidine dan pilihan lainnya.</p>
                    </div>
                </div>
            </div>
            <div class="col div-hover" data-aos="zoom-in">
                <div class="text-center h-auto">
                    <img src="{{asset('images/Bracket-500ml.png')}}" class="div-hover" width="50%" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">BRACKET 500ml</h5>
                        <p class="card-text text-justify">This is a longer card with supporting text below as a
                            natural
                            lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="facilities py-5">
    <div class="container">
        <h2 class="text-center">Our Facilities</h2>
        <p class="text-center">Production</p>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="table-responsive" style="width:75%;">
                <table class="table table-bordered">
                    <tr>
                        <th>Factory Area</th>
                        <td>12 M x 30 M</td>
                    </tr>
                    <tr>
                        <th>Factory Building</th>
                        <td>12 M x 27 M</td>
                    </tr>
                    <tr>
                        <th>Factory Facilities</th>
                        <td>Main lobby of PT Komitkami Room of Komitkami Institute (Training & Meeting).</td>
                    </tr>
                    <tr>
                        <th>KING Laboratory</th>
                        <td>
                            <ul class="m-0">
                                <li>Lab of Microbiology</li>
                                <li>Lab of Development Product</li>
                                <li>Lab of Quality Control</li>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th>Production Area</th>
                        <td>Scaling Room, Mixing Room, Filling Room & Packing Area.</td>
                    </tr>
                    <tr>
                        <th>KING Where house</th>
                        <td>Chemical Raw Material, dry Raw Material, Packaging Raw Material, Quarantine Area, Finished
                            goods
                            warehouse, Receiving area.</td>
                    </tr>
                    <tr>
                        <th>Waste Managing</th>
                        <td>
                            <ul class="m-0">
                                <li>Hazardous wet waste</li>
                                <li>Dry Waste</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive" style="width:75%;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center">PRODUCTION CAPACITY</th>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <th>Production/Day (@ Batch)</th>
                            <th>Total/Batch (@ Bottle)</th>
                            <th>Total Production/Day (Bottle)</th>
                            <th>Total Production/Month (Bottle)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bottle - 500ml</td>
                            <td>5</td>
                            <td>200</td>
                            <td>1,000</td>
                            <td>20,000</td>
                        </tr>
                        <tr>
                            <td>Gallons - 5 Liter</td>
                            <td>5</td>
                            <td>20</td>
                            <td>100</td>
                            <td>2,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery mb-5 py-5">
    <div class="container text-center">
        <h2>Gallery</h2>
        <div class="slider" id="gallerySlider">
            @foreach($images as $item)
            <div class="slide">
                <img src="{{ $item->path }}" alt="{{ $item->title }}">
            </div>
            @endforeach
        </div>
        <div class="slider-pagination" id="sliderPagination"></div>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('#gallerySlider .slide');
    const pagination = document.getElementById('sliderPagination');
    let currentIndex = 0;

    // Create pagination dots
    slides.forEach((slide, index) => {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        if (index === 0) {
            dot.classList.add('active');
        }
        dot.addEventListener('click', () => goToSlide(index));
        pagination.appendChild(dot);
    });

    const dots = document.querySelectorAll('#sliderPagination .dot');

    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }

    function updateSlider() {
        const offset = -currentIndex * 100;
        slides.forEach(slide => {
            slide.style.transform = `translateX(${offset}%)`;
        });
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    function autoSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }

    setInterval(autoSlide, 3000); // Change slide every 3 seconds

    window.addEventListener('resize', () => {
        updateSlider(); // Ensure slider updates correctly on resize
    });

    // Initial update to set the correct slide
    updateSlider();
});
</script>
@endsection