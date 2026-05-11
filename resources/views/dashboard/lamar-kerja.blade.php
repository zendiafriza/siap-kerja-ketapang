@extends('dashboard.index')

@section('konten_tengah')
@php
    $meta = auth()->user()->profile_metadata ?? [];
    $score = $meta['match_score'] ?? 0;
@endphp

<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b; padding-bottom: 80px;">
    
    <!-- NAVIGATION -->
    <div style="margin-bottom: 24px;">
        <a href="{{ route('dashboard.index') }}" style="text-decoration: none; color: #64748b; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            <span>←</span> Kembali ke Eksplorasi
        </a>
    </div>

    <!-- HEADER -->
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif; letter-spacing: -0.5px;">
            Langkah Terakhir Menuju Karir Anda
        </h1>
        <p style="margin: 0; color: #64748b; font-size: 15px; font-weight: 500;">
            Lengkapi pesan tambahan untuk meyakinkan tim rekrutmen.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 32px; align-items: start;">
        
        <!-- MAIN FORM AREA -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- JOB SUMMARY CARD -->
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px; display: flex; gap: 20px; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div style="width: 64px; height: 64px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 32px; flex-shrink: 0;">
                    🏢
                </div>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 800; color: #0f172a; font-family: Georgia, serif;">{{ $job->title }}</h4>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 14px; color: #10b981; font-weight: 700;">{{ $job->company }}</span>
                        <span style="width: 4px; height: 4px; background: #cbd5e1; border-radius: 50%;"></span>
                        <span style="font-size: 14px; color: #64748b; font-weight: 600;">📍 {{ $job->location }}</span>
                    </div>
                </div>
            </div>

            <!-- APPLICATION FORM -->
            <form action="{{ route('dashboard.lamar.submit', $job->id) }}" method="POST" 
                style="background: white; border: 1px solid #e2e8f0; border-radius: 24px; padding: 32px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02);">
                @csrf
                
                <!-- PROFILE RECAP -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; margin-bottom: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h5 style="margin: 0; font-size: 14px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">Ringkasan Data Anda</h5>
                        <a href="{{ route('dashboard.profil') }}" style="font-size: 12px; color: #10b981; text-decoration: none; font-weight: 700;">Edit Profil <span>→</span></a>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Nama Lengkap</div>
                            <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ auth()->user()->name }}</div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Email</div>
                            <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ auth()->user()->email }}</div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Jurusan / Bidang</div>
                            <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $meta['pendidikan_jurusan'] ?? 'Belum Diisi' }}</div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Skor Kecocokan</div>
                            <div style="font-size: 14px; font-weight: 800; color: #10b981;">{{ $score }}% Match</div>
                        </div>
                    </div>
                </div>

                <!-- MESSAGE FIELD -->
                <div style="margin-bottom: 32px;">
                    <label style="display: block; font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">
                        Pesan Singkat untuk Perekrut (Cover Letter)
                    </label>
                    <textarea name="cover_letter" rows="8" required 
                        placeholder="Ceritakan mengapa Anda tertarik dengan posisi ini dan apa nilai tambah yang bisa Anda berikan..." 
                        style="width: 100%; padding: 16px; border: 1px solid #e2e8f0; border-radius: 16px; font-size: 14px; outline: none; transition: 0.2s; resize: vertical; background: #f8fafc; font-family: inherit; line-height: 1.6;" 
                        onfocus="this.style.borderColor='#10b981'; this.style.background='#fff'"></textarea>
                    <div style="margin-top: 10px; font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px;">
                        <span>💡</span> Tips: Fokus pada keahlian spesifik yang diminta di deskripsi pekerjaan.
                    </div>
                </div>

                <button type="submit" style="width: 100%; background: #10b981; color: white; padding: 18px; border: none; border-radius: 16px; font-size: 16px; font-weight: 800; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 12px; box-shadow: 0 8px 16px rgba(16, 185, 129, 0.25);" 
                    onmouseover="this.style.background='#059669'; this.style.transform='translateY(-2px)'" 
                    onmouseout="this.style.background='#10b981'; this.style.transform='translateY(0)'">
                    Kirim Lamaran Pekerjaan <span>🚀</span>
                </button>
            </form>
        </div>

        <!-- SIDEBAR GUIDANCE -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- MATCH SCORE CARD -->
            <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 24px; padding: 32px; text-align: center; color: #fff; box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.1);">
                <div style="font-size: 40px; font-weight: 900; color: #10b981; font-family: Georgia, serif; margin-bottom: 8px;">{{ $score }}%</div>
                <div style="font-size: 10px; font-weight: 800; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;">Kecocokan Profil</div>
                <div style="width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden; margin-bottom: 20px;">
                    <div style="width: {{ $score }}%; height: 100%; background: #10b981;"></div>
                </div>
                <p style="font-size: 13px; color: rgba(255,255,255,0.7); line-height: 1.6; margin: 0;">
                    Skor Anda menunjukkan kesesuaian yang sangat baik untuk posisi ini. Tetap percaya diri!
                </p>
            </div>

            <!-- TIPS CARD -->
            <div style="background: white; border: 1px solid #e2e8f0; padding: 24px; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <h5 style="margin: 0 0 16px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">Tips Berhasil</h5>
                <ul style="margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 16px;">
                    <li style="display: flex; gap: 12px;">
                        <span style="color: #10b981; font-weight: 800;">01</span>
                        <span style="font-size: 13px; color: #475569; font-weight: 600;">Gunakan tata bahasa yang formal dan sopan.</span>
                    </li>
                    <li style="display: flex; gap: 12px;">
                        <span style="color: #10b981; font-weight: 800;">02</span>
                        <span style="font-size: 13px; color: #475569; font-weight: 600;">Sebutkan motivasi spesifik Anda melamar di perusahaan ini.</span>
                    </li>
                    <li style="display: flex; gap: 12px;">
                        <span style="color: #10b981; font-weight: 800;">03</span>
                        <span style="font-size: 13px; color: #475569; font-weight: 600;">Pastikan CV di profil Anda sudah versi terbaru.</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection
