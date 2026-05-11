@php
    $role = strtolower(auth()->user()->role ?? 'pencari_kerja');
    $isCompany = $role == 'perusahaan';
    $isLpk = $role == 'lpk';
    
    // Theme Colors
    $primaryColor = $isCompany ? '#4338ca' : ($isLpk ? '#f59e0b' : '#10b981');
    $primaryLight = $isCompany ? '#eef2ff' : ($isLpk ? '#fffbeb' : '#ecfdf5');
    $primaryDark = $isCompany ? '#3730a3' : ($isLpk ? '#d97706' : '#059669');
    $gradient = $isCompany ? 'linear-gradient(135deg, #4338ca, #312e81)' : ($isLpk ? 'linear-gradient(135deg, #f59e0b, #d97706)' : 'linear-gradient(135deg, #10b981, #059669)');
@endphp

<div class="sidebar-wrapper" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px; font-family: 'Inter', 'Nunito', sans-serif; width: 280px; box-sizing: border-box; display: flex; flex-direction: column; gap: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); position: sticky; top: 20px;">

    <!-- PROFILE CARD -->
    <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
        
        <div style="width: 72px; height: 72px; background: {{ $gradient }}; border-radius: 22px; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 900; font-family: Georgia, serif; color: #fff; margin-bottom: 12px; box-shadow: 0 8px 16px -4px rgba(0,0,0,0.2); border: 3px solid #fff;">
            {{ strtoupper(substr(auth()->user()->name ?? 'PK', 0, 2)) }}
        </div>

        <div style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 4px; font-family: Georgia, serif;">
            {{ auth()->user()->name ?? 'User' }}
        </div>
        <div style="font-size: 11px; color: #64748b; font-weight: 700; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.5px;">
            {{ $isCompany ? 'Verified Company' : ($isLpk ? 'Authorized Training' : 'Kandidat Terverifikasi') }}
        </div>

        @if(!$isCompany && !$isLpk)
        <!-- MATCH SCORE PANEL (Candidate Only) -->
        <div style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 16px; padding: 16px; width: 100%; box-sizing: border-box; transition: 0.3s;" onmouseover="this.style.background='{{ $primaryLight }}'; this.style.borderColor='{{ $isCompany ? '#e0e7ff' : ($isLpk ? '#fef3c7' : '#dcfce7') }}'" onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#f1f5f9'">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                <div style="font-size: 32px; font-weight: 900; color: {{ $primaryColor }}; font-family: Georgia, serif; line-height: 1;">
                    {{ auth()->user()->profile_metadata['match_score'] ?? 85 }}<span style="font-size: 14px; opacity: 0.6;">%</span>
                </div>
                <div style="font-size: 10px; color: {{ $primaryDark }}; font-weight: 800; background: {{ $primaryLight }}; padding: 2px 8px; border-radius: 20px;">SIAP KERJA</div>
            </div>
            <div style="font-size: 10px; color: #64748b; font-weight: 700; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                Match Score Profil
            </div>
            <div style="width: 100%; height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden; display: flex;">
                <div style="width: {{ auth()->user()->profile_metadata['match_score'] ?? 85 }}%; height: 100%; background: {{ $gradient }};"></div>
            </div>
        </div>
        @else
        <!-- COMPANY/LPK INFO STRIP -->
        <div style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 16px; padding: 12px; width: 100%; box-sizing: border-box; font-size: 12px; color: #64748b; font-weight: 600;">
            🏢 {{ $isCompany ? 'Recruitment Plan: Gold' : 'Lembaga Pelatihan' }}
        </div>
        @endif
    </div>

    <!-- XP / ANALYTICS (Role Specific) -->
    @if(!$isCompany && !$isLpk)
    <div style="background: #0f172a; border-radius: 16px; padding: 16px; text-align: left; position: relative; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.1);">
        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 48px; opacity: 0.1; transform: rotate(-15deg);">🏆</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">LEVEL PROFIL</div>
        <div style="font-size: 24px; font-weight: 900; color: #f59e0b; font-family: Georgia, serif; margin-bottom: 4px; display: flex; align-items: center; gap: 8px;">
            {{ number_format(auth()->user()->xp ?? 1240, 0, ',', '.') }} <span style="font-size: 12px; color: #fff; opacity: 0.6;">XP</span>
        </div>
        <div style="width: 100%; height: 4px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden;">
            <div style="width: 82%; height: 100%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
        </div>
    </div>
    @endif

    <div style="height: 1px; background: #f1f5f9; width: 100%;"></div>

    <!-- NAVIGATION MENU -->
    <div>
        <div style="font-size: 11px; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 12px; text-transform: uppercase;">
            {{ $isCompany ? 'Panel Perusahaan' : ($isLpk ? 'Panel LPK' : 'Navigasi Karir') }}
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 6px;">
            @if($isCompany)
                <a href="{{ route('dashboard.perusahaan') }}" class="sb-item {{ $active_page == 'perusahaan' ? 'active' : '' }}" style="--hover-bg: #eef2ff; --active-bg: #eef2ff; --active-color: #4338ca;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #eef2ff; color: #4338ca;">📊</div>
                        <span>Dashboard Utama</span>
                    </div>
                </a>
                <a href="{{ route('perusahaan.lowongan') }}" class="sb-item {{ $active_page == 'kelola_lowongan' ? 'active' : '' }}" style="--hover-bg: #eef2ff; --active-bg: #eef2ff; --active-color: #4338ca;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #fff7ed; color: #ea580c;">💼</div>
                        <span>Kelola Lowongan</span>
                    </div>
                </a>
                <a href="{{ route('perusahaan.kandidat') }}" class="sb-item {{ $active_page == 'cari_kandidat' ? 'active' : '' }}" style="--hover-bg: #eef2ff; --active-bg: #eef2ff; --active-color: #4338ca;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #ecfdf5; color: #10b981;">👥</div>
                        <span>Cari Kandidat</span>
                    </div>
                </a>
            @elseif($isLpk)
                <a href="{{ route('dashboard.lpk') }}" class="sb-item {{ $active_page == 'lpk' ? 'active' : '' }}" style="--hover-bg: #fffbeb; --active-bg: #fffbeb; --active-color: #d97706;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #fffbeb; color: #d97706;">🏫</div>
                        <span>Dashboard LPK</span>
                    </div>
                </a>
            @else
                <a href="{{ route('dashboard.index') }}" class="sb-item {{ $active_page == 'kerja' ? 'active' : '' }}" style="--hover-bg: #ecfdf5; --active-bg: #ecfdf5; --active-color: #059669;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #ecfdf5; color: #10b981;">🔍</div>
                        <span>Eksplorasi Kerja</span>
                    </div>
                </a>
                <a href="{{ route('dashboard.rekomendasi') }}" class="sb-item {{ $active_page == 'rekomendasi' ? 'active' : '' }}" style="--hover-bg: #ecfdf5; --active-bg: #ecfdf5; --active-color: #059669;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #fffbeb; color: #f59e0b;">⭐</div>
                        <span>Rekomendasi AI</span>
                    </div>
                </a>
                <a href="{{ route('dashboard.lamaran') }}" class="sb-item {{ $active_page == 'lamaran' ? 'active' : '' }}" style="--hover-bg: #ecfdf5; --active-bg: #ecfdf5; --active-color: #059669;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #eef2ff; color: #4338ca;">📋</div>
                        <span>Lamaran Saya</span>
                    </div>
                </a>
                <a href="{{ route('dashboard.disimpan') }}" class="sb-item {{ $active_page == 'disimpan' ? 'active' : '' }}" style="--hover-bg: #ecfdf5; --active-bg: #ecfdf5; --active-color: #059669;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #fff1f2; color: #e11d48;">🔖</div>
                        <span>Disimpan</span>
                    </div>
                </a>
                <a href="{{ route('dashboard.lms') }}" class="sb-item {{ $active_page == 'lms' ? 'active' : '' }}" style="--hover-bg: #ecfdf5; --active-bg: #ecfdf5; --active-color: #059669;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="sb-icon" style="background: #f5f3ff; color: #7c3aed;">📚</div>
                        <span>LMS Belajar</span>
                    </div>
                </a>
            @endif
        </div>
    </div>

    <!-- SETTINGS -->
    <div style="margin-top: auto; display: flex; flex-direction: column; gap: 8px;">
        <a href="{{ route('dashboard.profil') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 14px; text-decoration: none; color: #64748b; font-size: 13px; font-weight: 700; transition: 0.2s;" onmouseover="this.style.background='#f8fafc'; this.style.color='#0f172a'" onmouseout="this.style.background='transparent'; this.style.color='#64748b'">
            <span>⚙️ Pengaturan Akun</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 12px; border-radius: 14px; color: #ef4444; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                <span>🚪 Keluar Aplikasi</span>
            </button>
        </form>
    </div>

</div>

<style>
    .sb-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 16px;
        text-decoration: none;
        color: #475569;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .sb-item:hover {
        background: var(--hover-bg, #f8fafc);
        color: #0f172a;
        transform: translateX(4px);
    }

    .sb-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: 0.2s;
    }

    .sb-item.active {
        background: var(--active-bg, #ecfdf5);
        color: var(--active-color, #059669);
        border-color: rgba(0,0,0,0.05);
        box-shadow: 0 4px 12px -4px rgba(0,0,0,0.05);
    }
    
    .sb-item.active .sb-icon {
        background: var(--active-color, #10b981) !important;
        color: #fff !important;
        transform: scale(1.1);
    }
</style>