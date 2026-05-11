<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Reset Password') }} — {{ config('app.name', 'Siap Kerja Ketapang') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,400&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    :root {
      --navy: #06182C;
      --teal: #00B37E;
      --teal2: #00D49A;
      --teal-lt: #E6FBF4;
      --amber: #F59E0B;
      --coral: #EF4444;
      --line: #E2E8F0;
      --surface: #F8FAFC;
      --muted: #64748B;
      --ink: #0F172A;
    }

    html,
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--navy);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    /* BG DECORATION */
    .bg-orb1 {
      position: absolute;
      right: -100px;
      top: -100px;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 179, 126, .1) 0%, transparent 65%);
      pointer-events: none;
    }

    .bg-orb2 {
      position: absolute;
      left: -80px;
      bottom: -80px;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(59, 130, 246, .08) 0%, transparent 65%);
      pointer-events: none;
    }

    .bg-grid {
      position: absolute;
      inset: 0;
      background-image: linear-gradient(rgba(255, 255, 255, .015) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .015) 1px, transparent 1px);
      background-size: 50px 50px;
      pointer-events: none
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 400px;
      width: 100%;
      padding: 40px 24px;
    }

    .brand {
      text-align: center;
      margin-bottom: 40px;
    }

    .brand-hex {
      width: 60px;
      height: 60px;
      background: var(--teal);
      clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      flex-shrink: 0
    }

    .brand-hex svg {
      width: 30px;
      height: 30px;
    }

    .brand-name {
      font-family: 'Fraunces', serif;
      font-size: 24px;
      font-weight: 700;
      color: #fff;
      margin-bottom: 4px;
    }

    .brand-sub {
      font-size: 12px;
      color: rgba(255, 255, 255, .45);
    }

    .reset-card {
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(255, 255, 255, .1);
      border-radius: 16px;
      padding: 32px;
      backdrop-filter: blur(10px);
    }

    .reset-title {
      font-family: 'Fraunces', serif;
      font-size: 24px;
      font-weight: 700;
      color: #fff;
      text-align: center;
      margin-bottom: 8px;
    }

    .reset-subtitle {
      font-size: 14px;
      color: rgba(255, 255, 255, .6);
      text-align: center;
      margin-bottom: 24px;
      line-height: 1.5;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      padding: 12px 16px;
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      color: #fff;
      outline: none;
      transition: all .2s;
    }

    .form-input:focus {
      background: rgba(255, 255, 255, .15);
      border-color: var(--teal2);
      box-shadow: 0 0 0 3px rgba(0, 212, 154, .1);
    }

    .form-input::placeholder {
      color: rgba(255, 255, 255, .5);
    }

    .form-error {
      font-size: 12px;
      color: var(--coral);
      margin-top: 4px;
    }

    .reset-btn {
      width: 100%;
      padding: 12px 24px;
      background: var(--teal);
      border: none;
      border-radius: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      transition: all .2s;
      margin-bottom: 16px;
    }

    .reset-btn:hover {
      background: var(--teal2);
      transform: translateY(-1px);
    }

    .back-link {
      display: block;
      text-align: center;
      font-size: 14px;
      color: var(--teal2);
      text-decoration: none;
      transition: color .2s;
    }

    .back-link:hover {
      color: #fff;
    }

    .home-link {
      display: block;
      text-align: center;
      margin-top: 24px;
      font-size: 14px;
      color: rgba(255, 255, 255, .6);
      text-decoration: none;
      transition: color .2s;
    }

    .home-link:hover {
      color: #fff;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-error {
      background: rgba(239, 68, 68, .1);
      color: var(--coral);
      border: 1px solid var(--coral);
    }

    @media (max-width: 640px) {
      .container {
        padding: 20px 16px;
      }

      .reset-card {
        padding: 24px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="bg-orb1"></div>
  <div class="bg-orb2"></div>
  <div class="bg-grid"></div>

  <div class="container">
    <div class="brand">
      <div class="brand-hex">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="white" stroke-width="2.2" stroke-linecap="round" />
        </svg>
      </div>
      <div>
        <div class="brand-name">{{ config('app.name', 'Siap Kerja Ketapang') }}</div>
        <div class="brand-sub">Platform Karier & Belajar</div>
      </div>
    </div>

    <div class="reset-card">
      <div class="reset-title">{{ __('Reset Password') }}</div>
      <div class="reset-subtitle">{{ __('Masukkan password baru untuk akun Anda') }}</div>

      @if ($errors->any())
        <div class="alert alert-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-group">
          <label for="email" class="form-label">{{ __('Email') }}</label>
          <input id="email" class="form-input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="nama@email.com" />
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password" class="form-label">{{ __('Password Baru') }}</label>
          <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
          <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru" />
        </div>

        <button type="submit" class="reset-btn">
          {{ __('Reset Password') }}
        </button>
      </form>

      <a href="{{ route('login') }}" class="back-link">
        ← Kembali ke Login
      </a>

      <a href="{{ route('index') }}" class="home-link">
        Kembali ke Beranda
      </a>
    </div>
  </div>
</body>

</html>
