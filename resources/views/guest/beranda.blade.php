@extends('welcome')
@section('content')
<section id="beranda">
    <div class="container">
        <div class="row g-4 mt-5">
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <h4 class="m-0" data-aos="fade-right" data-aos-delay="500">{{ __('company_name') }}</h4>
                    <h1 class="m-0" data-aos="fade-right" data-aos-delay="700">{{__('investment_strategy')}}</h1>

                    <p class="mt-3" data-aos="fade-right" data-aos-delay="900" style="text-align: justify;">
                        {!! nl2br(e(__('investment_description'))) !!}
                    </p>

                </div>
                <a href="#contact" style="background-color: #BDE1FA;" data-aos="fade-right" data-aos-delay="1100" class="btn px-5 py-2 rounded-pill">
                    {{__('contact_us')}}</a>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <img data-aos="fade-left" src="{{asset('images/inventasi.png')}}" alt="" width="100%" height="100%"
                        srcset="">
                </div>
            </div>
        </div>
    </div>
</section>
<hr id="produksi" style="background-color:#49414167;" class="my-5">
<section>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('images/produk-promosi.png')}}" alt="produksi yang berkualitas" width="35%"
                        height="35%">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <h4 class="m-0">{{__('high')}}</h4>
                    <h1 class="m-0">{{__('quality_products')}}</h1>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
    <div style="width: 75%;">
        <h3 class="m-0">{!! nl2br(e(__('how_we_make_it'))) !!}</h3>
        <p class="m-0" style="text-align: justify;">{!! nl2br(e(__('how_we_make_it_description'))) !!}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="d-flex justify-content-end">
        <img src="{{ asset('images/proses-pembuatan.png') }}" alt="produksi yang berkualitas" width="100%" height="100%" class="div-hover">
    </div>
</div>
</div>
</div>
</section>
<hr id="nilai" style="background-color:#49414167;" class="my-5">
<section>
<div class="container d-flex justify-content-center align-items-center flex-column">
    <img src="{{ asset('images/nilai-kami.png') }}" width="40%" class="div-hover" alt="nilai kami">
    <h2 class="fw-light m-0">{{ __('what_differentiates_us') }}</h2>
    <p class="mt-3" style="text-align:justify; width:75%">{!! nl2br(e(__('what_differentiates_us_description'))) !!}</p>
</div>
</section>
<hr id="ourProduct" style="background-color:#49414167;" class="my-5">
<section>
<div class="container rounded-3 card border-0 shadow-lg p-0">
    <img src="{{ asset('images/header-photos.png') }}" width="20%" alt="nilai kami">
    <div class="row row-cols-1 row-cols-md-4 justify-content-center my-4 g-4 px-4">
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Botol-Hand-rub-Gel-Bracket-500ml.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('hand_sanitizer') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('hand_sanitizer_description'))) !!}</p>
                </div>
            </div>
        </div>
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Botol-HAND-SCRUB-500ml.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('hand_scrub') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('hand_scrub_description'))) !!}</p>
                </div>
            </div>
        </div>
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Botol-Disinfectant-5L.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('disinfectant') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('disinfectant_description'))) !!}</p>
                </div>
            </div>
        </div>
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Detergent-03-02.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('detergent') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('detergent_description'))) !!}</p>
                </div>
            </div>
        </div>
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Kotak-Alcohol-Swab-dan-Sandsetan.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('alcohol_swab') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('alcohol_swab_description'))) !!}</p>
                </div>
            </div>
        </div>
        <div class="col div-hover" data-aos="zoom-in">
            <div class="text-center h-auto">
                <img src="{{ asset('images/Bracket-500ml.png') }}" class="div-hover" width="50%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ __('bracket_500ml') }}</h5>
                    <p class="card-text text-justify">{!! nl2br(e(__('bracket_500ml_description'))) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<hr id="siklus" style="background-color:#49414167;" class="my-5">
<section>
<div class="container">
    <div class="row g-4 mt-5">
        <div class="col-md-6">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('images/siklus.png') }}" alt="" width="70%" height="100%" srcset="" class="div-hover">
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h1 class="m-0">{{ __('note') }}</h1>
                <p class="mt-3" style="text-align: justify;">{!! nl2br(e(__('note_description'))) !!}</p>
            </div>
        </div>
    </div>
</div>
</section>
<hr style="background-color:#49414167;" class="my-5">
@endsection