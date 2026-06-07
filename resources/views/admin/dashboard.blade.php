@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard')

@section('content')
<style>
    .dash-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .dash-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 4px 18px rgba(90,56,37,.08);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform .15s, box-shadow .15s;
    }
    .dash-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(90,56,37,.13);
    }
    .dash-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .dash-info .label { font-size: .78rem; color: #9ca3af; margin-bottom: 2px; }
    .dash-info .value { font-size: 1.7rem; font-weight: 800; color: #2c1a0e; line-height: 1; }
    .section-title { font-size: 1rem; font-weight: 700; color: #3b1f0e; margin: 0 0 14px; }
</style>

<div class="section-title">Dashboard Toko Kue</div>

<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-icon" style="background:#fef3c7;">
            <i class="fa-solid fa-users" style="color:#d97706;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total User</div>
            <div class="value">{{ $totalUser }}</div>
        </div>
    </div>

    <div class="dash-card">
        <div class="dash-icon" style="background:#fce7f3;">
            <i class="fa-solid fa-cake-candles" style="color:#db2777;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total Produk</div>
            <div class="value">{{ $totalProduk }}</div>
        </div>
    </div>

    <div class="dash-card">
        <div class="dash-icon" style="background:#ede9fe;">
            <i class="fa-solid fa-tags" style="color:#7c3aed;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total Kategori</div>
            <div class="value">{{ $totalKategori }}</div>
        </div>
    </div>

    <div class="dash-card">
        <div class="dash-icon" style="background:#dbeafe;">
            <i class="fa-solid fa-box" style="color:#2563eb;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total Pesanan</div>
            <div class="value">{{ $totalPesanan }}</div>
        </div>
    </div>

    {{-- 
    <div class="dash-card">
        <div class="dash-icon" style="background:#ffedd5;">
            <i class="fa-solid fa-sliders" style="color:#ea580c;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total Kriteria</div>
            <div class="value">{{ $totalKriteria }}</div>
        </div>
    </div>

    <div class="dash-card">
        <div class="dash-icon" style="background:#f0fdf4;">
            <i class="fa-solid fa-list-ul" style="color:#15803d;"></i>
        </div>
        <div class="dash-info">
            <div class="label">Total Alternatif</div>
            <div class="value">{{ $totalAlternatif }}</div>
        </div>
    </div>
    --}}
</div>
@endsection
