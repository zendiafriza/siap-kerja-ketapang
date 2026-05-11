@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">
    
    <!-- PAGE TITLE -->
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif;">
            Status Lamaranku
        </h1>
        <p style="margin: 0; color: #64748b; font-size: 14px; font-weight: 500;">
            Pantau perkembangan setiap lamaran yang telah Anda kirimkan.
        </p>
    </div>

    <!-- STATS OVERVIEW -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px;">
        <div style="background: #fff; border: 1px solid #e2e8f0; border-bottom: 4px solid #0f172a; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="font-size: 32px; font-weight: 900; color: #0f172a; line-height: 1; font-family: Georgia, serif;">
                {{ count($applications ?? []) }}
            </div>
            <div style="font-size: 11px; font-weight: 800; color: #64748b; margin-top: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Total Lamaran</div>
        </div>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-bottom: 4px solid #10b981; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="font-size: 32px; font-weight: 900; color: #10b981; line-height: 1; font-family: Georgia, serif;">
                {{ collect($applications ?? [])->where('status', 'interview')->count() }}
            </div>
            <div style="font-size: 11px; font-weight: 800; color: #64748b; margin-top: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Interview</div>
        </div>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-bottom: 4px solid #f59e0b; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <div style="font-size: 32px; font-weight: 900; color: #f59e0b; line-height: 1; font-family: Georgia, serif;">
                {{ collect($applications ?? [])->where('status', 'pending')->count() }}
            </div>
            <div style="font-size: 11px; font-weight: 800; color: #64748b; margin-top: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Diproses</div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 16px; border-radius: 16px; margin-bottom: 24px; font-weight: 700; font-size: 14px;">
            ✨ {{ session('success') }}
        </div>
    @endif

    <!-- TABS -->
    <div style="display: flex; gap: 32px; margin-bottom: 24px; border-bottom: 2px solid #f1f5f9; overflow-x: auto; white-space: nowrap;">
        <a href="{{ route('dashboard.index') }}"
            style="padding-bottom: 12px; color: #64748b; font-size: 15px; text-decoration: none; font-weight: 700; border-bottom: 3px solid transparent; transition: 0.3s; margin-bottom: -2px;"
            onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            Eksplorasi Lowongan
        </a>
        <a href="{{ route('dashboard.rekomendasi') }}"
            style="padding-bottom: 12px; color: #64748b; font-size: 15px; text-decoration: none; font-weight: 700; border-bottom: 3px solid transparent; transition: 0.3s; margin-bottom: -2px;"
            onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            Rekomendasi AI ✨
        </a>
        <a href="{{ route('dashboard.lamaran') }}"
            style="padding-bottom: 12px; color: #10b981; font-size: 15px; text-decoration: none; font-weight: 800; border-bottom: 3px solid #10b981; transition: 0.3s; margin-bottom: -2px;">
            Lamaran Saya
        </a>
    </div>

    <!-- APPLICATIONS LIST -->
    <div class="app-grid-container">

    <style>
        .app-grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .app-grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

        @forelse($applications ?? [] as $app)
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
            onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 8px 16px -4px rgba(0,0,0,0.05)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div style="display: flex; gap: 16px; align-items: center;">
                    <div style="width: 52px; height: 52px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        🏢
                    </div>
                    <div>
                        <h4 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 800; color: #0f172a; font-family: Georgia, serif;">
                            {{ $app->job->title ?? 'Posisi Pekerjaan' }}
                        </h4>
                        <div style="font-size: 13px; color: #64748b; font-weight: 600;">
                            {{ $app->job->company ?? 'Nama Perusahaan' }}
                        </div>
                    </div>
                </div>
                
                <div style="background: {{ $app->status == 'interview' ? '#f0fdf4' : ($app->status == 'pending' ? '#fffbeb' : '#fef2f2') }}; 
                            color: {{ $app->status == 'interview' ? '#16a34a' : ($app->status == 'pending' ? '#d97706' : '#dc2626') }}; 
                            font-size: 10px; font-weight: 800; padding: 6px 12px; border-radius: 20px; border: 1px solid {{ $app->status == 'interview' ? '#dcfce7' : ($app->status == 'pending' ? '#fef3c7' : '#fee2e2') }}; letter-spacing: 0.5px; text-transform: uppercase;">
                    {{ $app->status == 'interview' ? '✓ Dipanggil Interview' : ($app->status == 'pending' ? '⏳ Sedang Diproses' : 'Ditolak') }}
                </div>
            </div>

            @if($app->status == 'interview')
            <div style="background: #f0fdf4; border-radius: 14px; padding: 16px; margin-bottom: 20px; color: #166534; font-size: 13px; font-weight: 600; line-height: 1.6; border: 1px solid #dcfce7;">
                🚀 <strong style="font-weight: 800;">Selamat!</strong> Lamaran Anda telah lolos seleksi awal. Pihak HRD akan segera menghubungi Anda melalui email atau nomor WhatsApp untuk jadwal interview.
            </div>
            @else
            <div style="color: #64748b; font-size: 13px; margin-bottom: 20px; font-weight: 500;">
                Lamaran dikirim pada <span style="color: #1e293b; font-weight: 700;">{{ $app->created_at->format('d M Y') }}</span>. Tim rekrutmen biasanya memberikan respon dalam 5-10 hari kerja.
            </div>
            @endif

            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 6px 14px; border-radius: 20px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 12px;">📊</span>
                    <span style="font-size: 11px; color: #475569; font-weight: 800;">Match {{ $app->job->match_score ?? 90 }}%</span>
                </div>
                
                <div style="display: flex; gap: 12px;">
                    <button style="background: #fff; border: 1px solid #e2e8f0; color: #475569; padding: 8px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s;">
                        Detail Lamaran
                    </button>
                    <a href="{{ route('dashboard.index') }}" style="background: #f8fafc; border: 1px solid #e2e8f0; color: #0f172a; padding: 8px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; text-decoration: none; transition: 0.2s;">
                        Lihat Lowongan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 80px 40px; background: #fff; border-radius: 24px; border: 2px dashed #e2e8f0;">
            <div style="font-size: 64px; margin-bottom: 24px; opacity: 0.5;">📄</div>
            <h4 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 12px 0;">Belum Ada Lamaran</h4>
            <p style="color: #64748b; font-size: 15px; margin: 0 0 32px 0; max-width: 400px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                Anda belum mengirimkan lamaran pekerjaan apa pun. Jelajahi lowongan yang tersedia dan mulai karir Anda sekarang!
            </p>
            <a href="{{ route('dashboard.index') }}" style="display: inline-flex; background: #10b981; color: #fff; padding: 12px 32px; border-radius: 12px; font-weight: 800; text-decoration: none; transition: 0.3s;">
                Cari Lowongan Sekarang
            </a>
        </div>
        @endforelse

    </div>
</div>
@endsection
