@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">
    
    <!-- PAGE TITLE -->
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif;">
            Lowongan Disimpan
        </h1>
        <p style="margin: 0; color: #64748b; font-size: 14px; font-weight: 500;">
            Daftar pekerjaan yang Anda simpan untuk ditinjau atau dilamar nanti.
        </p>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 16px; border-radius: 16px; margin-bottom: 24px; font-weight: 700; font-size: 14px;">
            ✨ {{ session('success') }}
        </div>
    @endif

    <!-- SAVED LIST -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">

        @forelse($savedJobs ?? [] as $saved)
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative;"
            onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 8px 16px -4px rgba(0,0,0,0.05)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div style="display: flex; gap: 16px; align-items: center;">
                    <div style="width: 52px; height: 52px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        🏢
                    </div>
                    <div>
                        <h4 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 800; color: #0f172a; font-family: Georgia, serif;">
                            {{ $saved->job->title ?? 'Posisi Pekerjaan' }}
                        </h4>
                        <div style="font-size: 13px; color: #64748b; font-weight: 600;">
                            {{ $saved->job->company ?? 'Nama Perusahaan' }} · {{ $saved->job->location ?? 'Lokasi' }}
                        </div>
                    </div>
                </div>
                
                <div style="color: #10b981; font-size: 24px;">🔖</div>
            </div>

            <div style="display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap;">
                <span style="background: #f0fdf4; color: #166534; font-size: 11px; padding: 6px 14px; border-radius: 10px; font-weight: 700; border: 1px solid #dcfce7;">
                    {{ $saved->job->type ?? 'Tipe' }}
                </span>
                <span style="background: #f1f5f9; color: #475569; font-size: 11px; padding: 6px 14px; border-radius: 10px; font-weight: 700;">
                    {{ $saved->job->category ?? 'Kategori' }}
                </span>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">📌 Disimpan {{ $saved->created_at->diffForHumans() }}</span>
                
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('dashboard.lamar.show', $saved->job->id) }}"
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
            <div style="font-size: 64px; margin-bottom: 24px; opacity: 0.5;">🔖</div>
            <h4 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 12px 0;">Belum Ada Simpanan</h4>
            <p style="color: #64748b; font-size: 15px; margin: 0 0 32px 0; max-width: 400px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                Anda belum menyimpan lowongan apa pun. Jelajahi lowongan yang tersedia dan simpan yang menarik perhatian Anda!
            </p>
            <a href="{{ route('dashboard.index') }}" style="display: inline-flex; background: #10b981; color: #fff; padding: 12px 32px; border-radius: 12px; font-weight: 800; text-decoration: none; transition: 0.3s;">
                Eksplorasi Lowongan
            </a>
        </div>
        @endforelse

    </div>
</div>
@endsection
