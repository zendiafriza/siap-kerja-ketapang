<input type="checkbox" id="edit-modal-toggle" style="display: none;">

<div class="modal-overlay">
    <div class="modal-content" style="font-family: 'Nunito', sans-serif;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="background: #ecfdf5; color: #10b981; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    ⚙️
                </div>
                <h3 style="margin: 0; color: #0f172a; font-size: 18px; font-weight: 800; font-family: Georgia, serif;">Pengaturan Profil</h3>
            </div>
            <label for="edit-modal-toggle" style="font-size: 24px; cursor: pointer; color: #94a3b8; line-height: 1; padding: 4px; border-radius: 6px; transition: 0.2s;" class="close-btn">&times;</label>
        </div>
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 6px; letter-spacing: 0.5px;">NAMA LENGKAP</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px;">👤</span>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required 
                               style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #e2e8f0; border-radius: 12px; box-sizing: border-box; font-family: inherit; font-size: 14px; font-weight: 600; color: #1e293b; outline: none; transition: 0.3s;" class="input-focus">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 6px; letter-spacing: 0.5px;">ASAL SEKOLAH / UNIVERSITAS</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px;">🏫</span>
                        <input type="text" name="sekolah" value="{{ auth()->user()->sekolah ?? '' }}" placeholder="Contoh: SMKN 1 Ketapang" 
                               style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #e2e8f0; border-radius: 12px; box-sizing: border-box; font-family: inherit; font-size: 14px; font-weight: 600; color: #1e293b; outline: none; transition: 0.3s;" class="input-focus">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 6px; letter-spacing: 0.5px;">JURUSAN / KEAHLIAN</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px;">🎓</span>
                        <input type="text" name="jurusan" value="{{ auth()->user()->jurusan ?? '' }}" placeholder="Contoh: Agribisnis Tanaman Perkebunan" 
                               style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #e2e8f0; border-radius: 12px; box-sizing: border-box; font-family: inherit; font-size: 14px; font-weight: 600; color: #1e293b; outline: none; transition: 0.3s;" class="input-focus">
                    </div>
                </div>

            </div>

            <div style="display: flex; gap: 12px; margin-top: 32px;">
                <label for="edit-modal-toggle" style="flex: 1; padding: 12px; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center; font-weight: 800; background: #f8fafc; cursor: pointer; color: #475569; transition: 0.3s;" class="btn-cancel">Batal</label>
                
                <button type="submit" style="flex: 2; padding: 12px; border: none; background: #10b981; color: #fff; border-radius: 12px; font-weight: 800; cursor: pointer; font-family: inherit; transition: 0.3s; font-size: 14px;" class="btn-save">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<style>
    /* Logika Modal Muncul */
    #edit-modal-toggle:checked ~ .modal-overlay { 
        visibility: visible; 
        opacity: 1; 
    }
    #edit-modal-toggle:checked ~ .modal-overlay .modal-content { 
        transform: scale(1) translateY(0); 
        opacity: 1; 
    }

    /* Latar Belakang Blur */
    .modal-overlay {
        visibility: hidden;
        opacity: 0;
        position: fixed; 
        z-index: 10000; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%;
        background: rgba(15, 23, 42, 0.4); 
        backdrop-filter: blur(6px); /* Efek Blur Kekinian */
        display: flex;
        align-items: center; 
        justify-content: center;
        transition: all 0.3s ease;
    }

    /* Kotak Putih Utama */
    .modal-content {
        background: #fff; 
        padding: 28px; 
        border-radius: 20px; 
        width: 90%; 
        max-width: 420px; 
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        transform: scale(0.95) translateY(10px);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Animasi memantul halus */
    }

    /* Interaksi Hover & Focus */
    .close-btn:hover { background: #f1f5f9; color: #ef4444 !important; }
    .input-focus:focus { border-color: #10b981 !important; background: #ecfdf5; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
    .btn-cancel:hover { background: #e2e8f0 !important; color: #0f172a !important; }
    .btn-save:hover { background: #059669 !important; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
</style>