@extends('frontend.layouts.app')

@section('title', 'Pesanan Saya - Ayasha Cake & Cookies')

@section('styles')
<style>
    .akun-wrap { background:#fdf6f0;min-height:60vh;padding:40px 0 60px; }
    .sidebar-card { background:#fff;border-radius:16px;box-shadow:0 2px 16px rgba(139,94,60,.08);overflow:hidden; }
    .sidebar-header { background:linear-gradient(135deg,#8B5E3C,#C9956A);padding:24px 20px;text-align:center; }
    .sidebar-avatar { width:64px;height:64px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 10px;border:2px solid rgba(255,255,255,.4); }
    .sidebar-name { font-weight:700;color:#fff;font-size:1rem;margin-bottom:2px; }
    .sidebar-email { font-size:.75rem;color:rgba(255,255,255,.75); }
    .sidebar-nav { padding:10px 0; }
    .sidebar-nav a { display:flex;align-items:center;gap:10px;padding:11px 20px;font-size:.88rem;color:#5a4a3a;text-decoration:none;transition:background .15s; }
    .sidebar-nav a:hover { background:#fdf6f0; }
    .sidebar-nav a.active { background:#fdf6f0;color:#8B5E3C;font-weight:600;border-left:3px solid #8B5E3C; }
    .sidebar-nav a i { width:18px;text-align:center;color:#8B5E3C; }
    .sidebar-nav .logout-btn { display:flex;align-items:center;gap:10px;padding:11px 20px;font-size:.88rem;color:#dc2626;background:none;border:none;width:100%;cursor:pointer;border-top:1px solid #f5ede6;margin-top:4px; }
    .sidebar-nav .logout-btn:hover { background:#fef2f2; }
    .content-card { background:#fff;border-radius:16px;box-shadow:0 2px 16px rgba(139,94,60,.08);padding:28px 32px; }
    .section-title {
        font-family:'Playfair Display',serif;
        font-size:1.1rem;color:#2C1A0E;
        margin-bottom:20px;padding-bottom:12px;border-bottom:1.5px solid #f5ede6;
        display:flex;align-items:center;gap:8px;
        position:static;
    }
    .section-title::before, .section-title::after { display:none !important; }
    .section-title i { color:#8B5E3C; }
    /* Pesanan card */
    .order-card { border:1.5px solid #f0e4d8;border-radius:12px;margin-bottom:16px;overflow:hidden;transition:box-shadow .2s; }
    .order-card:hover { box-shadow:0 4px 16px rgba(139,94,60,.1); }
    .order-head { background:#fdf6f0;padding:12px 18px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px; }
    .order-id { font-weight:700;color:#2C1A0E;font-size:.88rem; }
    .order-date { font-size:.75rem;color:#9ca3af; }
    .badge-status { display:inline-block;padding:4px 12px;border-radius:999px;font-size:.72rem;font-weight:700;letter-spacing:.04em; }
    .status-Pending   { background:#fef9c3;color:#854d0e; }
    .status-Diproses  { background:#dbeafe;color:#1e40af; }
    .status-Dikirim   { background:#e0f2fe;color:#0369a1; }
    .status-Selesai   { background:#dcfce7;color:#166534; }
    .status-belum     { background:#fee2e2;color:#991b1b; }
    .status-sudah     { background:#dcfce7;color:#166534; }
    .order-body { padding:14px 18px; }
    .item-row { display:flex;align-items:center;gap:12px;padding:8px 0;border-bottom:1px solid #fdf6f0; }
    .item-row:last-child { border-bottom:none; }
    .item-img { width:48px;height:48px;object-fit:cover;border-radius:8px;flex-shrink:0; }
    .item-img-placeholder { width:48px;height:48px;border-radius:8px;background:#f5ede6;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .item-nama { font-size:.88rem;font-weight:600;color:#2C1A0E; }
    .item-sub { font-size:.75rem;color:#9ca3af; }
    .order-foot { padding:10px 18px;background:#fdf6f0;display:flex;justify-content:flex-end;align-items:center; }
    .order-total { font-weight:700;color:#8B5E3C;font-size:.95rem; }
</style>
@endsection

@section('content')
<div class="akun-wrap">
<div class="container">
    <div class="row g-4">

        {{-- Sidebar --}}
        <div class="col-lg-3">
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <div class="sidebar-avatar">
                        <i class="fa fa-user fa-lg" style="color:#fff;"></i>
                    </div>
                    <div class="sidebar-name">{{ Auth::guard('customer')->user()->name }}</div>
                    <div class="sidebar-email">{{ Auth::guard('customer')->user()->email }}</div>
                </div>
                <div class="sidebar-nav">
                    <a href="{{ route('akun.pesanan') }}" class="active">
                        <i class="fa fa-box"></i> Pesanan Saya
                    </a>
                    <a href="{{ route('akun.index') }}">
                        <i class="fa fa-user-cog"></i> Akun Saya
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fa fa-sign-out-alt" style="width:18px;text-align:center;"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Pesanan --}}
        <div class="col-lg-9">
            <div class="content-card">
                <div class="section-title"><i class="fa fa-box"></i> Riwayat Pesanan</div>

                @forelse($pesanans as $pesanan)
                    <div class="order-card">
                        <div class="order-head">
                            <div>
                                <div class="order-id">Pesanan {{ $pesanan->id }}</div>
                                <div class="order-date">{{ $pesanan->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div style="display:flex; gap:8px;">
                                <span class="badge-status status-{{ $pesanan->status_pembayaran === 'Sudah Bayar' ? 'sudah' : 'belum' }}">
                                    {{ $pesanan->status_pembayaran }}
                                </span>
                                <span class="badge-status status-{{ $pesanan->status }}">
                                    {{ $pesanan->status }}
                                </span>
                            </div>
                        </div>
                        <div class="order-body">
                            @foreach($pesanan->detailPesanans as $detail)
                                <div class="item-row">
                                    @if($detail->produk && $detail->produk->gambar)
                                        <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                             class="item-img" alt="{{ $detail->produk->nama_produk }}">
                                    @else
                                        <div class="item-img-placeholder">
                                            <i class="fa fa-birthday-cake" style="color:#C9B8A8;font-size:.8rem;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="item-nama">{{ $detail->produk->nama_produk ?? 'Produk dihapus' }}</div>
                                        <div class="item-sub">
                                            {{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-foot">
                            <span class="order-total">
                                Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fa fa-box-open fa-3x mb-3" style="color:#C9B8A8;"></i>
                        <p style="color:#9ca3af;font-size:.9rem;">Belum ada pesanan.</p>
                        <a href="{{ route('produk.index') }}" class="btn btn-primary rounded-pill px-5">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
</div>
@endsection
