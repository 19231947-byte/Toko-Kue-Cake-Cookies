@extends('frontend.layouts.app')

@section('title', 'Kebijakan Privasi - Ayasha Cake & Cookies')

@section('content')

    <div class="container-fluid page-header py-5 mb-5"
         style="background: linear-gradient(rgba(139,90,43,.55), rgba(139,90,43,.55)), url('{{ asset('frontend/assets/img/banner4.png') }}') center center / cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="display-4 mb-3" style="font-family:'Playfair Display',serif;color:#2C1A0E;">Kebijakan Privasi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                    <li class="breadcrumb-item active" style="color:#fff;">Kebijakan Privasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5 mb-5" style="max-width:800px;">
        <h2 style="font-family:'Playfair Display',serif;color:#2C1A0E;" class="mb-2">Kebijakan Privasi</h2>
        <p class="text-muted mb-5" style="font-size:.88rem;">Terakhir diperbarui: {{ date('d F Y') }}</p>

        <div class="sk-section">
            <h5>1. Informasi yang Kami Kumpulkan</h5>
            <p>Kami mengumpulkan informasi yang Anda berikan secara langsung saat mendaftar atau melakukan pemesanan, meliputi nama lengkap, alamat email, nomor telepon, dan alamat pengiriman. Kami juga mengumpulkan data teknis seperti alamat IP dan informasi browser secara otomatis.</p>
        </div>

        <div class="sk-section">
            <h5>2. Penggunaan Informasi</h5>
            <p>Informasi yang kami kumpulkan digunakan untuk memproses pesanan Anda, mengirimkan konfirmasi dan pembaruan status pesanan, meningkatkan layanan dan pengalaman pengguna, serta menghubungi Anda terkait pertanyaan atau keluhan yang Anda ajukan.</p>
        </div>

        <div class="sk-section">
            <h5>3. Keamanan Data</h5>
            <p>Kami berkomitmen untuk melindungi data pribadi Anda. Seluruh informasi disimpan dengan aman menggunakan enkripsi standar industri. Kami tidak akan menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum.</p>
        </div>

        <div class="sk-section">
            <h5>4. Berbagi Informasi dengan Pihak Ketiga</h5>
            <p>Kami dapat berbagi informasi Anda dengan mitra terpercaya yang membantu operasional kami, seperti jasa pengiriman, hanya sebatas yang diperlukan untuk memproses pesanan Anda. Pihak ketiga tersebut wajib menjaga kerahasiaan data Anda.</p>
        </div>

        <div class="sk-section">
            <h5>5. Cookie</h5>
            <p>Website kami menggunakan cookie untuk meningkatkan pengalaman pengguna, menyimpan preferensi, dan menganalisis trafik website. Anda dapat menonaktifkan cookie melalui pengaturan browser, namun beberapa fitur website mungkin tidak berfungsi optimal.</p>
        </div>

        <div class="sk-section">
            <h5>6. Hak Anda</h5>
            <p>Anda memiliki hak untuk mengakses, memperbarui, atau menghapus data pribadi Anda kapan saja. Untuk menggunakan hak tersebut, silakan hubungi kami melalui halaman <a href="{{ route('kontak.index') }}" style="color:#8B5E3C;">Kontak</a>.</p>
        </div>

        <div class="sk-section">
            <h5>7. Perubahan Kebijakan</h5>
            <p>Kami dapat memperbarui kebijakan privasi ini sewaktu-waktu. Perubahan akan dipublikasikan di halaman ini beserta tanggal pembaruan. Kami menyarankan Anda untuk meninjau halaman ini secara berkala.</p>
        </div>

        <div class="sk-section">
            <h5>8. Hubungi Kami</h5>
            <p>Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami melalui halaman <a href="{{ route('kontak.index') }}" style="color:#8B5E3C;">Kontak</a>.</p>
        </div>
    </div>

@endsection

@section('styles')
<style>
.sk-section { margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #f0e8e0; }
.sk-section:last-child { border-bottom: none; }
.sk-section h5 { color: #2C1A0E; font-weight: 700; margin-bottom: .75rem; }
.sk-section p { color: #5a4a3a; font-size: .9rem; line-height: 1.8; margin: 0; }
</style>
@endsection
