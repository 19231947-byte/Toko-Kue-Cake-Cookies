@extends('frontend.layouts.app')

@section('title', 'Beranda - Ayasha Cake & Cookies')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
@endsection

@section('content')

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('frontend/assets/img/banner1.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn">Selamat Datang di <strong class="text-light">Ayasha Cake & Cookies</strong></p>
                                    <h1 class="display-1 text-light mb-4 animated zoomIn">Kue Lezat & Berkualitas untuk Setiap Momen</h1>
                                    <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('frontend/assets/img/banner2.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn">Selamat Datang di <strong class="text-light">Ayasha Cake & Cookies</strong></p>
                                    <h1 class="display-1 text-light mb-4 animated zoomIn">Dibuat dengan Cinta, Disajikan dengan Sempurna</h1>
                                    <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded shadow w-100" style="object-fit:cover; height:220px;" src="{{ asset('frontend/assets/img/tentang1.png') }}" alt="tentang kami">
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.2s">
                            <img class="img-fluid rounded shadow w-100" style="object-fit:cover; height:220px;" src="{{ asset('frontend/assets/img/tentang2.png') }}" alt="tentang kami">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Tentang Kami</p>
                        <h1 class="display-6">Perjalanan Ayasha Cake & Cookies dalam Menyajikan Kue Berkualitas</h1>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-8">
                            <h5>Kue kami dibuat dengan bahan pilihan dan rasa terbaik</h5>
                            <p class="mb-0">Ayasha Cake & Cookies menghadirkan berbagai macam kue seperti nastar, putri salju, dan aneka kue lainnya yang dibuat dengan bahan berkualitas serta proses yang higienis untuk menghasilkan cita rasa terbaik.</p>
                        </div>
                    </div>
                    <div class="border-top mb-4"></div>
                    <div class="row g-3">
                        <div class="col-sm-8">
                            <h5>Kelezatan yang cocok untuk setiap momen spesial</h5>
                            <p class="mb-0">Produk kami cocok untuk berbagai acara seperti hari raya, ulang tahun, maupun sebagai hadiah untuk orang terdekat. Kami selalu berkomitmen memberikan kualitas dan pelayanan terbaik untuk kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Products Start -->
    <div class="container-fluid product py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Kategori Produk</p>
                <h1 class="display-6">Pilihan Kue Spesial untuk Setiap Momen</h1>
            </div>
            <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
                <a href="{{ route('produk.index', ['kategori_nama' => 'Eid Cookies']) }}" class="d-block product-item rounded">
                    <img src="{{ asset('frontend/assets/img/eid_cookies.png') }}" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Eid Cookies</h4>
                        <span class="text-body">Kue kering spesial dengan berbagai varian rasa yang renyah dan lezat, cocok untuk menemani momen hari raya bersama keluarga</span>
                    </div>
                </a>
                <a href="{{ route('produk.index', ['kategori_nama' => 'Soft Cakes']) }}" class="d-block product-item rounded">
                    <img src="{{ asset('frontend/assets/img/soft_cakes.png') }}" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Soft Cakes</h4>
                        <span class="text-body">Kue lembut dengan tekstur moist dan rasa manis yang pas, cocok untuk camilan harian maupun acara spesial</span>
                    </div>
                </a>
                <a href="{{ route('produk.index', ['kategori_nama' => 'Birthday Cakes']) }}" class="d-block product-item rounded">
                    <img src="{{ asset('frontend/assets/img/birthday_cake.png') }}" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Birthday Cakes</h4>
                        <span class="text-body">Kue ulang tahun custom dengan desain menarik dan rasa premium, dibuat khusus untuk merayakan momen terbaik Anda</span>
                    </div>
                </a>
                <a href="{{ route('produk.index', ['kategori_nama' => 'Snack Box']) }}" class="d-block product-item rounded">
                    <img src="{{ asset('frontend/assets/img/snack_box.png') }}" alt="">
                    <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                        <h4 class="text-primary">Snack Box</h4>
                        <span class="text-body">Paket camilan praktis dengan berbagai pilihan kue dan snack, cocok untuk acara kantor, arisan, atau kumpul keluarga</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
@endsection
