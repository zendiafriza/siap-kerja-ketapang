<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Reset Password') }} — {{ config('app.name', 'Siap Kerja') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --emerald: #10b981;
            --emerald-dark: #059669;
            --emerald-light: #dcfce7;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-400: #94a3b8;
            --slate-200: #e2e8f0;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            background-color: var(--slate-900);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* PREMIUM BACKGROUND */
        .bg-mesh {
            position: absolute;
            inset: 0;
            z-index: 0;
            background-color: var(--slate-900);
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 100%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
        }

        .bg-grid {
            position: absolute;
            inset: 0;
            z-index: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .auth-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            padding: 48px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
            text-decoration: none;
        }

        .brand-logo {
            background: linear-gradient(135deg, var(--emerald), var(--emerald-dark));
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            margin-bottom: 16px;
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.5px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            font-family: Georgia, serif;
        }

        .auth-subtitle {
            font-size: 14px;
            color: var(--slate-400);
            font-weight: 500;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 32px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--slate-200);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 15px;
            color: var(--white);
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            border-color: var(--emerald);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-input::placeholder {
            color: var(--slate-600);
        }

        .submit-btn {
            width: 100%;
            background: var(--emerald);
            color: var(--white);
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
            margin-bottom: 24px;
        }

        .submit-btn:hover {
            background: var(--emerald-dark);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.4);
        }

        .back-link {
            display: block;
            text-align: center;
            font-size: 14px;
            color: var(--emerald);
            text-decoration: none;
            font-weight: 700;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--white);
        }

        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            color: var(--slate-400);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-to-home:hover {
            color: var(--white);
        }

        /* ALERTS */
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 40px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-mesh"></div>
    <div class="bg-grid"></div>

    <div class="container">
        <a href="{{ route('index') }}" class="brand">
            <div class="brand-logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" />
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="brand-name">Siap Kerja</div>
        </a>

        <div class="auth-card">
            <div class="auth-header">
                <h2 class="auth-title">Lupa Password?</h2>
                <p class="auth-subtitle">Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" />
                </div>

                <button type="submit" class="submit-btn">
                    Kirim Link Reset
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link">
                Kembali ke Login
            </a>

            <div style="text-align: center;">
                <a href="{{ route('index') }}" class="back-to-home">
                    <span>←</span> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>

</html>
