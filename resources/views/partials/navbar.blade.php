<div class="topbar">
    <!-- LOGO SECTION -->
    <div class="topbar-left">
        <a href="{{ route('dashboard.index') }}" class="topbar-logo">
            <div class="logo-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" />
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="logo-text">Siap Kerja</div>
        </a>
        <div class="kandidat-badge desktop-only">
            Kandidat
        </div>
    </div>

    <!-- CENTER NAVIGATION (DESKTOP) -->
    <div class="topbar-center desktop-only">
        <a href="{{ route('dashboard.index') }}" class="nav-pill {{ $active_page == 'kerja' ? 'active' : '' }}">
            <span style="font-size: 16px;">🔍</span> Eksplorasi
        </a>
        <a href="{{ route('dashboard.lamaran') }}" class="nav-pill {{ $active_page == 'lamaran' ? 'active' : '' }}">
            <span style="font-size: 16px;">📋</span> Lamaran
        </a>
    </div>

    <!-- RIGHT SECTION -->
    <div class="topbar-right">
        
        <!-- XP BADGE -->
        <div class="xp-badge desktop-only">
            <span style="font-size: 16px;">⚡</span> {{ number_format(auth()->user()->xp ?? 1240, 0, ',', '.') }}
        </div>

        <!-- NOTIFICATIONS -->
        <button class="notif-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <div class="notif-dot"></div>
        </button>

        <!-- USER DROPDOWN -->
        <div class="dropdown-profile">
            <div class="user-pill">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="user-name desktop-only">
                    {{ explode(' ', auth()->user()->name)[0] }}
                </div>
                <span class="user-arrow">▼</span>
            </div>

            <div class="dropdown-content">
                <div class="dropdown-header">
                    <div class="dropdown-name">{{ auth()->user()->name }}</div>
                    <div class="dropdown-email">{{ auth()->user()->email }}</div>
                </div>
                
                <div class="mobile-only-links">
                    <a href="{{ route('dashboard.index') }}" class="dropdown-link {{ $active_page == 'kerja' ? 'active' : '' }}">
                        <span>🔍</span> Eksplorasi Kerja
                    </a>
                    <a href="{{ route('dashboard.lamaran') }}" class="dropdown-link {{ $active_page == 'lamaran' ? 'active' : '' }}">
                        <span>📋</span> Lamaran Saya
                    </a>
                </div>

                <a href="{{ route('dashboard.profil') }}" class="dropdown-link">
                    <span>⚙️</span> Pengaturan Profil
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span>🚪</span> Keluar Akun
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    .topbar {
        background: #0f172a;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 12px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: 'Plus Jakarta Sans', sans-serif;
        backdrop-filter: blur(20px);
        height: 70px;
        box-sizing: border-box;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .topbar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .logo-box {
        background: linear-gradient(135deg, #10b981, #059669);
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .logo-text {
        color: #fff;
        font-weight: 800;
        font-size: 20px;
        font-family: Georgia, serif;
        letter-spacing: -0.5px;
    }

    .kandidat-badge {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #34d399;
        font-size: 9px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .topbar-center {
        display: flex;
        gap: 8px;
        background: rgba(255, 255, 255, 0.03);
        padding: 4px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .nav-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .nav-pill:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.05);
    }

    .nav-pill.active {
        background: #fff;
        color: #0f172a;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .xp-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(245, 158, 11, 0.08);
        border: 1px solid rgba(245, 158, 11, 0.2);
        color: #fbbf24;
        padding: 8px 16px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 13px;
    }

    .notif-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        color: #94a3b8;
        transition: 0.2s;
    }

    .notif-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .notif-dot {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid #0f172a;
    }

    .user-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.05);
        padding: 4px 12px 4px 4px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: 0.2s;
        cursor: pointer;
    }

    .user-avatar {
        background: linear-gradient(135deg, #10b981, #059669);
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        color: #fff;
    }

    .user-name {
        color: #fff;
        font-weight: 700;
        font-size: 13px;
    }

    .user-arrow {
        font-size: 8px;
        color: rgba(255, 255, 255, 0.4);
    }

    /* Dropdown */
    .dropdown-profile {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: 120%;
        background: #fff;
        min-width: 220px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        animation: dropFade 0.2s ease;
    }

    @keyframes dropFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-profile:hover .dropdown-content {
        display: block;
    }

    .dropdown-header {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        background: #f8fafc;
    }

    .dropdown-name {
        font-size: 14px;
        font-weight: 800;
        color: #0f172a;
    }

    .dropdown-email {
        font-size: 11px;
        color: #64748b;
    }

    .dropdown-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        text-decoration: none;
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        transition: 0.2s;
    }

    .dropdown-link:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .logout-btn {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 16px;
        color: #ef4444;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        font-size: 13px;
        border-top: 1px solid #f1f5f9;
    }

    .logout-btn:hover {
        background: #fef2f2;
    }

    /* RESPONSIVE */
    .mobile-only-links { display: none; }

    @media (max-width: 768px) {
        .topbar {
            padding: 0 16px;
            height: 60px;
        }

        .desktop-only {
            display: none !important;
        }

        .logo-text {
            font-size: 18px;
        }

        .mobile-only-links {
            display: block;
            border-bottom: 4px solid #f1f5f9;
        }

        .dropdown-content {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            width: 100%;
            border-radius: 0;
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
    }
</style>
