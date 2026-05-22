@extends('frontend.layouts.app')

@section('title', 'FAQ - Ayasha Cake & Cookies')

@section('content')

    <div class="container-fluid page-header py-5 mb-5"
         style="background: linear-gradient(rgba(139,90,43,.55), rgba(139,90,43,.55)), url('{{ asset('frontend/assets/img/banner4.png') }}') center center / cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="display-4 mb-3" style="font-family:'Playfair Display',serif;color:#2C1A0E;">FAQ</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                    <li class="breadcrumb-item active" style="color:#fff;">FAQ</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5 mb-5" style="max-width:800px;">
        <h2 style="font-family:'Playfair Display',serif;color:#2C1A0E;" class="mb-2">Pertanyaan yang Sering Diajukan</h2>
        <p class="text-muted mb-5" style="font-size:.9rem;">Temukan jawaban atas pertanyaan umum seputar produk dan layanan kami.</p>

        <div class="accordion" id="faqAccordion">

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Bagaimana cara memesan produk?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Pilih produk yang Anda inginkan, tambahkan ke keranjang, lalu lanjutkan ke halaman checkout. Isi data pemesan dan konfirmasi pesanan. Setelah itu, Anda akan diarahkan untuk konfirmasi melalui WhatsApp agar pesanan segera diproses.
                    </div>
                </div>
            </div>

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Berapa lama waktu pembuatan pesanan?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Waktu pembuatan bervariasi tergantung jenis produk. Kue kering biasanya membutuhkan 2–3 hari kerja, sedangkan kue custom seperti kue ulang tahun memerlukan 3–5 hari kerja. Kami sarankan memesan lebih awal agar pesanan dapat diproses tepat waktu.
                    </div>
                </div>
            </div>

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Apakah bisa custom desain kue?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Tentu bisa! Kami menerima pesanan custom desain kue untuk berbagai acara seperti ulang tahun, pernikahan, dan acara spesial lainnya. Silakan hubungi kami melalui halaman <a href="{{ route('kontak.index') }}" style="color:#8B5E3C;">Kontak</a> atau WhatsApp untuk mendiskusikan desain yang Anda inginkan.
                    </div>
                </div>
            </div>

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        Metode pembayaran apa saja yang tersedia?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Kami menerima pembayaran melalui transfer bank. Detail rekening dan instruksi pembayaran akan ditampilkan setelah Anda melakukan checkout. Konfirmasi pembayaran dilakukan melalui WhatsApp ke admin kami.
                    </div>
                </div>
            </div>

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Bagaimana cara melacak status pesanan?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Anda dapat memantau status pesanan melalui menu "Pesanan Saya" di halaman akun setelah login. Status akan diperbarui oleh admin sesuai perkembangan pesanan Anda.
                    </div>
                </div>
            </div>

            <div class="accordion-item faq-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        Apakah tersedia layanan pengantaran?
                    </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body faq-body">
                        Ya, kami menyediakan layanan pengantaran ke beberapa wilayah. Untuk informasi lebih lanjut mengenai area pengantaran dan biaya ongkir, silakan hubungi kami melalui WhatsApp atau halaman <a href="{{ route('kontak.index') }}" style="color:#8B5E3C;">Kontak</a>.
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5 p-4 rounded" style="background:#FDF6F0;border:1px solid #e8d9cc;">
            <p class="mb-1" style="font-weight:600;color:#2C1A0E;">Masih ada pertanyaan?</p>
            <p class="text-muted mb-3" style="font-size:.88rem;">Jangan ragu untuk menghubungi kami langsung.</p>
            <a href="{{ route('kontak.index') }}" class="btn-kirim" style="text-decoration:none;display:inline-block;">
                <i class="fa fa-envelope me-2"></i> Hubungi Kami
            </a>
        </div>
    </div>

@endsection

@section('styles')
<style>
.faq-item { border: 1px solid #ede3da; border-radius: 10px !important; margin-bottom: 12px; overflow: hidden; }
.faq-btn { font-weight: 600; font-size: .92rem; color: #2C1A0E; background: #fff; box-shadow: none; }
.faq-btn:not(.collapsed) { color: #8B5E3C; background: #FDF6F0; box-shadow: none; }
.faq-btn::after { filter: none; }
.faq-btn:not(.collapsed)::after { filter: none; }
.faq-body { font-size: .88rem; color: #5a4a3a; line-height: 1.7; background: #fff; }
.btn-kirim { background: #8B5E3C; color: #fff; border: none; padding: 10px 28px; border-radius: 50px; font-size: .88rem; font-weight: 600; cursor: pointer; transition: background .2s; }
.btn-kirim:hover { background: #6e4a2e; color: #fff; }
</style>
@endsection
