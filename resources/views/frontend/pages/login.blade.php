@extends('frontend.layouts.app')

@section('title', 'Login - Ayasha Cake & Cookies')

@section('styles')
<style>
    .auth-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        padding: 60px 16px;
    }
    .auth-box {
        width: 100%;
        max-width: 480px;
    }
    .auth-box h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        letter-spacing: .2em;
        text-align: center;
        color: #2C1A0E;
        margin-bottom: 12px;
        font-weight: 700;
    }
    .auth-box .subtitle {
        text-align: center;
        color: #8B5E3C;
        font-size: .95rem;
        font-family: 'Playfair Display', serif;
        font-style: italic;
        margin-bottom: 32px;
    }
    .auth-field {
        border: 1px solid #d6c9be;
        border-radius: 4px;
        padding: 16px 18px;
        width: 100%;
        font-size: .95rem;
        color: #2C1A0E;
        background: #fff;
        outline: none;
        transition: border-color .2s;
        margin-bottom: 14px;
    }
    .auth-field:focus { border-color: #8B5E3C; }
    .auth-field::placeholder { color: #b0a090; }
    .password-wrap {
        position: relative;
        margin-bottom: 14px;
    }
    .password-wrap .auth-field { margin-bottom: 0; }
    .toggle-password {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1rem;
        color: #8B5E3C;
        text-decoration: none;
        cursor: pointer;
    }
    .toggle-password:hover { color: #2C1A0E; }
    .btn-auth {
        width: 100%;
        background: #C9B8A8;
        color: #2C1A0E;
        border: none;
        border-radius: 4px;
        padding: 16px;
        font-size: .85rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 8px;
        transition: background .2s;
    }
    .btn-auth:hover { background: #b8a090; }
    .auth-footer {
        text-align: center;
        margin-top: 20px;
        font-size: .88rem;
        color: #7a6555;
    }
    .auth-footer a { color: #2C1A0E; font-weight: 600; text-decoration: none; }
    .auth-footer a:hover { text-decoration: underline; }
    .alert-error {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
        border-radius: 4px;
        padding: 10px 14px;
        font-size: .85rem;
        margin-bottom: 16px;
    }
</style>
@endsection

@section('content')
<section class="auth-section">
    <div class="auth-box">
        <h1>Selamat Datang</h1>
        <p class="subtitle">Masukkan email dan password Anda untuk login</p>

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('frontend.login.attempt') }}">
            @csrf
            <input
                type="email"
                name="email"
                class="auth-field"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required
                autofocus
            >
            <div class="password-wrap">
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="auth-field"
                    placeholder="Password"
                    required
                >
                <a href="#" class="toggle-password" onclick="togglePass(event, 'password', 'eye-icon')">
                    <i class="fa fa-eye" id="eye-icon"></i>
                </a>
            </div>
            <button type="submit" class="btn-auth">LOGIN</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('frontend.register') }}">Daftar</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function togglePass(e, inputId, iconId) {
        e.preventDefault();
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
