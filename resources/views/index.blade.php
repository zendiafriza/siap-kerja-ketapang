<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siap Kerja Ketapang — Platform Karier Ketapang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <style>
        /* RESET & BASE */
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --bg-dark: #050b14;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh; 
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            scroll-behavior: smooth;
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        .animate-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        /* BACKGROUND ELEMENTS */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), 
                              linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: -2;
        }

        .bg-glow {
            position: fixed;
            top: -10%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: pulse-glow 10s infinite;
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            width: 100%;
            padding: 80px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
        }

        /* BRAND */
        .brand {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 80px;
            text-align: left;
        }

        .brand-icon {
            width: 56px;
            height: 56px;
            background: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.3);
            animation: float 4s infinite ease-in-out;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 800;
            line-height: 1.1;
            font-family: 'Fraunces', serif;
        }

        .brand-sub {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* HERO */
        .hero-title {
            font-size: clamp(40px, 8vw, 84px);
            font-weight: 900;
            font-family: 'Fraunces', serif;
            line-height: 1.05;
            margin-bottom: 32px;
            letter-spacing: -2px;
        }

        .hero-title span.accent {
            color: var(--primary);
            font-style: italic;
            position: relative;
        }

        .hero-desc {
            font-size: clamp(16px, 2vw, 20px);
            color: var(--text-muted);
            max-width: 700px;
            line-height: 1.8;
            margin-bottom: 48px;
            font-weight: 500;
        }

        /* BUTTONS */
        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            background: var(--primary);
            color: #fff;
            padding: 20px 40px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 800;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.4);
        }

        .btn-main:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px -12px rgba(16, 185, 129, 0.5);
            background: var(--primary-dark);
        }

        .badge-pill {
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            letter-spacing: 1px;
            font-weight: 800;
        }

        /* GRID SYSTEM */
        .divider {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 100px 0 60px 0;
            gap: 24px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--glass-border), transparent);
        }

        .divider-text {
            color: #475569;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .cards-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            width: 100%;
            margin-bottom: 100px;
        }

        .nav-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            padding: 48px 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #fff;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .nav-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-12px);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.4);
        }

        .card-icon {
            font-size: 48px;
            margin-bottom: 24px;
            background: rgba(255, 255, 255, 0.05);
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            transition: 0.3s;
        }

        .nav-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
            background: rgba(16, 185, 129, 0.1);
        }

        .card-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 12px;
            font-family: 'Fraunces', serif;
        }

        .card-desc {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .card-tag {
            font-size: 11px;
            font-weight: 800;
            padding: 8px 18px;
            border-radius: 12px;
            letter-spacing: 0.5px;
            margin-top: auto;
            text-transform: uppercase;
        }

        .tag-green { background: rgba(16, 185, 129, 0.1); color: #34d399; }
        .tag-purple { background: rgba(139, 92, 246, 0.1); color: #c084fc; }
        .tag-orange { background: rgba(245, 158, 11, 0.1); color: #fbbf24; }
        .tag-blue { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
        .tag-red { background: rgba(239, 68, 68, 0.1); color: #f87171; }

        /* FOOTER */
        .footer-stats {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1000px;
            padding: 60px 24px;
            border-top: 1px solid var(--glass-border);
            margin-bottom: 60px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-val {
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 900;
            font-family: 'Fraunces', serif;
            color: #fff;
            margin-bottom: 8px;
        }

        .stat-lbl {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .cards-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container { padding: 60px 20px; }
            .hero-title { letter-spacing: -1px; }
            .cards-wrapper {
                grid-template-columns: 1fr;
            }
            .footer-stats {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
            .brand {
                margin-bottom: 40px;
            }
        }
    </style>
</head>
<body>

    <div class="bg-grid"></div>
    <div class="bg-glow"></div>

    <div class="container">
        
        <div class="brand animate-up">
            <div class="brand-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="brand-text">
                <div class="brand-title">Siap Kerja Ketapang</div>
                <div class="brand-sub">PLATFORM KARIER KETAPANG</div>
            </div>
        </div>

        <h1 class="hero-title animate-up" style="animation-delay: 0.1s;">
            Satu platform,<br>
            <span class="accent">semua peluang</span><br>
            Ketapang
        </h1>
        <p class="hero-desc animate-up" style="animation-delay: 0.2s;">
            Pencari kerja mendapatkan karir dan perusahaan menemukan talenta terbaik di Ketapang. 
            Data lokal · Gratis selamanya.
        </p>

        <div class="animate-up" style="animation-delay: 0.3s;">
            <a href="{{ route('login') }}" class="btn-main">
                🚀 Mulai Platform Lengkap <span class="badge-pill">V2.0</span>
            </a>
        </div>

        <div class="divider animate-up" style="animation-delay: 0.4s;">
            <div class="divider-line"></div>
            <div class="divider-text">Akses Cepat</div>
            <div class="divider-line"></div>
        </div>

        <div class="cards-wrapper">
            
            <a href="{{ route('login') }}" class="nav-card animate-up" style="animation-delay: 0.5s;">
                <div class="card-icon">🔑</div>
                <div class="card-title">Login v2</div>
                <div class="card-desc">Halaman masuk dengan pilihan role pencari kerja, perusahaan, dan LPK</div>
                <div class="card-tag tag-green">Pencari Kerja / Perusahaan</div>
            </a>


            <a href="#" class="nav-card animate-up" style="animation-delay: 0.7s;">
                <div class="card-icon">🏢</div>
                <div class="card-title">Portal Perusahaan</div>
                <div class="card-desc">Kelola lowongan, lihat pelamar, rekrut talenta muda Ketapang</div>
                <div class="card-tag tag-orange">HR & Rekrutmen</div>
            </a>

            <a href="{{ route('dashboard.index') }}" class="nav-card animate-up" style="animation-delay: 0.8s;">
                <div class="card-icon">🎓</div>
                <div class="card-title">Portal Pencari Kerja</div>
                <div class="card-desc">Cari lowongan, filter AI match, lamar kerja dari satu halaman</div>
                <div class="card-tag tag-green">Cari Kerja</div>
            </a>

            <a href="{{ route('dashboard.lamaran') }}" class="nav-card animate-up" style="animation-delay: 0.9s;">
                <div class="card-icon">📋</div>
                <div class="card-title">Status Lamaran</div>
                <div class="card-desc">Pantau semua lamaran, jadwal interview, dan progres seleksi</div>
                <div class="card-tag tag-blue">Tracking Lamaran</div>
            </a>

            <a href="{{ route('dashboard.profil') }}" class="nav-card animate-up" style="animation-delay: 1.0s;">
                <div class="card-icon">👤</div>
                <div class="card-title">Profil Karier</div>
                <div class="card-desc">Kelola data diri, CV, keahlian, dan match score profil karier</div>
                <div class="card-tag tag-red">Profil & CV</div>
            </a>

        </div>

        <div class="footer-stats animate-up" style="animation-delay: 1.1s;" 
             x-data="{ 
                stats: { hired: 0, talenta: 0, lowongan: 0, match_rate: 0, mitra: 0 },
                display: { hired: 0, talenta: 0, lowongan: 0, match_rate: 0, mitra: 0 },
                async fetchStats() {
                    try {
                        const res = await fetch('/api/stats');
                        const data = await res.json();
                        this.stats = data;
                        
                        Object.keys(this.stats).forEach(key => {
                            this.animateValue(key, this.stats[key]);
                        });
                    } catch (e) { console.error('Failed to fetch stats'); }
                },
                animateValue(key, target) {
                    const start = this.display[key];
                    const duration = 2000;
                    const startTime = performance.now();
                    
                    const animate = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                        this.display[key] = Math.floor(start + (target - start) * easeProgress);
                        if (progress < 1) requestAnimationFrame(animate);
                        else this.display[key] = target;
                    };
                    requestAnimationFrame(animate);
                },
                init() {
                    this.fetchStats();
                    setInterval(() => this.fetchStats(), 10000);
                }
             }">
            <div class="stat-item">
                <div class="stat-val" x-text="display.hired">0</div>
                <div class="stat-lbl">Diterima Kerja</div>
            </div>
            <div class="stat-item">
                <div class="stat-val" x-text="display.talenta > 1000 ? (display.talenta/1000).toFixed(1) + 'K+' : display.talenta">0</div>
                <div class="stat-lbl">Talenta</div>
            </div>
            <div class="stat-item">
                <div class="stat-val" x-text="display.lowongan > 1000 ? (display.lowongan/1000).toFixed(1) + 'K' : display.lowongan">0</div>
                <div class="stat-lbl">Lowongan</div>
            </div>
            <div class="stat-item">
                <div class="stat-val"><span x-text="display.match_rate">0</span>%</div>
                <div class="stat-lbl">Match Rate</div>
            </div>
            <div class="stat-item">
                <div class="stat-val" x-text="display.mitra">0</div>
                <div class="stat-lbl">Mitra</div>
            </div>
        </div>

    </div>

</body>
</html>