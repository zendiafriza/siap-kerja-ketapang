@extends('dashboard.index')

@section('konten_tengah')
<style>
    /* ANIMATIONS */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse-soft {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }

    .animate-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    /* CONTAINER & LAYOUT */
    .dashboard-container {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        color: #1e293b;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* PROMO BANNER */
    .promo-banner {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        border-radius: 24px;
        padding: 40px;
        display: flex;
        align-items: center;
        gap: 32px;
        position: relative;
        overflow: hidden;
        margin-bottom: 32px;
        color: #fff;
        box-shadow: 0 20px 40px -15px rgba(6, 78, 59, 0.3);
    }

    .promo-banner::before {
        content: "";
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .promo-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        flex-shrink: 0;
    }

    .promo-content h2 {
        margin: 0 0 12px 0;
        font-weight: 800;
        font-size: 24px;
        font-family: 'Fraunces', serif;
    }

    .promo-content p {
        margin: 0;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        font-size: 16px;
        max-width: 500px;
        line-height: 1.6;
    }

    .promo-btn {
        background: #fff;
        color: #064e3b;
        padding: 16px 32px;
        border-radius: 16px;
        font-weight: 800;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        display: inline-block;
        white-space: nowrap;
    }

    .promo-btn:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        background: #f8fafc;
    }

    /* SEARCH SECTION */
    .search-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 32px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
    }

    .search-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 16px;
        margin-bottom: 24px;
    }

    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
    }

    .search-input, .search-select {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #f1f5f9;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 600;
        background: #f8fafc;
        outline: none;
        transition: all 0.3s;
    }

    .search-input {
        padding-left: 52px;
    }

    .search-input:focus, .search-select:focus {
        border-color: #10b981;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    .btn-search {
        background: #10b981;
        color: #fff;
        border: none;
        padding: 0 40px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-search:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    }

    /* TABS */
    .tab-nav {
        display: flex;
        gap: 40px;
        margin-bottom: 32px;
        border-bottom: 2px solid #f1f5f9;
    }

    .tab-link {
        padding-bottom: 16px;
        color: #64748b;
        font-size: 16px;
        text-decoration: none;
        font-weight: 700;
        position: relative;
        transition: all 0.3s;
    }

    .tab-link:hover {
        color: #10b981;
    }

    .tab-link.active {
        color: #10b981;
    }

    .tab-link.active::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #10b981;
        border-radius: 10px;
    }

    /* JOB CARDS */
    .job-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    @media (max-width: 1024px) {
        .job-list {
            grid-template-columns: 1fr;
        }
    }

    .job-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 32px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        cursor: pointer;
    }

    .job-card:hover {
        border-color: #10b981;
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.15);
    }

    .job-header {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 16px;
        margin-bottom: 24px;
        width: 100%;
    }

    .company-info {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        min-width: 0;
    }

    .company-logo {
        width: 64px;
        height: 64px;
        background: #f8fafc;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .job-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        font-family: 'Fraunces', serif;
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .company-name {
        font-size: 15px;
        color: #10b981;
        font-weight: 700;
    }

    .job-tags {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .tag {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tag-primary { background: #ecfdf5; color: #059669; }
    .tag-secondary { background: #f1f5f9; color: #475569; }
    .tag-warning { background: #fff7ed; color: #c2410c; }

    .job-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 24px;
        border-top: 1px solid #f1f5f9;
    }

    .match-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f0fdf4;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid #dcfce7;
    }

    .match-percent {
        font-size: 14px;
        color: #15803d;
        font-weight: 800;
    }

    .btn-apply {
        background: #0f172a;
        color: #fff;
        padding: 14px 32px;
        border-radius: 16px;
        font-size: 15px;
        text-decoration: none;
        font-weight: 800;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-apply:hover {
        background: #1e293b;
        transform: translateX(8px);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .search-grid {
            grid-template-columns: 1fr 1fr;
        }
        .btn-search {
            grid-column: span 2;
            padding: 16px;
        }
    }

    @media (max-width: 768px) {
        .promo-banner {
            flex-direction: column;
            text-align: center;
            padding: 32px 24px;
            gap: 24px;
        }
        .promo-icon {
            margin: 0 auto;
        }
        .promo-content p {
            max-width: 100%;
            font-size: 14px;
        }
        .search-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .btn-search {
            grid-column: span 1;
        }
        .tab-nav {
            gap: 16px;
            padding-bottom: 4px;
            margin-bottom: 24px;
        }
        .tab-link {
            font-size: 14px;
        }
        .job-card {
            padding: 24px 20px;
        }
        .company-info {
            flex-direction: row; /* Keep logo and text side-by-side on mobile */
            text-align: left;
            gap: 16px;
        }
        .company-logo {
            width: 48px;
            height: 48px;
            font-size: 24px;
        }
        .job-title {
            font-size: 18px;
        }
        .job-header {
            flex-direction: column;
            gap: 20px;
        }
        .job-header > div:last-child {
            text-align: left !important;
            padding-left: 64px;
        }
        .job-footer {
            flex-direction: column;
            gap: 24px;
            align-items: stretch;
        }
        .match-badge {
            justify-content: center;
        }
        .btn-apply {
            justify-content: center;
            padding: 16px;
        }
    }
</style>

<div class="dashboard-container">
    
    <!-- HEADER PROMO -->
    <div class="promo-banner animate-up">
        <div class="promo-icon">🚀</div>
        <div class="promo-content">
            <h2>Profil Anda 85% Selesai!</h2>
            <p>Lengkapi data pengalaman kerja Anda untuk mendapatkan rekomendasi lowongan yang lebih akurat dari AI kami.</p>
        </div>
        <a href="{{ route('dashboard.profil') }}" class="promo-btn">
            Lengkapi Sekarang
        </a>
    </div>

    <!-- SEARCH & FILTERS -->
    <div class="search-card animate-up" style="animation-delay: 0.1s;">
        <form action="{{ route('dashboard.index') }}" method="GET">
            <div class="search-grid">
                <div class="input-group">
                    <span class="input-icon">🔍</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari posisi, keahlian, atau perusahaan..." class="search-input">
                </div>
                
                <select name="location" class="search-select">
                    <option value="semua">📍 Semua Lokasi</option>
                    <option value="Delta Pawan" {{ request('location') == 'Delta Pawan' ? 'selected' : '' }}>Delta Pawan</option>
                    <option value="Muara Pawan" {{ request('location') == 'Muara Pawan' ? 'selected' : '' }}>Muara Pawan</option>
                    <option value="Air Upas" {{ request('location') == 'Air Upas' ? 'selected' : '' }}>Air Upas</option>
                    <option value="Manis Mata" {{ request('location') == 'Manis Mata' ? 'selected' : '' }}>Manis Mata</option>
                    <option value="Marau" {{ request('location') == 'Marau' ? 'selected' : '' }}>Marau</option>
                    <option value="Jelai Hulu" {{ request('location') == 'Jelai Hulu' ? 'selected' : '' }}>Jelai Hulu</option>
                    <option value="Kendawangan" {{ request('location') == 'Kendawangan' ? 'selected' : '' }}>Kendawangan</option>
                </select>

                <select name="type" class="search-select">
                    <option value="semua">💼 Semua Tipe</option>
                    <option value="Magang" {{ request('type') == 'Magang' ? 'selected' : '' }}>Magang</option>
                    <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                </select>

                <button type="submit" class="btn-search">Cari</button>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                <span style="font-size: 13px; color: #64748b; font-weight: 800; margin-right: 8px;">KATEGORI POPULER:</span>
                <a href="{{ route('dashboard.index', ['type' => 'Magang']) }}" class="tag tag-primary" style="text-decoration: none;">🎓 Magang</a>
                <a href="{{ route('dashboard.index', ['type' => 'Full-time']) }}" class="tag tag-secondary" style="text-decoration: none;">💼 Full-time</a>
                <div style="flex: 1;"></div>
                <a href="{{ route('dashboard.index') }}" style="font-size: 13px; color: #ef4444; font-weight: 800; text-decoration: none;">Reset Filter</a>
            </div>
        </form>
    </div>

    <!-- CONTENT TABS -->
    <div class="tab-nav animate-up" style="animation-delay: 0.2s;">
        <a href="{{ route('dashboard.index') }}" class="tab-link {{ $active_page == 'kerja' ? 'active' : '' }}">Eksplorasi Lowongan</a>
        <a href="{{ route('dashboard.rekomendasi') }}" class="tab-link">Rekomendasi AI ✨</a>
        <a href="{{ route('dashboard.lamaran') }}" class="tab-link">Lamaran Saya</a>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;" class="animate-up" style="animation-delay: 0.25s;">
        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">
            Menampilkan {{ count($jobs ?? []) }} Peluang Karir
        </h3>
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 13px; font-weight: 700; color: #94a3b8;">Urutkan:</span>
            <select style="border: none; background: transparent; font-size: 14px; font-weight: 800; color: #1e293b; outline: none; cursor: pointer;">
                <option>Terbaru</option>
                <option>Paling Relevan</option>
            </select>
        </div>
    </div>

    <!-- JOB LIST -->
    <div class="job-list">
        @forelse($jobs ?? [] as $index => $job)
        <div class="job-card animate-up" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s;">
            <div class="job-header">
                <div class="company-info">
                    <div class="company-logo">🏢</div>
                    <div style="min-width: 0; flex: 1;">
                        <h4 class="job-title" title="{{ $job->title }}">{{ $job->title }}</h4>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: nowrap; overflow: hidden;">
                            <span class="company-name" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;">{{ $job->company }}</span>
                            <span style="width: 4px; height: 4px; background: #cbd5e1; border-radius: 50%; flex-shrink: 0;"></span>
                            <span style="font-size: 13px; color: #64748b; font-weight: 600; display: flex; align-items: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <span style="font-size: 12px; flex-shrink: 0;">📍</span> {{ $job->location }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div style="text-align: right; flex-shrink: 0; padding-left: 8px;">
                    @if($job->hide_salary)
                        <div style="font-size: 18px; font-weight: 900; color: #64748b; font-style: italic; margin-bottom: 4px;">Kompetitif</div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 700;">GAJI RAHASIA</div>
                    @else
                        <div style="font-size: 20px; font-weight: 900; color: #0f172a; margin-bottom: 4px;">{{ $job->salary ? 'IDR ' . $job->salary : 'Negosiasi' }}</div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 700;">ESTIMASI GAJI</div>
                    @endif
                </div>
            </div>

            <div class="job-tags">
                <span class="tag tag-primary">{{ $job->type }}</span>
                <span class="tag tag-secondary">{{ $job->category ?? 'Agrikultur' }}</span>
                <span class="tag tag-warning">🔥 Urgent Hiring</span>
            </div>

            <p style="font-size: 15px; color: #475569; line-height: 1.8; margin-bottom: 24px;">
                {{ Str::limit($job->description ?? 'Kami sedang mencari talenta berdedikasi untuk bergabung dalam tim operasional kami di wilayah Ketapang...', 180) }}
            </p>

            <div class="job-footer">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div class="match-badge">
                        <span>✅</span>
                        <span class="match-percent">92% Match Score</span>
                    </div>
                    <span style="font-size: 13px; color: #94a3b8; font-weight: 600;">🕒 {{ $job->created_at->diffForHumans() }}</span>
                </div>

                <div style="display: flex; gap: 16px;">
                    <form action="{{ route('dashboard.job.simpan', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #fff; border: 2px solid #f1f5f9; width: 52px; height: 52px; border-radius: 16px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s;">
                            🔖
                        </button>
                    </form>
                    <a href="{{ route('dashboard.lamar.show', $job->id) }}" class="btn-apply">
                        Lamar Sekarang <span>→</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 100px 40px; background: #fff; border-radius: 32px; border: 3px dashed #f1f5f9;" class="animate-up">
            <div style="font-size: 80px; margin-bottom: 32px;">🔎</div>
            <h4 style="font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 16px 0; font-family: 'Fraunces', serif;">Belum Ada Lowongan</h4>
            <p style="color: #64748b; font-size: 16px; margin: 0 0 40px 0; max-width: 450px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                Kami tidak menemukan lowongan yang sesuai. Coba sesuaikan filter atau kata kunci pencarian Anda.
            </p>
            <a href="{{ route('dashboard.index') }}" class="btn-apply" style="background: #10b981;">
                Tampilkan Semua Lowongan
            </a>
        </div>
        @endforelse
    </div>

</div>
@endsection
