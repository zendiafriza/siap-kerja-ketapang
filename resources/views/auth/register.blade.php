<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Daftar') }} — {{ config('app.name', 'Siap Kerja') }}</title>
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
            overflow-y: auto;
            position: relative;
            padding: 60px 20px;
        }

        /* PREMIUM ANIMATED BACKGROUND */
        .bg-mesh {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-color: var(--slate-900);
            background-image: 
                radial-gradient(circle at 100% 0%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 0% 100%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
            animation: bgShift 20s ease-in-out infinite alternate;
        }

        @keyframes bgShift {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* FLOATING ORBS */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.3;
            animation: float 20s infinite linear;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: var(--emerald);
            top: -150px;
            right: -150px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: #4338ca;
            bottom: -100px;
            left: -100px;
            animation-direction: reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(40px, 60px) rotate(180deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-card {
            background: rgba(30, 41, 59, 0.65);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 36px;
            padding: 40px 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
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
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            margin-bottom: 12px;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.5px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 4px;
            font-family: Georgia, serif;
        }

        .auth-subtitle {
            font-size: 14px;
            color: var(--slate-400);
            font-weight: 500;
        }

        /* ROLE TABS */
        .role-tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 24px;
            background: rgba(15, 23, 42, 0.4);
            padding: 6px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .rt {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 4px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .rt:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .rt.active {
            background: var(--emerald);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .rt-icon {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .rt-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .rt:not(.active) .rt-label {
            color: var(--slate-400);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--slate-200);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-input {
            width: 100%;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 15px;
            color: var(--white);
            outline: none;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            border-color: var(--emerald);
            background: rgba(15, 23, 42, 0.7);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--emerald), var(--emerald-dark));
            color: var(--white);
            border: none;
            border-radius: 16px;
            padding: 16px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.3);
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.4);
        }

        .auth-footer {
            text-align: center;
            font-size: 14px;
            color: var(--slate-400);
        }

        .auth-footer a {
            color: var(--emerald);
            text-decoration: none;
            font-weight: 800;
        }

        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            color: var(--slate-400);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            opacity: 0.7;
        }

        .back-to-home:hover {
            opacity: 1;
            transform: translateX(-5px);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 14px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
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
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

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
                <h2 class="auth-title">Daftar Akun Baru</h2>
                <p class="auth-subtitle">Pilih tipe akun Anda untuk memulai</p>
            </div>

            <!-- Role Selection Tabs -->
            <div class="role-tabs">
                <div class="rt active" id="tab-pencari_kerja" onclick="selectRole('pencari_kerja')">
                    <div class="rt-icon">🎓</div>
                    <div class="rt-label">Kandidat</div>
                </div>
                <div class="rt" id="tab-perusahaan" onclick="selectRole('perusahaan')">
                    <div class="rt-icon">🏢</div>
                    <div class="rt-label">Perusahaan</div>
                </div>
                <div class="rt" id="tab-lpk" onclick="selectRole('lpk')">
                    <div class="rt-icon">🏫</div>
                    <div class="rt-label">LPK</div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <input type="hidden" name="role" id="role-input" value="pencari_kerja">

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap / Instansi</label>
                    <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama" />
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" />
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
                </div>

                <button type="submit" class="submit-btn">
                    Daftar Sekarang ✨
                </button>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('index') }}" class="back-to-home">
                    <span>←</span> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role-input').value = role;
            document.querySelectorAll('.rt').forEach(tab => tab.classList.remove('active'));
            document.getElementById('tab-' + role).classList.add('active');
        }
    </script>
</body>

</html>
