@extends('dashboard.index')

@section('konten_tengah')
@php
    $meta = auth()->user()->profile_metadata ?? [];
    $score = $meta['match_score'] ?? 0;
    $pengalaman = $meta['pengalaman'] ?? [];
    $pendidikan = $meta['pendidikan'] ?? [];
@endphp

<div class="profile-modern-container">
    
    <!-- PREMIUM PROFILE HERO -->
    <div class="profile-hero-card">
        <div class="hero-left">
            <div class="avatar-container">
                @if($meta['foto_path'] ?? false)
                    <img src="{{ asset('storage/' . $meta['foto_path']) }}" class="hero-avatar">
                @else
                    <div class="hero-avatar-placeholder">
                        {{ strtoupper(substr(auth()->user()->name ?? 'PK', 0, 2)) }}
                    </div>
                @endif
                <div class="verified-badge">✓</div>
            </div>
            
            <div class="hero-info">
                <h1 class="hero-name">{{ auth()->user()->name }}</h1>
                <div class="hero-headline">{{ $meta['headline'] ?? 'Professional Candidate' }}</div>
                <div class="hero-meta">
                    <span>📍 {{ $meta['domisili'] ?? 'Ketapang, Kalbar' }}</span>
                    <span class="meta-dot"></span>
                    <span>📧 {{ $meta['email_profesional'] ?? auth()->user()->email }}</span>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="score-gauge">
                <svg viewBox="0 0 100 100">
                    <circle class="gauge-bg" cx="50" cy="50" r="45"></circle>
                    <circle class="gauge-fill" cx="50" cy="50" r="45" style="stroke-dashoffset: {{ 283 - (283 * $score / 100) }}"></circle>
                </svg>
                <div class="score-text">
                    <span class="score-num">{{ $score }}%</span>
                    <span class="score-label">Kesiapan Kerja</span>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success-modern animate-in">
            <div class="alert-icon">✨</div>
            <div class="alert-msg">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-success-modern animate-in" style="background: #fef2f2; border-color: #ef4444;">
            <div class="alert-icon">⚠️</div>
            <div class="alert-msg" style="color: #991b1b;">{{ session('error') }}</div>
        </div>
    @endif

    <form action="{{ route('profile.update.lengkap') }}" method="POST" enctype="multipart/form-data" class="modern-form">
        @csrf
        
        <div class="profile-sections-grid">
            
            <!-- LEFT COLUMN: CORE INFO -->
            <div class="section-column">
                
                <!-- 1. DATA PRIBADI -->
                <div class="modern-card card-emerald">
                    <div class="card-header">
                        <div class="header-icon">👤</div>
                        <div class="header-title">
                            <h3>Data Pribadi & Kontak</h3>
                            <p>Informasi dasar yang wajib diisi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <label>Nama Lengkap (KTP)</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $meta['nama_lengkap'] ?? auth()->user()->name) }}" class="m-input">
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label>Email Profesional</label>
                                <input type="email" name="email_profesional" value="{{ old('email_profesional', $meta['email_profesional'] ?? auth()->user()->email) }}" class="m-input">
                            </div>

                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label>WhatsApp / No. HP</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $meta['no_hp'] ?? '') }}" class="m-input">
                            </div>
                            <div class="input-group">
                                <label>Domisili Saat Ini</label>
                                <input type="text" name="domisili" value="{{ old('domisili', $meta['domisili'] ?? '') }}" class="m-input" placeholder="Kota, Provinsi">
                            </div>
                        </div>

                        <div class="input-group">
                            <label>LinkedIn URL</label>
                            <input type="url" name="linkedin" value="{{ old('linkedin', $meta['linkedin'] ?? '') }}" class="m-input">
                        </div>
                    </div>
                </div>

                <!-- 2. PROFIL PROFESIONAL -->
                <div class="modern-card card-indigo">
                    <div class="card-header">
                        <div class="header-icon">💡</div>
                        <div class="header-title">
                            <h3>Profil Profesional</h3>
                            <p>Ringkasan karir dan ekspektasi Anda</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <label>Headline Karir</label>
                            <input type="text" name="headline" value="{{ old('headline', $meta['headline'] ?? '') }}" class="m-input" placeholder="Contoh: Senior UI Designer | Fullstack Dev">
                        </div>
                        <div class="input-group">
                            <label>Tentang Saya</label>
                            <textarea name="summary" rows="4" class="m-input m-textarea">{{ old('summary', $meta['summary'] ?? '') }}</textarea>
                        </div>
                        <div class="input-group">
                            <label>Ekspektasi Gaji</label>
                            <input type="text" name="gaji" value="{{ old('gaji', $meta['gaji'] ?? '') }}" class="m-input">
                        </div>
                    </div>
                </div>

                <!-- 5. KEAHLIAN -->
                <div class="modern-card card-teal">
                    <div class="card-header">
                        <div class="header-icon">🛠️</div>
                        <div class="header-title">
                            <h3>Keahlian & Bahasa</h3>
                            <p>Skill teknis dan kemampuan bahasa</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <label>Hard Skills</label>
                            <input type="text" name="hard_skills" value="{{ old('hard_skills', $meta['hard_skills'] ?? '') }}" class="m-input" placeholder="Skill 1, Skill 2...">
                        </div>
                        <div class="input-group">
                            <label>Soft Skills</label>
                            <input type="text" name="soft_skills" value="{{ old('soft_skills', $meta['soft_skills'] ?? '') }}" class="m-input">
                        </div>
                        <div class="input-group">
                            <label>Bahasa</label>
                            <input type="text" name="bahasa" value="{{ old('bahasa', $meta['bahasa'] ?? '') }}" class="m-input">
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: DYNAMIC INFO -->
            <div class="section-column">
                
                <!-- 3. PENGALAMAN -->
                <div class="modern-card card-orange">
                    <div class="card-header">
                        <div class="header-icon">💼</div>
                        <div class="header-title">
                            <h3>Pengalaman Kerja</h3>
                            <p>Riwayat karir dan pencapaian</p>
                        </div>
                        <button type="button" onclick="addExperience()" class="btn-add">Add +</button>
                    </div>
                    <div class="card-body" id="experience-container">
                        @forelse($pengalaman as $index => $item)
                        <div class="dynamic-block">
                            <div class="block-header">
                                <span class="block-number">#{{ $index + 1 }}</span>
                                @if($index > 0)<button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-del">Delete</button>@endif
                            </div>
                            <div class="input-group">
                                <label>Perusahaan</label>
                                <input type="text" name="pengalaman_perusahaan[]" value="{{ $item['perusahaan'] ?? '' }}" class="m-input">
                            </div>
                            <div class="input-row">
                                <div class="input-group">
                                    <label>Posisi</label>
                                    <input type="text" name="pengalaman_posisi[]" value="{{ $item['posisi'] ?? '' }}" class="m-input">
                                </div>
                                <div class="input-group">
                                    <label>Durasi</label>
                                    <input type="text" name="pengalaman_durasi[]" value="{{ $item['durasi'] ?? '' }}" class="m-input">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Tugas Utama</label>
                                <textarea name="pengalaman_deskripsi[]" rows="2" class="m-input m-textarea">{{ $item['deskripsi'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @empty
                        <div class="dynamic-block">
                            <div class="input-group">
                                <label>Perusahaan</label>
                                <input type="text" name="pengalaman_perusahaan[]" class="m-input">
                            </div>
                            <div class="input-group">
                                <label>Posisi</label>
                                <input type="text" name="pengalaman_posisi[]" class="m-input">
                            </div>
                            <div class="input-group">
                                <label>Durasi</label>
                                <input type="text" name="pengalaman_durasi[]" class="m-input">
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 4. PENDIDIKAN -->
                <div class="modern-card card-purple">
                    <div class="card-header">
                        <div class="header-icon">🎓</div>
                        <div class="header-title">
                            <h3>Riwayat Pendidikan</h3>
                            <p>Edukasi formal Anda</p>
                        </div>
                        <button type="button" onclick="addEducation()" class="btn-add">Add +</button>
                    </div>
                    <div class="card-body" id="education-container">
                        @forelse($pendidikan as $index => $item)
                        <div class="dynamic-block">
                            <div class="block-header">
                                <span class="block-number">#{{ $index + 1 }}</span>
                                @if($index > 0)<button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-del">Delete</button>@endif
                            </div>
                            <div class="input-group">
                                <label>Institusi</label>
                                <input type="text" name="pendidikan_institusi[]" value="{{ $item['institusi'] ?? '' }}" class="m-input">
                            </div>
                            <div class="input-row">
                                <div class="input-group">
                                    <label>Jenjang / Jurusan</label>
                                    <input type="text" name="pendidikan_jurusan[]" value="{{ $item['jurusan'] ?? '' }}" class="m-input">
                                </div>
                                <div class="input-group">
                                    <label>Tahun Lulus</label>
                                    <input type="text" name="pendidikan_lulus[]" value="{{ $item['lulus'] ?? '' }}" class="m-input">
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="dynamic-block">
                            <div class="input-group">
                                <label>Institusi</label>
                                <input type="text" name="pendidikan_institusi[]" class="m-input">
                            </div>
                            <div class="input-group">
                                <label>Jurusan</label>
                                <input type="text" name="pendidikan_jurusan[]" class="m-input">
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 6 & 7. PORTOFOLIO & DOKUMEN -->
                <div class="modern-card card-slate">
                    <div class="card-header">
                        <div class="header-icon">📂</div>
                        <div class="header-title">
                            <h3>Portofolio & Dokumen</h3>
                            <p>Bukti pendukung profil Anda</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <label>Link Portofolio (Behance, GitHub, etc)</label>
                            <input type="url" name="portofolio" value="{{ old('portofolio', $meta['portofolio'] ?? '') }}" class="m-input">
                        </div>
                        
                        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                            <label style="display: block; margin-bottom: 12px; font-size: 13px; font-weight: 700; color: #475569;">Resume/CV (PDF)</label>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                @if(auth()->user()->cv_path)
                                    <div style="flex: 1; background: #f0fdf4; border: 1px solid #dcfce7; padding: 12px 16px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 20px;">📄</span>
                                        <div style="flex: 1;">
                                            <div style="font-size: 13px; font-weight: 700; color: #166534;">CV Sudah Tersimpan</div>
                                            <div style="font-size: 11px; color: #15803d;">Siap digunakan untuk melamar</div>
                                        </div>
                                    </div>
                                @else
                                    <div style="flex: 1; background: #fef2f2; border: 1px solid #fee2e2; padding: 12px 16px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 20px;">⚠️</span>
                                        <div style="flex: 1;">
                                            <div style="font-size: 13px; font-weight: 700; color: #991b1b;">CV Belum Diupload</div>
                                            <div style="font-size: 11px; color: #b91c1c;">Wajib upload sebelum melamar</div>
                                        </div>
                                    </div>
                                @endif
                                <button type="button" onclick="document.getElementById('cv-upload-modal').style.display='flex'" 
                                    style="padding: 12px 20px; background: #0f172a; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 13px;">
                                    {{ auth()->user()->cv_path ? 'Ganti CV' : 'Upload CV' }}
                                </button>
                            </div>
                        </div>

                        <div class="file-upload-grid">
                            <div class="file-box">
                                <label>Pas Foto Formal</label>
                                <input type="file" name="foto" class="m-file">
                                @if($meta['foto_path'] ?? false)<div class="file-status">✅ Ready</div>@endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- STICKY BOTTOM BAR -->
        <div class="sticky-footer">
            <div class="footer-content">
                <div class="footer-hint">
                    <span class="hint-icon">💡</span> Pastikan semua data benar sebelum menyimpan
                </div>
                <button type="submit" class="btn-save-modern">
                    <span class="save-icon">💾</span> Simpan Seluruh Perubahan
                </button>
            </div>
        </div>

    </form>
</div>

<!-- CV UPLOAD MODAL -->
<div id="cv-upload-modal" style="display:none; position:fixed; inset:0; background:rgba(15, 23, 42, 0.8); backdrop-filter:blur(8px); z-index:2000; align-items:center; justify-content:center; padding:20px;">
    <div class="modern-card card-emerald animate-in" style="width:100%; max-width:450px;">
        <div class="card-header">
            <div class="header-icon">📄</div>
            <div class="header-title">
                <h3>Upload CV Profesional</h3>
                <p>Format PDF, Maksimal 2MB</p>
            </div>
            <button onclick="document.getElementById('cv-upload-modal').style.display='none'" style="margin-left:auto; background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.cv.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="border: 2px dashed #e2e8f0; border-radius: 20px; padding: 40px; text-align: center; margin-bottom: 24px; cursor: pointer; transition: 0.3s;" 
                    onmouseover="this.style.borderColor='#10b981'; this.style.background='#f0fdf4'" 
                    onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='transparent'"
                    onclick="document.getElementById('cv-file-input').click()">
                    <div style="font-size: 48px; margin-bottom: 16px;">📂</div>
                    <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Klik untuk Pilih File</div>
                    <div style="font-size: 12px; color: #64748b;">Hanya menerima file PDF</div>
                    <input type="file" id="cv-file-input" name="cv" accept=".pdf" style="display:none" onchange="document.getElementById('file-name-display').innerText = this.files[0].name; document.getElementById('file-info').style.display='block'">
                </div>
                
                <div id="file-info" style="display:none; margin-bottom: 24px; background: #f8fafc; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size: 20px;">📎</span>
                        <div id="file-name-display" style="font-size: 13px; font-weight: 600; color: #0f172a; word-break: break-all;"></div>
                    </div>
                </div>

                <button type="submit" class="btn-save-modern" style="width:100%; position:static; transform:none; justify-content:center; box-shadow:none;">
                    Unggah CV Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* MODERN PROFILE STYLES */
    .profile-modern-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #1e293b;
        padding-bottom: 150px;
    }

    /* HERO CARD */
    .profile-hero-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 32px;
        padding: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        color: #fff;
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.3);
        position: relative;
        overflow: hidden;
    }

    .profile-hero-card::after {
        content: "";
        position: absolute;
        top: -20%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero-left {
        display: flex;
        gap: 32px;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .avatar-container {
        position: relative;
    }

    .hero-avatar, .hero-avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 32px;
        object-fit: cover;
        border: 4px solid rgba(255,255,255,0.1);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .hero-avatar-placeholder {
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: 900;
        font-family: Georgia, serif;
    }

    .verified-badge {
        position: absolute;
        bottom: -5px;
        right: -5px;
        background: #10b981;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid #0f172a;
        font-size: 14px;
        font-weight: bold;
    }

    .hero-name {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 8px 0;
        font-family: Georgia, serif;
        letter-spacing: -1px;
    }

    .hero-headline {
        font-size: 16px;
        color: #10b981;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .hero-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 13px;
        color: #94a3b8;
        font-weight: 600;
    }

    .meta-dot {
        width: 4px;
        height: 4px;
        background: #475569;
        border-radius: 50%;
    }

    /* SCORE GAUGE */
    .hero-right {
        position: relative;
        z-index: 1;
    }

    .score-gauge {
        width: 140px;
        height: 140px;
        position: relative;
    }

    .score-gauge svg {
        transform: rotate(-90deg);
    }

    .gauge-bg {
        fill: none;
        stroke: rgba(255,255,255,0.05);
        stroke-width: 8;
    }

    .gauge-fill {
        fill: none;
        stroke: #10b981;
        stroke-width: 8;
        stroke-linecap: round;
        stroke-dasharray: 283;
        transition: stroke-dashoffset 1s ease-out;
    }

    .score-text {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .score-num {
        font-size: 28px;
        font-weight: 900;
        color: #10b981;
        font-family: Georgia, serif;
    }

    .score-label {
        font-size: 10px;
        color: #94a3b8;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    /* SECTIONS GRID */
    .profile-sections-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        align-items: start;
    }

    @media (max-width: 1200px) {
        .profile-sections-grid { grid-template-columns: 1fr; }
        .profile-hero-card { flex-direction: column; text-align: center; gap: 40px; }
        .hero-left { flex-direction: column; gap: 20px; }
        .hero-meta { justify-content: center; }
    }

    /* MODERN CARDS */
    .modern-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: 0.3s;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    }

    .modern-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0,0,0,0.05);
    }

    .card-emerald { border-top: 5px solid #10b981; }
    .card-indigo { border-top: 5px solid #6366f1; }
    .card-teal { border-top: 5px solid #06b6d4; }
    .card-orange { border-top: 5px solid #f59e0b; }
    .card-purple { border-top: 5px solid #8b5cf6; }
    .card-slate { border-top: 5px solid #475569; }

    .card-header {
        padding: 24px 32px;
        display: flex;
        align-items: center;
        gap: 16px;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-icon {
        width: 44px;
        height: 44px;
        background: #f8fafc;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .header-title h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        font-family: Georgia, serif;
    }

    .header-title p {
        margin: 2px 0 0 0;
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
    }

    .card-body {
        padding: 32px;
    }

    /* FORMS */
    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
    }

    .m-input {
        width: 100%;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
        transition: 0.2s;
        font-family: inherit;
    }

    .m-input:focus {
        background: #fff;
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        outline: none;
    }

    .input-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .m-textarea {
        resize: none;
        line-height: 1.6;
    }

    /* DYNAMIC BLOCKS */
    .dynamic-block {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 20px;
        position: relative;
    }

    .block-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .block-number {
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        background: #fff;
        padding: 4px 10px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .btn-add {
        margin-left: auto;
        background: #0f172a;
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-add:hover { background: #1e293b; transform: scale(1.05); }

    .btn-del {
        background: #fef2f2;
        color: #ef4444;
        border: none;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn-del:hover { background: #fee2e2; }

    /* FILES */
    .file-upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 20px;
    }

    .file-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        padding: 16px;
        border-radius: 16px;
        text-align: center;
    }

    .m-file {
        font-size: 11px;
        margin-top: 8px;
        width: 100%;
    }

    .file-status {
        margin-top: 8px;
        font-size: 10px;
        font-weight: 800;
        color: #10b981;
    }

    /* STICKY FOOTER */
    .sticky-footer {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 1000px;
        z-index: 1000;
    }

    .footer-content {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.3);
        padding: 16px 32px;
        border-radius: 32px;
        box-shadow: 0 20px 50px -10px rgba(0,0,0,0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-hint {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save-modern {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border: none;
        padding: 16px 32px;
        border-radius: 20px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
    }

    .btn-save-modern:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.5);
    }

    /* ALERTS */
    .alert-success-modern {
        background: #ecfdf5;
        border: 1px solid #10b981;
        padding: 20px 32px;
        border-radius: 24px;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1);
    }

    .alert-icon { font-size: 24px; }
    .alert-msg { font-weight: 700; color: #065f46; font-size: 15px; }

    .animate-in {
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function addExperience() {
        const container = document.getElementById('experience-container');
        const count = container.querySelectorAll('.dynamic-block').length + 1;
        const block = document.createElement('div');
        block.className = 'dynamic-block animate-in';
        block.innerHTML = `
            <div class="block-header">
                <span class="block-number">#${count}</span>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-del">Delete</button>
            </div>
            <div class="input-group">
                <label>Perusahaan</label>
                <input type="text" name="pengalaman_perusahaan[]" class="m-input">
            </div>
            <div class="input-row">
                <div class="input-group">
                    <label>Posisi</label>
                    <input type="text" name="pengalaman_posisi[]" class="m-input">
                </div>
                <div class="input-group">
                    <label>Durasi</label>
                    <input type="text" name="pengalaman_durasi[]" class="m-input">
                </div>
            </div>
            <div class="input-group">
                <label>Tugas Utama</label>
                <textarea name="pengalaman_deskripsi[]" rows="2" class="m-input m-textarea"></textarea>
            </div>
        `;
        container.appendChild(block);
    }

    function addEducation() {
        const container = document.getElementById('education-container');
        const count = container.querySelectorAll('.dynamic-block').length + 1;
        const block = document.createElement('div');
        block.className = 'dynamic-block animate-in';
        block.innerHTML = `
            <div class="block-header">
                <span class="block-number">#${count}</span>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-del">Delete</button>
            </div>
            <div class="input-group">
                <label>Institusi</label>
                <input type="text" name="pendidikan_institusi[]" class="m-input">
            </div>
            <div class="input-row">
                <div class="input-group">
                    <label>Jenjang / Jurusan</label>
                    <input type="text" name="pendidikan_jurusan[]" class="m-input">
                </div>
                <div class="input-group">
                    <label>Tahun Lulus</label>
                    <input type="text" name="pendidikan_lulus[]" class="m-input">
                </div>
            </div>
        `;
        container.appendChild(block);
    }
</script>
@endsection
