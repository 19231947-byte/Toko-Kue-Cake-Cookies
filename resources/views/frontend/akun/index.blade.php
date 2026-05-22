@extends('frontend.layouts.app')

@section('title', 'Akun Saya - Ayasha Cake & Cookies')

@section('styles')
<style>
    .akun-wrap { background:#fdf6f0;min-height:60vh;padding:40px 0 60px; }
    .sidebar-card {
        background:#fff;border-radius:16px;
        box-shadow:0 2px 16px rgba(139,94,60,.08);
        overflow:hidden;
    }
    .sidebar-header {
        background:linear-gradient(135deg,#8B5E3C,#C9956A);
        padding:24px 20px;text-align:center;
    }
    .sidebar-avatar {
        width:64px;height:64px;border-radius:50%;
        background:rgba(255,255,255,.2);
        display:flex;align-items:center;justify-content:center;
        margin:0 auto 10px;border:2px solid rgba(255,255,255,.4);
    }
    .sidebar-name { font-weight:700;color:#fff;font-size:1rem;margin-bottom:2px; }
    .sidebar-email { font-size:.75rem;color:rgba(255,255,255,.75); }
    .sidebar-nav { padding:10px 0; }
    .sidebar-nav a {
        display:flex;align-items:center;gap:10px;
        padding:11px 20px;font-size:.88rem;color:#5a4a3a;
        text-decoration:none;transition:background .15s;
    }
    .sidebar-nav a:hover { background:#fdf6f0; }
    .sidebar-nav a.active { background:#fdf6f0;color:#8B5E3C;font-weight:600;border-left:3px solid #8B5E3C; }
    .sidebar-nav a i { width:18px;text-align:center;color:#8B5E3C; }
    .sidebar-nav .logout-btn {
        display:flex;align-items:center;gap:10px;
        padding:11px 20px;font-size:.88rem;color:#dc2626;
        background:none;border:none;width:100%;cursor:pointer;
        border-top:1px solid #f5ede6;margin-top:4px;
    }
    .sidebar-nav .logout-btn:hover { background:#fef2f2; }
    .content-card {
        background:#fff;border-radius:16px;
        box-shadow:0 2px 16px rgba(139,94,60,.08);
        padding:28px 32px;margin-bottom:20px;
    }
    .section-title {
        font-family:'Playfair Display',serif;
        font-size:1.1rem;color:#2C1A0E;
        margin-bottom:20px;padding-bottom:12px;
        border-bottom:1.5px solid #f5ede6;
        display:flex;align-items:center;gap:8px;
        position:static;
    }
    .section-title::before, .section-title::after { display:none !important; }
    .section-title i { color:#8B5E3C;font-size:1rem; }
    .form-field { margin-bottom:16px; }
    .form-field label { display:block;font-size:.8rem;font-weight:600;color:#8B5E3C;margin-bottom:6px;letter-spacing:.03em; }
    .form-field input {
        width:100%;padding:10px 14px;
        border:1.5px solid #e8d5c4;border-radius:8px;
        font-size:.9rem;color:#2C1A0E;outline:none;
        transition:border-color .2s;background:#fff;
    }
    .form-field input:focus { border-color:#8B5E3C;box-shadow:0 0 0 3px rgba(139,94,60,.08); }
    .form-field input[readonly] { background:#fdf6f0;color:#9ca3af;cursor:not-allowed; }
    .btn-save {
        background:#8B5E3C;color:#fff;border:none;
        border-radius:999px;padding:10px 28px;
        font-size:.85rem;font-weight:600;cursor:pointer;
        transition:background .2s;letter-spacing:.04em;
    }
    .btn-save:hover { background:#6b4a2e; }
    .alert-ok { background:#f0fdf4;border:1px solid #86efac;color:#166534;padding:10px 14px;border-radius:8px;font-size:.83rem;margin-bottom:16px; }
    .alert-err { background:#fef2f2;border:1px solid #fca5a5;color:#b91c1c;padding:10px 14px;border-radius:8px;font-size:.83rem;margin-bottom:16px; }
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
                    <div class="sidebar-name">{{ $user->name }}</div>
                    <div class="sidebar-email">{{ $user->email }}</div>
                </div>
                <div class="sidebar-nav">
                    <a href="{{ route('akun.pesanan') }}">
                        <i class="fa fa-box"></i> Pesanan Saya
                    </a>
                    <a href="{{ route('akun.index') }}" class="active">
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

        {{-- Konten --}}
        <div class="col-lg-9">

            {{-- Profil --}}
            <div class="content-card">
                <div class="section-title"><i class="fa fa-id-card"></i> Informasi Akun</div>

                @if(session('success'))
                    <div class="alert-ok"><i class="fa fa-check-circle me-2"></i>{{ session('success') }}</div>
                @endif

                <form action="{{ route('akun.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-field">
                                <label>NAMA LENGKAP</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div style="color:#dc2626;font-size:.75rem;margin-top:4px;">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-field">
                                <label>EMAIL</label>
                                <input type="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-save mt-2">Simpan Perubahan</button>
                </form>
            </div>

            {{-- Ubah Password --}}
            <div class="content-card">
                <div class="section-title"><i class="fa fa-lock"></i> Ubah Kata Sandi</div>

                @if(session('success_password'))
                    <div class="alert-ok"><i class="fa fa-check-circle me-2"></i>{{ session('success_password') }}</div>
                @endif
                @error('password_lama')
                    <div class="alert-err">{{ $message }}</div>
                @enderror

                <form action="{{ route('akun.ubah-password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-field">
                                <label>KATA SANDI LAMA</label>
                                <input type="password" name="password_lama" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-field">
                                <label>KATA SANDI BARU</label>
                                <input type="password" name="password" placeholder="Min. 8 karakter" required>
                                @error('password')<div style="color:#dc2626;font-size:.75rem;margin-top:4px;">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-field">
                                <label>KONFIRMASI KATA SANDI</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-save mt-2">Ubah Kata Sandi</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
