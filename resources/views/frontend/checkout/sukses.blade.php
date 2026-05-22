@extends('frontend.layouts.app')

@section('title', 'Pesanan Berhasil - Ayasha Cake & Cookies')

@section('styles')
<style>
    .sukses-wrap {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 16px;
    }
    .sukses-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(139,94,60,.12);
        padding: 52px 44px;
        max-width: 480px;
        width: 100%;
        text-align: center;
    }
    .sukses-icon {
        width: 80px;
        height: 80px;
        background: #dcfce7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .sukses-icon i {
        font-size: 2.2rem;
        color: #16a34a;
    }
    .sukses-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #2C1A0E;
        margin-bottom: 16px;
    }
    .sukses-desc {
        font-size: .92rem;
        color: #5a4a3a;
        line-height: 1.8;
        margin-bottom: 32px;
    }
    .btn-lihat-pesanan {
        display: inline-block;
        background: #8B5E3C;
        color: #fff;
        font-weight: 700;
        font-size: .95rem;
        padding: 13px 36px;
        border-radius: 50px;
        text-decoration: none;
        transition: background .2s, transform .1s;
        letter-spacing: .03em;
    }
    .btn-lihat-pesanan:hover {
        background: #6e4a2e;
        color: #fff;
        transform: translateY(-1px);
    }
    .btn-lanjut {
        display: block;
        margin-top: 14px;
        font-size: .82rem;
        color: #9ca3af;
        text-decoration: none;
    }
    .btn-lanjut:hover { color: #8B5E3C; }
    .wa-note {
        background: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: .82rem;
        color: #166534;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-align: left;
    }
</style>
@endsection

@section('content')
<div class="sukses-wrap">
    <div class="sukses-card">

        <div class="sukses-icon">
            <i class="fa fa-check"></i>
        </div>

        <div class="sukses-title">Pesanan Anda Berhasil!</div>

        <p class="sukses-desc">
            Terima kasih telah memesan di <strong>Ayasha Cake & Cookies</strong>.<br>
            Pesanan Anda sudah kami terima
            Silakan lanjutkan konfirmasi melalui WhatsApp.<br>
            Admin akan segera menghubungi Anda.
        </p>

        <div class="wa-note">
            <i class="fab fa-whatsapp" style="font-size:1.1rem;color:#16a34a;flex-shrink:0;"></i>
            <span>WhatsApp telah terbuka otomatis. Silakan kirim pesan untuk konfirmasi pesanan Anda.</span>
        </div>

        <a href="{{ route('akun.pesanan') }}" class="btn-lihat-pesanan">
            <i class="fa fa-box me-2"></i>Lihat Pesanan Saya
        </a>

        <a href="{{ route('produk.index') }}" class="btn-lanjut">
            Lanjut Belanja
        </a>

    </div>
</div>
@endsection
