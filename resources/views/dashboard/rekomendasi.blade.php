@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">

    <!-- AI HEADER SECTION -->
    <div style="background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #0f172a 100%); border-radius: 24px; padding: 40px; color: #fff; margin-bottom: 32px; position: relative; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(6, 78, 59, 0.3);">
        
        <!-- Animated Background Elements -->
        <div style="position: absolute; right: -20px; top: -20px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>
        <div style="position: absolute; left: -30px; bottom: -30px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>

        <div style="position: relative; z-index: 1; display: flex; align-items: center; gap: 24px;">
            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px; backdrop-filter: blur(10px); flex-shrink: 0; box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
                🤖
            </div>
            <div>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3); padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800; letter-spacing: 1px; color: #34d399; margin-bottom: 12px; text-transform: uppercase;">
                    ✨ AI Powered Analysis
                </div>
                <h1 style="font-size: 26px; font-weight: 800; margin: 0 0 6px 0; color: #fff; font-family: Georgia, serif; letter-spacing: -0.5px;">
                    Rekomendasi Karir untuk <span style="color: #34d399;">{{ explode(' ', auth()->user()->name ?? 'Kamu')[0] }}</span>
                </h1>
                <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin: 0; font-weight: 500; max-width: 500px; line-height: 1.6;">
                    AI kami menganalisis keahlian dan profil Anda untuk mencocokkan dengan lowongan yang paling relevan di industri saat ini.
                </p>
            </div>
        </div>

        <div style="position: relative; z-index: 1; display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 16px; margin-top: 32px;">
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 16px; backdrop-filter: blur(5px);">
                <div style="font-size: 24px; font-weight: 900; color: #34d399; font-family: Georgia, serif;">{{ count($jobs ?? []) }}</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Match Ditemukan</div>
            </div>
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 16px; backdrop-filter: blur(5px);">
                <div style="font-size: 24px; font-weight: 900; color: #fbbf24; font-family: Georgia, serif;">{{ auth()->user()->profile_metadata['match_score'] ?? 85 }}%</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Profil Kesiapan</div>
            </div>
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 16px; backdrop-filter: blur(5px);">
                <div style="font-size: 24px; font-weight: 900; color: #a78bfa; font-family: Georgia, serif;">Top 3</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Industri Cocok</div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <div style="display: flex; gap: 32px; margin-bottom: 24px; border-bottom: 2px solid #f1f5f9; overflow-x: auto; white-space: nowrap;">
        <a href="{{ route('dashboard.index') }}"
            style="padding-bottom: 12px; color: #64748b; font-size: 15px; text-decoration: none; font-weight: 700; border-bottom: 3px solid transparent; transition: 0.3s; margin-bottom: -2px;"
            onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            Eksplorasi Lowongan
        </a>
        <a href="{{ route('dashboard.rekomendasi') }}"
            style="padding-bottom: 12px; color: #10b981; font-size: 15px; text-decoration: none; font-weight: 800; border-bottom: 3px solid #10b981; transition: 0.3s; margin-bottom: -2px;">
            Rekomendasi AI ✨
        </a>
        <a href="{{ route('dashboard.lamaran') }}"
            style="padding-bottom: 12px; color: #64748b; font-size: 15px; text-decoration: none; font-weight: 700; border-bottom: 3px solid transparent; transition: 0.3s; margin-bottom: -2px;"
            onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            Lamaran Saya
        </a>
    </div>

    <!-- RECOMMENDED LIST -->
    <div class="job-grid-container">

    <style>
        .job-grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .job-grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

        @forelse($jobs ?? [] as $job)
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;"
            onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -10px rgba(16, 185, 129, 0.1)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            
            <div style="position: absolute; top: 0; left: 0; width: 6px; height: 100%; background: {{ $job->match_score >= 90 ? '#10b981' : '#fbbf24' }};"></div>

            <div style="display: grid; grid-template-columns: 1fr auto; align-items: start; gap: 16px; margin-bottom: 20px;">
                <div style="display: flex; gap: 16px; align-items: start; min-width: 0;">
                    <div style="width: 56px; height: 56px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0;">
                        🏢
                    </div>
                    <div style="min-width: 0;">
                        <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 800; color: #0f172a; font-family: Georgia, serif; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $job->title }}">
                            {{ $job->title }}
                        </h4>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: nowrap; overflow: hidden;">
                            <span style="font-size: 13px; color: #10b981; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">{{ $job->company }}</span>
                            <span style="width: 4px; height: 4px; background: #cbd5e1; border-radius: 50%; flex-shrink: 0;"></span>
                            <span style="font-size: 13px; color: #64748b; font-weight: 600; display: flex; align-items: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <span style="font-size: 12px; flex-shrink: 0;">📍</span> {{ $job->location }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div style="text-align: right; background: #ecfdf5; padding: 10px 16px; border-radius: 16px; border: 1px solid #dcfce7; flex-shrink: 0;">
                    <div style="font-size: 20px; font-weight: 900; color: #059669; font-family: Georgia, serif; line-height: 1;">
                        {{ $job->match_score ?? 90 }}<span style="font-size: 12px; opacity: 0.6;">%</span>
                    </div>
                    <div style="font-size: 9px; color: #166534; font-weight: 800; text-transform: uppercase; margin-top: 4px; letter-spacing: 0.5px;">Score Match</div>
                </div>
            </div>

            <div style="display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap;">
                <span style="background: #f0fdf4; color: #166534; font-size: 11px; padding: 6px 14px; border-radius: 10px; font-weight: 700; border: 1px solid #dcfce7;">
                    {{ $job->type }}
                </span>
                <span style="background: #f1f5f9; color: #475569; font-size: 11px; padding: 6px 14px; border-radius: 10px; font-weight: 700;">
                    {{ $job->sector ?? 'Industri' }}
                </span>
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">💰 Gaji:</span>
                    @if($job->hide_salary)
                        <span style="font-size: 12px; color: #64748b; font-weight: 700; font-style: italic;">Kompetitif</span>
                    @else
                        <span style="font-size: 12px; color: #0f172a; font-weight: 700;">{{ $job->salary ? 'IDR ' . $job->salary : 'Negosiasi' }}</span>
                    @endif
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">🕒 Dianalisis {{ $job->created_at->diffForHumans() }}</span>
                
                <div style="display: flex; gap: 12px;">
                    <form action="{{ route('dashboard.job.simpan', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #fff; border: 1px solid #e2e8f0; color: #475569; width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;">
                            🔖
                        </button>
                    </form>
                    <a href="{{ route('dashboard.lamar.show', $job->id) }}"
                        style="background: #0f172a; color: #fff; padding: 10px 24px; border-radius: 12px; font-size: 14px; text-decoration: none; font-weight: 800; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                        onmouseover="this.style.background='#1e293b'; this.style.transform='translateX(4px)'"
                        onmouseout="this.style.background='#0f172a'; this.style.transform='translateX(0)'">
                        Lamar Sekarang <span>→</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 80px 40px; background: #fff; border-radius: 24px; border: 2px dashed #e2e8f0;">
            <div style="font-size: 64px; margin-bottom: 24px; opacity: 0.5;">🤖</div>
            <h4 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 12px 0;">Menunggu Analisis AI</h4>
            <p style="color: #64748b; font-size: 15px; margin: 0 0 32px 0; max-width: 400px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                AI kami memerlukan informasi profil yang lengkap untuk memberikan rekomendasi terbaik. Pastikan Anda telah mengisi data keahlian dan pengalaman.
            </p>
            <a href="{{ route('dashboard.profil') }}" style="display: inline-flex; background: #10b981; color: #fff; padding: 12px 32px; border-radius: 12px; font-weight: 800; text-decoration: none; transition: 0.3s;">
                Lengkapi Profil Sekarang
            </a>
        </div>
        @endforelse

    </div>

</div>
@endsection
