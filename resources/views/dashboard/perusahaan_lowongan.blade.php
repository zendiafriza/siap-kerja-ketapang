@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h2 style="margin: 0 0 4px 0; color: #0f172a; font-size: 24px; font-weight: 900; font-family: Georgia, serif;">Kelola Lowongan</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Monitor dan kelola daftar lowongan aktif Anda.</p>
        </div>
        <button onclick="document.getElementById('modal-lowongan').style.display='flex'" 
            style="background: #4338ca; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.3s; box-shadow: 0 4px 12px rgba(67, 56, 202, 0.2);">
            + Buat Lowongan Baru
        </button>
    </div>

    @if($jobs->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            @foreach($jobs as $job)
                <div style="background: #fff; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; position: relative; transition: 0.3s; box-shadow: 0 1px 3px rgba(0,0,0,0.05);"
                    onmouseover="this.style.borderColor='#4338ca'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'">
                    
                    <div style="position: absolute; top: 24px; right: 24px; background: #ecfdf5; color: #10b981; padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;">Aktif</div>
                    
                    <h3 style="margin: 0 0 8px 0; color: #1e1b4b; font-size: 18px; font-weight: 800;">{{ $job->title }}</h3>
                    <div style="margin: 0 0 16px 0; display: flex; gap: 12px; font-size: 12px; color: #64748b; font-weight: 600; align-items: center;">
                        <span>📍 {{ $job->location }}</span>
                        <span>💼 {{ $job->type }}</span>
                        @if($job->salary)
                            <span style="background: #f0fdf4; color: #15803d; padding: 2px 8px; border-radius: 6px; font-size: 11px;">
                                💰 {{ $job->salary }} {{ $job->hide_salary ? '(Hidden)' : '' }}
                            </span>
                        @endif
                    </div>
                    
                    <p style="margin: 0 0 20px 0; color: #475569; font-size: 13px; line-height: 1.6;">{{ Str::limit($job->description, 120) }}</p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 600;">Berakhir {{ $job->deadline }}</div>
                        <div style="display: flex; gap: 8px;">
                            <button style="background: white; border: 1px solid #cbd5e1; color: #334155; padding: 6px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; transition: 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">Edit</button>
                            <button style="background: white; border: 1px solid #fee2e2; color: #ef4444; padding: 6px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; transition: 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='white'">Tutup</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="background: #fff; border-radius: 24px; padding: 60px; text-align: center; color: #64748b; border: 2px dashed #cbd5e1;">
            <div style="font-size: 56px; margin-bottom: 16px;">📂</div>
            <h2 style="color: #0f172a; margin-bottom: 8px; font-weight: 900;">Belum Ada Lowongan</h2>
            <p style="font-size: 14px; margin-bottom: 24px;">Anda belum mempublikasikan lowongan pekerjaan apapun.</p>
            <button onclick="document.getElementById('modal-lowongan').style.display='flex'" 
                style="background: #4338ca; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 800; cursor: pointer;">
                Mulai Pasang Lowongan
            </button>
        </div>
    @endif
</div>

@include('dashboard.modal_lowongan')

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@endsection
