<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5">
    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-3 col-md-6">
                <img src="{{ asset('frontend/assets/img/nama_brand.png') }}" alt="Ayasha" style="height:80px;" class="mb-3">
                <p class="text-light" style="font-size:.85rem;">Ayasha Cake & Cookies menghadirkan kue berkualitas dengan bahan pilihan untuk setiap momen spesial Anda.</p>
                <div class="mt-3">
                    <img src="{{ asset('frontend/assets/img/halal.png') }}" alt="Halal Indonesia" style="height:80px; width:auto;">
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-primary mb-4">Tentang Kami</h5>
                <a class="btn btn-link text-start ps-0" href="{{ route('home') }}">Beranda</a>
                <a class="btn btn-link text-start ps-0" href="{{ route('produk.index') }}">Produk</a>
                <a class="btn btn-link text-start ps-0" href="{{ route('kontak.index') }}">Kontak</a>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-primary mb-4">Pusat Bantuan</h5>
                <a class="btn btn-link text-start ps-0" href="{{ route('faq') }}">FAQ</a>
                <a class="btn btn-link text-start ps-0" href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a>
                <a class="btn btn-link text-start ps-0" href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-primary mb-4">Kontak Kami</h5>
                <p class="mb-2 text-light" style="font-size:.85rem;"><i class="fa fa-map-marker-alt text-primary me-2"></i>Jl. Musyawarah, Kebon Jeruk, Kota Jakarta Barat, DKI Jakarta Barat</p>
                <p class="mb-2 text-light" style="font-size:.85rem;"><i class="fa fa-phone-alt text-primary me-2"></i>+62 857 1762 8133</p>
                <p class="mb-2 text-light" style="font-size:.85rem;"><i class="fa fa-envelope text-primary me-2"></i>yashadiyah@gmail.com</p>
                <p class="mb-0 text-light" style="font-size:.85rem;"><i class="fa fa-clock text-primary me-2"></i>Senin–Sabtu, 08.00–20.00</p>
            </div>

        </div>
    </div>
</div>
<!-- Footer End -->
