<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Cake&Cookies')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('frontend/assets/img/logo_brand.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @php use Illuminate\Support\Facades\Auth; @endphp
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; background: #f3f4f6; color: #111827; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #5a3825; color: #f9fafb; padding: 18px 14px; }
        .brand { font-weight: 800; font-size: 1.5rem; margin-bottom: 16px; line-height: 1.4; color: #f5e6d3; }
        .menu { display: grid; gap: 8px; }
        .menu a { text-decoration: none; color: #e8d5c0; padding: 10px 12px; border-radius: 10px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; }
        .menu a i { width: 16px; text-align: center; font-size: 0.85rem; }
        .menu a:hover { background: #7a4f35; }
        .menu a.active { background: #c8a882; color: #3b1f0e; font-weight: 600; }
        .content { flex: 1; min-width: 0; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 12px 16px; display:flex; justify-content:space-between; align-items:center; }
        .page-title { font-size: 1rem; font-weight: 700; }
        .userbox { font-size: 0.82rem; color: #4b5563; display:flex; align-items:center; gap:8px; }
        .logout-btn { border: none; background: #ef4444; color: #fff; padding: 6px 10px; border-radius: 999px; font-size: 0.78rem; cursor: pointer; }
        .main { padding: 18px 16px; }
        .card { background: #fff; border-radius: 12px; padding: 14px 16px; box-shadow: 0 10px 25px rgba(15,23,42,0.06); }
        .btn { display:inline-block; border:none; text-decoration:none; cursor:pointer; padding:7px 11px; border-radius:999px; font-size:0.82rem; }
        .btn-primary { background:#2563eb; color:#fff; }
        .btn-secondary { background:#e5e7eb; color:#111827; }
        .btn-danger { background:#dc2626; color:#fff; }
        table { width:100%; border-collapse:collapse; background:#fff; border-radius:12px; overflow:hidden; }
        th, td { padding:9px 10px; font-size:0.85rem; border-bottom:1px solid #e5e7eb; text-align:left; }
        th { background:#f9fafb; color:#4b5563; }
        tr:last-child td { border-bottom:none; }
        .flash-success { margin-bottom:10px; color:#166534; font-size:0.84rem; }
        label { display:block; font-size:0.84rem; color:#374151; margin-bottom:4px; }
        input[type="text"], input[type="number"], input[type="email"], input[type="password"], select, textarea {
            width:100%; padding:8px 10px; border:1px solid #d1d5db; border-radius:8px; font-size:0.9rem;
        }
        textarea { min-height: 90px; resize: vertical; }
        .field { margin-bottom: 12px; }
        .error { font-size:0.8rem; color:#b91c1c; margin-top:4px; }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">Toko Ayasha Cake&Cookies</div>
        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> User</a>
            <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Kategori</a>
            <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}"><i class="fa-solid fa-cake-candles"></i> Produk</a>
            <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}"><i class="fa-solid fa-box"></i> Pesanan</a>
            <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"><i class="fa-solid fa-file-lines"></i> Laporan Penjualan</a>
            <a href="{{ route('admin.pesan-kontak.index') }}" class="{{ request()->routeIs('admin.pesan-kontak.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i> Pesan Masuk</a>
            <a href="{{ route('admin.kriteria.index') }}" class="{{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}"><i class="fa-solid fa-sliders"></i> Data Kriteria</a>
            <a href="{{ route('admin.alternatif.index') }}" class="{{ request()->routeIs('admin.alternatif.*') ? 'active' : '' }}"><i class="fa-solid fa-list-ul"></i> Data Alternatif</a>
            <a href="{{ route('admin.perhitungan.index') }}" class="{{ request()->routeIs('admin.perhitungan.index') ? 'active' : '' }}"><i class="fa-solid fa-calculator"></i> Perhitungan SMART</a>
            <a href="{{ route('admin.perhitungan.hasil') }}" class="{{ request()->routeIs('admin.perhitungan.hasil') ? 'active' : '' }}"><i class="fa-solid fa-trophy"></i> Hasil Akhir</a>
        </nav>
    </aside>

    <div class="content">
        <div class="topbar">
            <div class="page-title">@yield('page_title', 'Dashboard')</div>
            <div class="userbox">
                <span>{{ Auth::guard('admin')->user()->name ?? 'Admin' }} ({{ Auth::guard('admin')->user()->email ?? '' }})</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="logout-btn" type="submit">Keluar</button>
                </form>
            </div>
        </div>
        <main class="main">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

