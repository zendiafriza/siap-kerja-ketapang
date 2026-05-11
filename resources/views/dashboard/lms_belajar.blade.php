@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">

    <!-- LMS HERO SECTION -->
    <div style="background: linear-gradient(135deg, #0f172a 0%, #312e81 100%); border-radius: 24px; padding: 40px; color: #fff; margin-bottom: 32px; position: relative; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(49, 46, 129, 0.3);">
        
        <!-- Decoration -->
        <div style="position: absolute; inset: 0; background-image: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.05) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.05) 0%, transparent 50%); z-index: 0;"></div>
        <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px); background-size: 32px 32px; z-index: 0;"></div>

        <div style="position: relative; z-index: 1;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; color: #c4b5fd; margin-bottom: 16px;">
                <span style="font-size: 14px;">🎓</span> LMS SIAP KERJA
            </div>

            <h1 style="font-size: 28px; font-weight: 800; margin: 0 0 8px 0; color: #fff; font-family: Georgia, serif; letter-spacing: -0.5px;">
                Tingkatkan Keahlian, <span style="color: #34d399;">Raih Karir Impian</span>
            </h1>
            <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin: 0 0 32px 0; font-weight: 500; max-width: 500px; line-height: 1.6;">
                Akses kurikulum industri terbaru secara gratis. Selesaikan materi dan dapatkan XP untuk meningkatkan Match Score Anda.
            </p>

            <!-- STATS STRIP -->
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 20px 24px; display: flex; align-items: center; gap: 32px; backdrop-filter: blur(10px);">
                <div style="min-width: 100px;">
                    <div style="font-size: 24px; font-weight: 900; color: #fbbf24; line-height: 1; font-family: Georgia, serif;">
                        {{ number_format(auth()->user()->xp ?? 1240, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 10px; color: rgba(255,255,255,0.5); font-weight: 800; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px;">XP Terkumpul</div>
                </div>

                <div style="flex: 1;">
                    <div style="display: flex; justify-content: space-between; font-size: 12px; color: rgba(255,255,255,0.7); font-weight: 700; margin-bottom: 10px;">
                        <span>Level 8 &rarr; 9</span>
                        <span>82%</span>
                    </div>
                    <div style="width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden;">
                        <div style="width: 82%; height: 100%; background: linear-gradient(90deg, #34d399, #10b981);"></div>
                    </div>
                </div>

                <div style="min-width: 100px; text-align: right;">
                    <div style="font-size: 24px; font-weight: 900; color: #fff; line-height: 1; font-family: Georgia, serif;">14</div>
                    <div style="font-size: 10px; color: rgba(255,255,255,0.5); font-weight: 800; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Materi Selesai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CATEGORY FILTERS -->
    <div style="display: flex; gap: 12px; margin-bottom: 32px; flex-wrap: wrap;">
        <button style="background: #fff; border: 1px solid #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 14px; font-weight: 700; font-size: 13px; cursor: pointer; transition: 0.2s;">🌱 SD / Dasar</button>
        <button style="background: #fff; border: 1px solid #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 14px; font-weight: 700; font-size: 13px; cursor: pointer; transition: 0.2s;">📖 SMP / Menengah</button>
        <button style="background: #fff; border: 1px solid #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 14px; font-weight: 700; font-size: 13px; cursor: pointer; transition: 0.2s;">🔬 SMA / Atas</button>
        <button style="background: #ecfdf5; border: 2px solid #10b981; color: #065f46; padding: 10px 20px; border-radius: 14px; font-weight: 800; font-size: 13px; cursor: pointer;">⚙️ SMK Kejuruan</button>
    </div>

    <!-- COURSE GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
        
        <!-- COURSE CARD 1 -->
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; transition: 0.3s; cursor: pointer; position: relative; overflow: hidden;"
            onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -10px rgba(0,0,0,0.05)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 32px; margin-bottom: 20px;">🌿</div>
            <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif;">Pemupukan Presisi Kelapa Sawit</h4>
            <p style="font-size: 12px; color: #64748b; margin-bottom: 20px; font-weight: 500;">Mempelajari teknik pemupukan 4T untuk hasil panen maksimal.</p>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 800; color: #10b981;">Progres Belajar</span>
                <span style="font-size: 11px; font-weight: 800; color: #0f172a;">40%</span>
            </div>
            <div style="width: 100%; height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                <div style="width: 40%; height: 100%; background: #10b981;"></div>
            </div>
        </div>

        <!-- COURSE CARD 2 -->
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; transition: 0.3s; cursor: pointer; position: relative; overflow: hidden;"
            onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -10px rgba(0,0,0,0.05)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 32px; margin-bottom: 20px;">🚜</div>
            <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif;">Operator Alat Berat Dasar</h4>
            <p style="font-size: 12px; color: #64748b; margin-bottom: 20px; font-weight: 500;">Pengenalan komponen dan prosedur keselamatan alat berat sawit.</p>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 800; color: #10b981;">Progres Belajar</span>
                <span style="font-size: 11px; font-weight: 800; color: #0f172a;">15%</span>
            </div>
            <div style="width: 100%; height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                <div style="width: 15%; height: 100%; background: #10b981;"></div>
            </div>
        </div>

        <!-- COURSE CARD 3 (NEW) -->
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; transition: 0.3s; cursor: pointer; position: relative; overflow: hidden;"
            onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -10px rgba(0,0,0,0.05)'"
            onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 32px; margin-bottom: 20px;">🧪</div>
            <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; font-family: Georgia, serif;">Analis Mutu Laboratorium CPO</h4>
            <p style="font-size: 12px; color: #64748b; margin-bottom: 20px; font-weight: 500;">Standar pengujian FFA dan kadar air pada CPO ekspor.</p>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 800; color: #64748b;">Belum Dimulai</span>
                <span style="font-size: 11px; font-weight: 800; color: #0f172a;">0%</span>
            </div>
            <div style="width: 100%; height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                <div style="width: 0%; height: 100%; background: #10b981;"></div>
            </div>
        </div>

    </div>

</div>
@endsection
