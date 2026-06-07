@extends('frontend.layouts.app')

@section('title', 'Keranjang - Ayasha Cake & Cookies')

@section('styles')
<style>
    .keranjang-table { width:100%;border-collapse:collapse; }
    .keranjang-table th { font-size:.82rem;color:#9ca3af;font-weight:600;padding:10px 12px;border-bottom:2px solid #f5ede6;text-align:left; }
    .keranjang-table td { padding:14px 12px;border-bottom:1px solid #f5ede6;vertical-align:middle; }
    .keranjang-table tr:last-child td { border-bottom:none; }
    .produk-img { width:70px;height:70px;object-fit:cover;border-radius:8px; }
    .produk-nama { font-family:'Playfair Display',serif;font-weight:600;color:#2C1A0E;font-size:.95rem; }
    .produk-varian { font-size:.78rem;color:#9ca3af; }
    .qty-wrap { display:flex;align-items:center;gap:0;border:1.5px solid #d6c9be;border-radius:8px;overflow:hidden;width:fit-content; }
    .qty-btn { background:#f5ede6;border:none;width:32px;height:32px;font-size:1rem;cursor:pointer;color:#8B5E3C;font-weight:700; }
    .qty-btn:hover { background:#e8d5c4; }
    .qty-num { width:40px;text-align:center;border:none;border-left:1.5px solid #d6c9be;border-right:1.5px solid #d6c9be;height:32px;font-size:.88rem;color:#2C1A0E; }
    .btn-hapus { background:none;border:none;color:#dc2626;cursor:pointer;font-size:.82rem;padding:4px 8px;border-radius:6px; }
    .btn-hapus:hover { background:#fee2e2; }
    .summary-box { background:#fdf6f0;border-radius:12px;padding:24px; }
    .summary-row { display:flex;justify-content:space-between;margin-bottom:10px;font-size:.9rem;color:#5a4a3a; }
    .summary-total { display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;color:#2C1A0E;border-top:1.5px solid #d6c9be;padding-top:12px;margin-top:4px; }
</style>
@endsection

@section('content')

<div class="container-fluid page-header py-4 mb-5"
     style="background:linear-gradient(rgba(139,90,43,.5),rgba(139,90,43,.5)),url('{{ asset('frontend/assets/img/banner1.jpg') }}') center/cover no-repeat;">
    <div class="container text-center py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Keranjang</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-3 mb-5">
    <div class="container">

        @if(session('success'))
            <div style="background:#f0fdf4;border:1px solid #86efac;color:#166534;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:.88rem;">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(empty($keranjang))
            <div class="text-center py-5">
                <i class="fa fa-shopping-cart fa-3x mb-3" style="color:#C9B8A8;"></i>
                <p style="color:#9ca3af;">Keranjang Anda masih kosong.</p>
                <a href="{{ route('produk.index') }}" class="btn btn-primary rounded-pill px-5">Lihat Produk</a>
            </div>
        @else
            <div class="row g-4">
                {{-- Tabel Keranjang --}}
                <div class="col-lg-8">
                    <h4 style="font-family:'Playfair Display',serif;color:#2C1A0E;margin-bottom:20px;">
                        Keranjang Belanja
                    </h4>
                    <table class="keranjang-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keranjang as $key => $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item['gambar'])
                                            @php
                                                $prodImg = $item['gambar'];
                                                if (str_starts_with($prodImg, 'http')) {
                                                    $imagePath = $prodImg;
                                                } elseif (str_contains($prodImg, 'produk/')) {
                                                    $imagePath = asset('storage/' . $prodImg);
                                                } else {
                                                    $imagePath = asset('frontend/assets/img/' . $prodImg);
                                                }
                                            @endphp
                                            <img src="{{ $imagePath }}"
                                                 onerror="this.onerror=null;this.src='{{ asset('frontend/assets/img/no-image.png') }}';"
                                                 class="produk-img" alt="{{ $item['nama'] }}">
                                        @else
                                            <div class="produk-img d-flex align-items-center justify-content-center"
                                                 style="background:#f5ede6;">
                                                <i class="fa fa-birthday-cake" style="color:#C9B8A8;"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="produk-nama">{{ $item['nama'] }}</div>
                                            @if(!empty($item['nama_varian']))
                                                <div class="produk-varian">{{ $item['nama_varian'] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#8B5E3C;font-weight:600;">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </td>
                                <td>
                                    <form action="{{ route('keranjang.update', $key) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <div class="qty-wrap">
                                            <button type="button" class="qty-btn"
                                                    onclick="this.nextElementSibling.stepDown();this.closest('form').submit()">−</button>
                                            <input type="number" name="qty" class="qty-num"
                                                   value="{{ $item['qty'] }}" min="1" max="99"
                                                   onchange="this.closest('form').submit()">
                                            <button type="button" class="qty-btn"
                                                    onclick="this.previousElementSibling.stepUp();this.closest('form').submit()">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td style="font-weight:700;color:#2C1A0E;">
                                    Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                                </td>
                                <td>
                                    <form action="{{ route('keranjang.hapus', $key) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('produk.index') }}" style="font-size:.85rem;color:#8B5E3C;">
                            <i class="fa fa-arrow-left me-1"></i>Lanjut Belanja
                        </a>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="col-lg-4">
                    <h4 style="font-family:'Playfair Display',serif;color:#2C1A0E;margin-bottom:20px;">
                        Ringkasan
                    </h4>
                    <div class="summary-box">
                        @foreach($keranjang as $item)
                            <div class="summary-row">
                                <span>{{ $item['nama'] }}{{ !empty($item['nama_varian']) ? ' ('.$item['nama_varian'].')' : '' }} x{{ $item['qty'] }}</span>
                                <span>Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-primary w-100 rounded-pill py-2 mt-4"
                           style="font-weight:600;letter-spacing:.05em;">
                            Lanjut ke Checkout <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
