<div style="display: flex; flex-direction: column; gap: 24px; font-family: 'Inter', 'Nunito', sans-serif;">

    <!-- AI RECOMMENDATIONS -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="font-size: 11px; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 14px;">🤖</span> REKOMENDASI AI
            </div>
            <a href="{{ route('dashboard.rekomendasi') }}" style="color: #10b981; font-size: 12px; text-decoration: none; font-weight: 700;">Lihat</a>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 14px; border: 1px solid transparent; transition: 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#dcfce7'; this.style.background='#fff'" onmouseout="this.style.borderColor='transparent'; this.style.background='#f8fafc'">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <div style="width: 36px; height: 36px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">🌿</div>
                    <div>
                        <div style="color: #1e293b; font-size: 13px; font-weight: 700;">Mekanik Alat Berat</div>
                        <div style="color: #64748b; font-size: 11px; font-weight: 600;">Cargill · 96% Match</div>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 14px; border: 1px solid transparent; transition: 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#dcfce7'; this.style.background='#fff'" onmouseout="this.style.borderColor='transparent'; this.style.background='#f8fafc'">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <div style="width: 36px; height: 36px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">⚙️</div>
                    <div>
                        <div style="color: #1e293b; font-size: 13px; font-weight: 700;">Operator Pabrik</div>
                        <div style="color: #64748b; font-size: 11px; font-weight: 600;">Bumitama · 88% Match</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DEADLINES -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="font-size: 11px; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 14px;">⏰</span> DEADLINE
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; gap: 12px; align-items: center;">
                <div style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%;"></div>
                <div style="flex: 1;">
                    <div style="color: #1e293b; font-size: 13px; font-weight: 700;">Operator Kebun</div>
                    <div style="color: #ef4444; font-size: 11px; font-weight: 600;">13 hari lagi</div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; align-items: center;">
                <div style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%;"></div>
                <div style="flex: 1;">
                    <div style="color: #1e293b; font-size: 13px; font-weight: 700;">Asisten Produksi</div>
                    <div style="color: #f59e0b; font-size: 11px; font-weight: 600;">35 hari lagi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK STATS -->
    <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; padding: 24px; color: #fff; box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.2);">
        <div style="font-size: 11px; color: rgba(255,255,255,0.4); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
            RINGKASAN AKTIVITAS
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
            <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 24px; font-weight: 900; color: #10b981; font-family: Georgia, serif; margin-bottom: 4px;">{{ auth()->user()->total_lamar ?? 3 }}</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.4); font-weight: 800; text-transform: uppercase;">Dilamar</div>
            </div>
            <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="font-size: 24px; font-weight: 900; color: #fff; font-family: Georgia, serif; margin-bottom: 4px;">{{ auth()->user()->total_simpan ?? 5 }}</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.4); font-weight: 800; text-transform: uppercase;">Simpan</div>
            </div>
        </div>

        <a href="{{ route('dashboard.profil') }}" style="display: flex; align-items: center; justify-content: center; width: 100%; background: #10b981; color: #fff; padding: 12px; border-radius: 14px; text-decoration: none; font-size: 13px; font-weight: 800; transition: 0.3s;" onmouseover="this.style.background='#059669'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#10b981'; this.style.transform='translateY(0)'">
            Detail Profil Saya <span>→</span>
        </a>
    </div>

</div>