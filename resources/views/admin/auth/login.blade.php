<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Ayasha Cake & Cookies</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #c8a882, #8B5E3C);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            max-width: 420px;
            width: 100%;
            padding: 32px 28px 28px;
            text-align: center;
        }
        .logo-wrap {
            margin-bottom: 16px;
        }
        .logo-wrap img {
            height: 80px;
            object-fit: contain;
        }
        .subtitle {
            font-size: 0.88rem;
            color: #6b7280;
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #4b3a2a;
            margin-bottom: 6px;
            text-align: left;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #d1b99a;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 3px rgba(139,94,60,0.2);
        }
        .field { margin-bottom: 14px; }
        .password-wrap { position: relative; }
        .password-wrap input { padding-right: 44px; }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
            color: #8B5E3C;
        }
        .btn {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 10px 14px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #c8a882, #8B5E3C);
            cursor: pointer;
            margin-top: 6px;
            transition: transform 0.1s, box-shadow 0.1s;
        }
        .btn:hover {
            box-shadow: 0 12px 25px rgba(139,94,60,0.35);
            transform: translateY(-1px);
        }
        .btn:active {
            transform: translateY(0);
            box-shadow: none;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 12px;
            border-radius: 999px;
            background: rgba(139,94,60,0.1);
            color: #6b3f1f;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 14px;
        }
        .error {
            font-size: 0.8rem;
            color: #b91c1c;
            margin-top: 4px;
        }
        .alert {
            background: #fee2e2;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 0.8rem;
            color: #b91c1c;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-wrap">
            <img src="{{ asset('frontend/assets/img/nama_brand.png') }}" alt="Ayasha Cake & Cookies">
        </div>

        <div class="badge">Admin Panel</div>

        <div class="subtitle">Silakan login sebagai admin untuk mengelola produk dan pesanan.</div>

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <div class="password-wrap">
                    <input id="password" type="password" name="password" required>
                    <button type="button" id="togglePassword" class="toggle-password" aria-label="Lihat password">👁</button>
                </div>
            </div>
            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        togglePasswordBtn.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            togglePasswordBtn.textContent = isPassword ? '🙈' : '👁';
            togglePasswordBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Lihat password');
        });
    </script>
</body>
</html>
