@extends('frontend.layouts.app')

@section('title', 'Produk - Ayasha Cake & Cookies')

@section('content')

    {{-- Page Header --}}
    <div class="container-fluid page-header py-5 mb-5"
         style="background: linear-gradient(rgba(139,90,43,.55), rgba(139,90,43,.55)), url('{{ asset('frontend/assets/img/banner4.png') }}') center center / cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="display-4 mb-3" style="font-family:'Playfair Display',serif;color:#2C1A0E;">Produk Kami</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                    <li class="breadcrumb-item active" style="color:#fff;" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-3 mb-5">
        <div class="container">

            {{-- Filter Kategori Tab --}}
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                @php
                    $tabs = ['Eid Cookies', 'Soft Cakes', 'Birthday Cakes', 'Snack Box'];
                @endphp
                <a href="{{ route('produk.index') }}"
                   class="btn rounded-pill px-4 py-2 {{ !request('kategori') ? 'btn-primary' : 'btn-outline-secondary' }}"
                   style="font-size:.85rem;letter-spacing:.05em;">
                    Semua
                </a>
                @foreach($kategoris as $kat)
                    @if(in_array($kat->nama_kategori, $tabs))
                        <a href="{{ route('produk.index', ['kategori' => $kat->id]) }}"
                           class="btn rounded-pill px-4 py-2 {{ request('kategori') == $kat->id ? 'btn-primary' : 'btn-outline-secondary' }}"
                           style="font-size:.85rem;letter-spacing:.05em;">
                            {{ $kat->nama_kategori }}
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Grid Produk --}}
            @if($produks->isEmpty())
                <div class="text-center py-5">
                    <i class="fa fa-box-open fa-3x mb-3" style="color:#C9B8A8;"></i>
                    <p class="text-muted">Produk tidak ditemukan.</p>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua Produk</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($produks as $produk)
                        <div class="col-lg-4 col-md-6">
                            <div class="store-item position-relative text-center">
                                @if($produk->gambar)
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $produk->gambar) }}"
                                         onerror="this.onerror=null;this.src='{{ asset('frontend/assets/img/' . $produk->gambar) }}';"
                                         alt="{{ $produk->nama_produk }}" style="height:220px;object-fit:cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light"
                                         style="height:220px;">
                                        <i class="fa fa-birthday-cake fa-3x" style="color:#C9B8A8;"></i>
                                    </div>
                                @endif
                                <div class="p-4">
                                    @if($produk->kategori)
                                        <span class="badge mb-2" style="background:#FDF6F0;color:#8B5E3C;font-size:.75rem;">
                                            {{ $produk->kategori->nama_kategori }}
                                        </span>
                                    @endif
                                    <h5 class="mb-1" style="font-family:'Playfair Display',serif;">{{ $produk->nama_produk }}</h5>
                                    <p class="small text-muted mb-2">{{ Str::limit($produk->deskripsi, 60) }}</p>
                                    <h5 class="text-primary mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                                </div>
                                <div class="store-overlay">
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="btn btn-primary rounded-pill py-2 px-4 m-2">
                                        Detail <i class="fa fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $produks->links('vendor.pagination.custom') }}
                </div>
            @endif

        </div>
    </div>

@endsection
