@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h2 style="margin: 0 0 4px 0; color: #0f172a; font-size: 24px; font-weight: 900; font-family: Georgia, serif;">Cari Pencari Kerja</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Temukan talenta terbaik dari database pencari kerja kami.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <input type="text" placeholder="Cari nama atau jurusan..." 
                style="padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 12px; width: 300px; font-size: 14px; outline: none; transition: 0.3s;"
                onfocus="this.style.borderColor='#4338ca'; this.style.boxShadow='0 0 0 3px rgba(67, 56, 202, 0.1)'">
            <button style="background: #4338ca; color: white; border: none; padding: 12px 20px; border-radius: 12px; font-weight: 800; cursor: pointer;">Cari</button>
        </div>
    </div>

    @if($candidates->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($candidates as $index => $kandidat)
                <div id="kandidat-card-{{ $index }}" style="background: #fff; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; text-align: center; transition: 0.3s; position: relative; box-shadow: 0 1px 3px rgba(0,0,0,0.05);"
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)'; this.style.borderColor='#4338ca'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'; this.style.borderColor='#e2e8f0'">
                    
                    <div style="width: 72px; height: 72px; background: linear-gradient(135deg, #4338ca, #6366f1); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 900; margin: 0 auto 16px auto; border: 4px solid #f8fafc; font-family: Georgia, serif;">
                        {{ strtoupper(substr($kandidat->name, 0, 1)) }}
                    </div>
                    
                    <h3 style="margin: 0 0 6px 0; color: #1e1b4b; font-size: 17px; font-weight: 800;">{{ $kandidat->name }}</h3>
                    
                    @php
                        $meta = $kandidat->profile_metadata ?? [];
                        $matchScore = $meta['match_score'] ?? rand(75, 98);
                        $xp = rand(1200, 4500);
                        $jurusan = $meta['pendidikan_jurusan'] ?? 'Jurusan Umum';
                    @endphp
                    
                    <p style="margin: 0 0 20px 0; color: #64748b; font-size: 13px; font-weight: 600;">{{ $jurusan }}</p>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; background: #f8fafc; padding: 12px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #f1f5f9;">
                        <div style="border-right: 1px solid #e2e8f0;">
                            <div style="font-size: 18px; font-weight: 900; color: #10b981;">{{ $matchScore }}%</div>
                            <div style="font-size: 9px; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Match Rate</div>
                        </div>
                        <div>
                            <div style="font-size: 18px; font-weight: 900; color: #4338ca;">{{ number_format($xp) }}</div>
                            <div style="font-size: 9px; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Exp Points</div>
                        </div>
                    </div>
                    
                    <button onclick="openKandidatModal('{{ addslashes($kandidat->name) }}', '{{ addslashes($jurusan) }}', {{ $matchScore }}, {{ $xp }}, 'kandidat-card-{{ $index }}')" 
                        style="width: 100%; background: #4338ca; border: none; color: white; padding: 12px; border-radius: 12px; cursor: pointer; font-weight: 800; transition: 0.2s;" 
                        onmouseover="this.style.background='#3730a3'" 
                        onmouseout="this.style.background='#4338ca'">
                        Review Profil
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div style="background: #fff; border-radius: 24px; padding: 60px; text-align: center; color: #64748b; border: 2px dashed #cbd5e1;">
            <div style="font-size: 56px; margin-bottom: 16px;">👥</div>
            <h2 style="color: #0f172a; margin-bottom: 8px; font-weight: 900;">Belum Ada Kandidat</h2>
            <p style="font-size: 14px;">Database kami sedang diperbarui. Silakan kembali beberapa saat lagi.</p>
        </div>
    @endif
</div>

@include('dashboard.modal_profil_kandidat')
@endsection
