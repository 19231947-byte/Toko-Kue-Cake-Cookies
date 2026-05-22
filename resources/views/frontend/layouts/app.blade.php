<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Ayasha Cake & Cookies')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/jpeg" href="{{ asset('frontend/assets/img/logo_brand.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light" style="min-height: 110px;">
                <a href="{{ route('home') }}" class="navbar-brand py-0">
                    <img src="{{ asset('frontend/assets/img/nama_brand.png') }}" alt="logo" style="height: 100px; display: block;">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                        <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">Produk</a>
                        <a href="{{ route('kontak.index') }}" class="nav-item nav-link {{ request()->routeIs('kontak.*') ? 'active' : '' }}">Kontak</a>
                    </div>
                    <div class="border-start ps-4 d-none d-lg-flex align-items-center gap-3">
                        {{-- Search --}}
                        <div class="position-relative">
                            <a href="#" class="btn btn-sm p-0" title="Cari" onclick="toggleSearch(event)">
                                <i class="fa fa-search fs-5"></i>
                            </a>
                            <div id="searchBox" class="position-absolute end-0 top-100 mt-2 d-none" style="width:260px;z-index:999;">
                                <form action="{{ route('produk.index') }}" method="GET" class="d-flex shadow rounded-pill overflow-hidden">
                                    <input type="text" name="search" class="form-control border-0 rounded-0 ps-3" placeholder="Cari produk..." value="{{ request('search') }}" style="font-size:0.85rem;">
                                    <button type="submit" class="btn btn-primary rounded-0 px-3"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        {{-- User --}}
                        @auth('customer')
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm p-0" data-bs-toggle="dropdown" title="Akun">
                                    <i class="fa fa-user-circle fs-5"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-0 overflow-hidden" style="min-width:210px;border:none;box-shadow:0 8px 24px rgba(139,94,60,.15);border-radius:12px;">
                                    <div class="px-3 py-3" style="background:#8B5E3C;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:36px;height:36px;border-radius:50%;background:#FDF6F0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="fa fa-user" style="color:#8B5E3C;font-size:.9rem;"></i>
                                            </div>
                                            <div style="overflow:hidden;">
                                                <div style="font-weight:700;color:#fff;font-size:.85rem;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::guard('customer')->user()->name }}</div>
                                                <div style="font-size:.72rem;color:#f0d9c8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::guard('customer')->user()->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="background:#fff;padding:6px 0;">
                                        <a class="dropdown-item py-2 px-3 d-flex align-items-center gap-2" href="{{ route('akun.pesanan') }}"
                                           style="font-size:.85rem;color:#2C1A0E;">
                                            <i class="fa fa-box" style="color:#8B5E3C;width:16px;"></i> Pesanan Saya
                                        </a>
                                        <a class="dropdown-item py-2 px-3 d-flex align-items-center gap-2" href="{{ route('akun.index') }}"
                                           style="font-size:.85rem;color:#2C1A0E;">
                                            <i class="fa fa-user-cog" style="color:#8B5E3C;width:16px;"></i> Akun Saya
                                        </a>
                                        <div style="border-top:1px solid #f5ede6;margin:4px 0;"></div>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-2 px-3 d-flex align-items-center gap-2"
                                                    style="font-size:.85rem;color:#dc2626;width:100%;background:none;border:none;">
                                                <i class="fa fa-sign-out-alt" style="width:16px;"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('frontend.login') }}" class="btn btn-sm p-0" title="Login">
                                <i class="fa fa-user fs-5"></i>
                            </a>
                        @endauth
                        {{-- Cart --}}
                        <a href="{{ route('keranjang.index') }}" class="btn btn-sm p-0 position-relative" title="Keranjang">
                            <i class="fa fa-shopping-cart fs-5"></i>
                            @auth('customer')
                                @php
                                    $cartCount = \App\Models\Keranjang::where('user_id', Auth::guard('customer')->id())->sum('qty');
                                @endphp
                                @if($cartCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size:.6rem;">{{ $cartCount }}</span>
                                @endif
                            @endauth
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    @include('frontend.partials.footer')

    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSearch(e) {
            e.preventDefault();
            const box = document.getElementById('searchBox');
            box.classList.toggle('d-none');
            if (!box.classList.contains('d-none')) box.querySelector('input').focus();
        }
        document.addEventListener('click', function(e) {
            const box = document.getElementById('searchBox');
            if (box && !box.classList.contains('d-none') && !box.contains(e.target) && !e.target.closest('[onclick]')) {
                box.classList.add('d-none');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
