@extends('frontend.layouts.app')

@section('title', 'Syarat & Ketentuan - Ayasha Cake & Cookies')

@section('content')

    <div class="container-fluid page-header py-5 mb-5"
         style="background: linear-gradient(rgba(139,90,43,.55), rgba(139,90,43,.55)), url('{{ asset('frontend/assets/img/banner4.png') }}') center center / cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="display-4 mb-3" style="font-family:'Playfair Display',serif;color:#2C1A0E;">Syarat & Ketentuan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                    <li class="breadcrumb-item active" style="color:#fff;">Syarat & Ketentuan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5 mb-5" style="max-width:800px;">
        <h2 style="font-family:'Playfair Display',serif;color:#2C1A0E;" class="mb-2">Syarat & Ketentuan Penggunaan</h2>
        <p class="text-muted mb-5" style="font-size:.88rem;">Terakhir diperbarui: {{ date('d F Y') }}</p>

        <div class="sk-section">
            <h5>1. Penerimaan Syarat</h5>
            <p>Dengan mengakses dan menggunakan website Ayasha Cake & Cookies, Anda menyetujui untuk terikat oleh syarat dan ketentuan yang berlaku. Jika Anda tidak menyetujui syarat ini, harap tidak menggunakan layanan kami.</p>
        </div>

        <div class="sk-section">
            <h5>2. Pemesanan Produk</h5>
            <p>Semua pesanan yang dilakukan melalui website ini tunduk pada ketersediaan produk. Kami berhak menolak atau membatalkan pesanan jika terjadi kesalahan harga, kehabisan stok, atau alasan lain yang kami anggap perlu. Konfirmasi pesanan akan dikirimkan setelah pembayaran berhasil diverifikasi.</p>
        </div>

        <div class="sk-section">
            <h5>3. Harga dan Pembayaran</h5>
            <p>Harga yang tercantum di website sudah termasuk pajak yang berlaku. Kami berhak mengubah harga sewaktu-waktu tanpa pemberitahuan sebelumnya. Pembayaran harus dilakukan sesuai metode yang tersedia dan dalam batas waktu yang ditentukan.</p>
        </div>

        <div class="sk-section">
            <h5>4. Pengiriman</h5>
            <p>Waktu pengiriman bersifat estimasi dan dapat berubah tergantung kondisi. Kami tidak bertanggung jawab atas keterlambatan yang disebabkan oleh pihak ketiga atau kondisi di luar kendali kami. Risiko kerusakan produk selama pengiriman menjadi tanggung jawab jasa pengiriman.</p>
        </div>

        <div class="sk-section">
            <h5>5. Pembatalan dan Pengembalian</h5>
            <p>Pembatalan pesanan dapat dilakukan sebelum proses produksi dimulai. Setelah produksi berjalan, pembatalan tidak dapat dilakukan. Pengembalian produk hanya dapat dilakukan jika terdapat kerusakan atau kesalahan dari pihak kami, dengan melampirkan bukti foto dalam 24 jam setelah produk diterima.</p>
        </div>

        <div class="sk-section">
            <h5>6. Hak Kekayaan Intelektual</h5>
            <p>Seluruh konten di website ini, termasuk gambar, teks, logo, dan desain, merupakan milik Ayasha Cake & Cookies dan dilindungi oleh hukum hak cipta yang berlaku. Dilarang menyalin atau menggunakan konten tanpa izin tertulis dari kami.</p>
        </div>

        <div class="sk-section">
            <h5>7. Perubahan Syarat</h5>
            <p>Kami berhak mengubah syarat dan ketentuan ini kapan saja. Perubahan akan berlaku segera setelah dipublikasikan di website. Penggunaan layanan kami setelah perubahan dianggap sebagai persetujuan Anda terhadap syarat yang baru.</p>
        </div>

        <div class="sk-section">
            <h5>8. Hubungi Kami</h5>
            <p>Jika Anda memiliki pertanyaan mengenai syarat dan ketentuan ini, silakan hubungi kami melalui halaman <a href="{{ route('kontak.index') }}" style="color:#8B5E3C;">Kontak</a>.</p>
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
