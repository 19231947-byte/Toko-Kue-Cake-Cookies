@extends('frontend.layouts.app')

@section('title', 'Kontak - Ayasha Cake & Cookies')

@section('styles')
<style>
.contact-icon {
    width: 42px; height: 42px;
    background: #FDF6F0; border: 1px solid #e8d9cc; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #8B5E3C; font-size: .95rem; flex-shrink: 0;
}
.sosmed-btn {
    width: 38px; height: 38px; border-radius: 50%;
    background: #FDF6F0; border: 1px solid #e8d9cc;
    display: inline-flex; align-items: center; justify-content: center;
    color: #8B5E3C; font-size: .9rem; text-decoration: none; transition: all .2s;
}
.sosmed-btn:hover { background: #8B5E3C; color: #fff; border-color: #8B5E3C; }
.contact-form-wrap { background: #fff; border: 1px solid #ede3da; border-radius: 16px; }
.form-label-custom { display: block; font-size: .85rem; font-weight: 600; color: #2C1A0E; margin-bottom: 6px; }
.input-custom {
    width: 100%; padding: 10px 14px; border: 1.5px solid #ddd0c5; border-radius: 8px;
    font-size: .88rem; color: #2C1A0E; background: #fdfaf8; outline: none;
    transition: border-color .2s; font-family: inherit; box-sizing: border-box;
}
.input-custom:focus { border-color: #8B5E3C; background: #fff; }
.input-custom.is-error { border-color: #e74c3c; }
.input-custom.with-prefix { border-radius: 0 8px 8px 0; border-left: none; }
.input-group-custom { display: flex; align-items: stretch; }
.input-prefix {
    padding: 10px 12px; background: #f3ece6; border: 1.5px solid #ddd0c5;
    border-right: none; border-radius: 8px 0 0 8px;
    font-size: .88rem; color: #8B5E3C; font-weight: 600; white-space: nowrap;
}
.error-msg { font-size: .78rem; color: #e74c3c; margin-top: 4px; display: block; }
.btn-kirim {
    background: #8B5E3C; color: #fff; border: none;
    padding: 11px 32px; border-radius: 50px; font-size: .9rem;
    font-weight: 600; cursor: pointer; transition: background .2s;
}
.btn-kirim:hover { background: #6e4a2e; }
.alert-success-custom {
    background: #f0faf4; border: 1px solid #a8d5b5; color: #2d6a4f;
    padding: 12px 16px; border-radius: 8px; font-size: .88rem;
}
</style>
@endsection

@section('content')

    {{-- Page Header --}}
    <div class="container-fluid page-header py-5 mb-5"
         style="background: linear-gradient(rgba(139,90,43,.55), rgba(139,90,43,.55)), url('{{ asset('frontend/assets/img/banner4.png') }}') center center / cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="display-4 mb-3" style="font-family:'Playfair Display',serif;color:#2C1A0E;">Hubungi Kami</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                    <li class="breadcrumb-item active" style="color:#fff;" aria-current="page">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="row g-5">

            {{-- Kolom Kiri: Info Kontak --}}
            <div class="col-lg-5">
                <h2 style="font-family:'Playfair Display',serif;color:#2C1A0E;" class="mb-2">Informasi Kontak</h2>
                <p class="text-muted mb-4" style="font-size:.9rem;">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui salah satu saluran berikut.</p>

                <div class="d-flex align-items-start mb-4">
                    <div class="contact-icon me-3"><i class="fa fa-map-marker-alt"></i></div>
                    <div>
                        <h6 class="mb-1" style="color:#2C1A0E;">Alamat</h6>
                        <p class="text-muted mb-0" style="font-size:.88rem;">Jl. Musyawarah, Kebon Jeruk, Kota Jakarta Barat, DKI Jakarta Barat</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="contact-icon me-3"><i class="fa fa-phone-alt"></i></div>
                    <div>
                        <h6 class="mb-1" style="color:#2C1A0E;">Nomor Telepon</h6>
                        <p class="text-muted mb-0" style="font-size:.88rem;">+62 857 1762 8133</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="contact-icon me-3"><i class="fa fa-envelope"></i></div>
                    <div>
                        <h6 class="mb-1" style="color:#2C1A0E;">Email</h6>
                        <a href="mailto:yashadiyah@gmail.com" class="text-muted" style="font-size:.88rem;text-decoration:none;">yashadiyah@gmail.com</a>
                    </div>
                </div>
            </div>
            {{-- /Kolom Kiri --}}

            {{-- Kolom Kanan: Form --}}
            <div class="col-lg-7">
                <div class="contact-form-wrap p-4 p-lg-5">
                    <h2 style="font-family:'Playfair Display',serif;color:#2C1A0E;" class="mb-2">Kirim Pesan</h2>
                    <p class="text-muted mb-4" style="font-size:.9rem;">Isi formulir di bawah ini dan kami akan segera menghubungi Anda.</p>

                    @if(session('success'))
                        <div class="alert-success-custom mb-4">
                            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="input-custom @error('nama') is-error @enderror"
                                       placeholder="Masukkan nama Anda" value="{{ old('nama') }}" required>
                                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Nomor Telepon <span class="text-danger">*</span></label>
                                <div class="input-group-custom">
                                    <span class="input-prefix">+62</span>
                                    <input type="text" name="no_telepon" class="input-custom with-prefix @error('no_telepon') is-error @enderror"
                                           placeholder="812 3456 7890" value="{{ old('no_telepon') }}" required>
                                </div>
                                @error('no_wa')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Email <span style="color:#999;font-weight:400;">(opsional)</span></label>
                                <input type="email" name="email" class="input-custom @error('email') is-error @enderror"
                                       placeholder="Masukkan email Anda" value="{{ old('email') }}">
                                @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subjek" class="input-custom @error('subjek') is-error @enderror"
                                       placeholder="Masukkan subjek pesan" value="{{ old('subjek') }}" required>
                                @error('subjek')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom">Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" rows="5" class="input-custom @error('pesan') is-error @enderror"
                                          placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                @error('pesan')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn-kirim">
                                    <i class="fa fa-paper-plane me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- /Kolom Kanan --}}

        </div>
    </div>

@endsection
