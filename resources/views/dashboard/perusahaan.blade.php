@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b; padding-bottom: 40px;">
    
    <!-- CORPORATE HEADER SECTION -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: #fff; padding: 32px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span style="background: #eef2ff; color: #4338ca; padding: 6px 14px; border-radius: 20px; font-size: 10px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; border: 1px solid #e0e7ff;">
                    🏢 Hub Rekrutmen Perusahaan
                </span>
            </div>
            <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0; font-family: Georgia, serif; letter-spacing: -0.5px;">
                Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}
            </h1>
            <p style="margin: 0; color: #64748b; font-size: 15px; font-weight: 500;">
                Kelola lowongan dan temukan kandidat terbaik untuk tim Anda.
            </p>
        </div>
        <button onclick="document.getElementById('modal-lowongan').style.display='flex'" 
            style="background: #4338ca; color: white; border: none; padding: 14px 28px; border-radius: 16px; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 12px; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(67, 56, 202, 0.3);"
            onmouseover="this.style.background='#3730a3'; this.style.transform='translateY(-2px)'"
            onmouseout="this.style.background='#4338ca'; this.style.transform='translateY(0)'">
            <span style="font-size: 20px;">+</span> Pasang Lowongan Baru
        </button>
    </div>

    <!-- PERFORMANCE STATS -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px;">
        
        <div style="background: white; border-radius: 24px; padding: 28px; border: 1px solid #e2e8f0; position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                <div style="width: 52px; height: 52px; background: #eef2ff; color: #4338ca; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">👥</div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Kandidat Melamar</div>
                </div>
            </div>
            <div style="font-size: 40px; font-weight: 900; color: #0f172a; line-height: 1; font-family: Georgia, serif;">{{ $total_applicants ?? 0 }}</div>
            <div style="margin-top: 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #ecfdf5; color: #059669; font-weight: 800; font-size: 11px; padding: 4px 10px; border-radius: 20px;">+12%</span>
                <span style="color: #94a3b8; font-size: 12px; font-weight: 600;">Tren Bulan Ini</span>
            </div>
        </div>

        <div style="background: white; border-radius: 24px; padding: 28px; border: 1px solid #e2e8f0; position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                <div style="width: 52px; height: 52px; background: #fff7ed; color: #ea580c; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">💼</div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Lowongan Aktif</div>
                </div>
            </div>
            <div style="font-size: 40px; font-weight: 900; color: #0f172a; line-height: 1; font-family: Georgia, serif;">{{ \App\Models\Job::where('user_id', auth()->id())->count() }}</div>
            <div style="margin-top: 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #eef2ff; color: #4338ca; font-weight: 800; font-size: 11px; padding: 4px 10px; border-radius: 20px;">Premium Plan</span>
                <span style="color: #94a3b8; font-size: 12px; font-weight: 600;">Terverifikasi</span>
            </div>
        </div>

        <div style="background: white; border-radius: 24px; padding: 28px; border: 1px solid #e2e8f0; position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                <div style="width: 52px; height: 52px; background: #f0fdf4; color: #10b981; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">⚡</div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Akurasi AI Match</div>
                </div>
            </div>
            <div style="font-size: 40px; font-weight: 900; color: #0f172a; line-height: 1; font-family: Georgia, serif;">92<span style="font-size: 20px; opacity: 0.5;">%</span></div>
            <div style="margin-top: 16px; display: flex; align-items: center; gap: 8px;">
                <span style="background: #f0fdf4; color: #166534; font-weight: 800; font-size: 11px; padding: 4px 10px; border-radius: 20px;">Optimum</span>
                <span style="color: #94a3b8; font-size: 12px; font-weight: 600;">Sistem Aktif</span>
            </div>
        </div>

    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 32px;">
        
        <!-- APPLICANTS LIST -->
        <div style="background: #fff; border-radius: 28px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="padding: 28px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a; font-family: Georgia, serif;">Antrean Pelamar Terbaru</h3>
                <div style="display: flex; gap: 12px;">
                    <select style="padding: 8px 16px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 600; color: #475569; outline: none;">
                        <option>Semua Lowongan</option>
                    </select>
                </div>
            </div>

            <div style="padding: 0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 16px 28px; text-align: left; font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;">Kandidat</th>
                            <th style="padding: 16px 28px; text-align: left; font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;">Posisi</th>
                            <th style="padding: 16px 28px; text-align: left; font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;">Match Score</th>
                            <th style="padding: 16px 28px; text-align: right;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications ?? [] as $app)
                        <tr id="pelamar-row-{{ $app->id }}" style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 20px 28px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #4338ca, #6366f1); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800;">
                                        {{ strtoupper(substr($app->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-size: 15px; font-weight: 800; color: #0f172a;">{{ $app->user->name }}</div>
                                        <div style="font-size: 12px; color: #64748b; font-weight: 500;">{{ $app->user->profile_metadata['pendidikan_jurusan'] ?? 'Pencari Kerja' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 20px 28px;">
                                <div style="font-size: 14px; font-weight: 700; color: #475569;">{{ $app->job->title }}</div>
                            </td>
                            <td style="padding: 20px 28px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="flex: 1; min-width: 60px; height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                                        <div style="width: {{ $app->user->profile_metadata['match_score'] ?? 0 }}%; height: 100%; background: #10b981;"></div>
                                    </div>
                                    <span style="font-size: 14px; font-weight: 800; color: #059669;">{{ $app->user->profile_metadata['match_score'] ?? 0 }}%</span>
                                </div>
                            </td>
                            <td style="padding: 20px 28px; text-align: right;">
                                <button onclick="openKandidatModal('{{ $app->user->name }}', '{{ $app->user->profile_metadata['pendidikan_jurusan'] ?? 'Pencari Kerja' }}', {{ $app->user->profile_metadata['match_score'] ?? 0 }}, 1200, 'pelamar-row-{{ $app->id }}')" 
                                    style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 20px; border-radius: 12px; font-size: 13px; font-weight: 700; cursor: pointer; color: #1e1b4b; transition: 0.2s;"
                                    onmouseover="this.style.background='#f1f5f9'; this.style.borderColor='#cbd5e1'" onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'">
                                    Review Profil
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 80px 40px; text-align: center;">
                                <div style="font-size: 64px; margin-bottom: 24px; opacity: 0.2;">📁</div>
                                <h4 style="font-size: 18px; font-weight: 800; color: #1e293b; margin: 0 0 8px 0;">Belum Ada Pelamar</h4>
                                <p style="color: #64748b; font-size: 14px; margin: 0;">Silakan pasang lowongan untuk mulai menerima kandidat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT SIDEBAR (PERUSAHAAN) -->
        <div style="display: flex; flex-direction: column; gap: 32px;">
            
            <!-- RECRUITMENT PIPELINE CARD -->
            <div style="background: #0f172a; border-radius: 28px; padding: 32px; color: #fff; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.2);">
                <h4 style="margin: 0 0 24px 0; font-size: 14px; font-weight: 800; color: #4ade80; text-transform: uppercase; letter-spacing: 1px;">Recruitment Funnel</h4>
                
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.6);">Review Berkas</span>
                            <span style="font-size: 14px; font-weight: 900;">{{ $total_applicants ?? 0 }}</span>
                        </div>
                        <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden;">
                            <div style="width: 100%; height: 100%; background: #4338ca;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.6);">Interview</span>
                            <span style="font-size: 14px; font-weight: 900;">3</span>
                        </div>
                        <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden;">
                            <div style="width: 45%; height: 100%; background: #fbbf24;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.6);">Penawaran (Hired)</span>
                            <span style="font-size: 14px; font-weight: 900;">0</span>
                        </div>
                        <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden;">
                            <div style="width: 5%; height: 100%; background: #10b981;"></div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: rgba(255,255,255,0.5); text-align: center; line-height: 1.6;">
                    Gunakan filter <strong>Match Score</strong> untuk memprioritaskan kandidat terbaik.
                </div>
            </div>

            <!-- ANALYTICS PREVIEW -->
            <div style="background: #eef2ff; border-radius: 28px; padding: 32px; border: 1px solid #e0e7ff;">
                <div style="width: 44px; height: 44px; background: #4338ca; color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 20px;">💡</div>
                <h4 style="font-size: 15px; font-weight: 800; color: #3730a3; margin: 0 0 12px 0;">Wawasan Rekrutmen</h4>
                <p style="margin: 0; font-size: 13px; color: #4338ca; line-height: 1.6; font-weight: 500;">
                    Kandidat dengan skor di atas <strong>85%</strong> biasanya memiliki retensi 2x lebih lama di perusahaan sejenis.
                </p>
            </div>

        </div>

    </div>
</div>

@include('dashboard.modal_lowongan')
@include('dashboard.modal_profil_kandidat')

@if(session('success'))
    <div style="position: fixed; top: 20px; right: 20px; background: #059669; color: white; padding: 16px 24px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); z-index: 9999; font-weight: 800; display: flex; align-items: center; gap: 12px;">
        <span>✅</span> {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('[style*="position: fixed; top: 20px"]').style.display = 'none';
        }, 3000);
    </script>
@endif
@endsection
