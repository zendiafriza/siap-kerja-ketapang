@extends('layouts.app')

@section('isi')
<div id="page-login" class="active">
    <div class="login-left">
        <div class="left-content">
            <div class="left-top">
                <div class="logo-circle">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Logo_Ketapang.png" alt="Logo">
                </div>
                <div class="logo-text">
                    <div style="font-size: 18px; font-weight: 800; letter-spacing: -0.5px;">Siap Kerja</div>
                    <div style="font-size: 11px; font-weight: 600; opacity: 0.8; margin-top: -2px;">Ketapang Portal</div>
                </div>
            </div>
            <div class="left-headline">Satu platform,<br><span class="accent">semua peluang</span><br>Ketapang</div>
            <div class="left-desc">Pencari kerja mendapatkan karir, Perusahaan menemukan talenta, dan semua bisa belajar.</div>
            <div class="role-showcase">
                <div class="rs-card" onclick="setLRole('pencari_kerja')">
                    <div class="rs-icon">👨‍🎓</div>
                    <div class="rs-name">Pencari Kerja</div>
                    <div class="rs-count">5.600+ terdaftar</div>
                </div>
                <div class="rs-card" onclick="setLRole('perusahaan')">
                    <div class="rs-icon">🏢</div>
                    <div class="rs-name">Perusahaan</div>
                    <div class="rs-count">240+ mitra aktif</div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-right">
        <div class="lform-container">
            
            <!-- VIEW: MAIN LOGIN -->
            <div class="lform-view active" id="lv-main">
                <h2 class="lform-ttl">Selamat Datang 👋</h2>
                <p class="lform-sub">Masuk untuk melanjutkan ke portal Anda.</p>

                <div class="role-tabs">
                    <div class="rt on" id="rt-pencari_kerja" onclick="setLRole('pencari_kerja')">
                        <div class="rt-icon">🎓</div>
                        <div class="rt-label">Pencari Kerja</div>
                    </div>
                    <div class="rt" id="rt-perus" onclick="setLRole('perus')">
                        <div class="rt-icon">🏢</div>
                        <div class="rt-label">Perusahaan</div>
                    </div>
                    <div class="rt" id="rt-lpk" onclick="setLRole('lpk')">
                        <div class="rt-icon">🏫</div>
                        <div class="rt-label">LPK</div>
                    </div>
                </div>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" id="login-role-input" value="pencari_kerja">
                    <div class="f-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" id="l-email" placeholder="contoh@email.com" required value="{{ old('email') }}">
                    </div>
                    <div class="f-group">
                        <div style="display:flex; justify-content:space-between; align-items:center">
                            <label>Kata Sandi</label>
                            <span class="f-link" onclick="showLV('forgot')">Lupa sandi?</span>
                        </div>
                        <div style="position:relative">
                            <input type="password" name="password" id="l-pw" placeholder="••••••••" required>
                            <span class="pw-toggle" onclick="togglePw('l-pw', this)">👁️</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn" id="login-btn">Masuk Sekarang →</button>
                </form>

                <div class="divider"><span>Atau masuk dengan</span></div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <a href="{{ route('google.redirect', ['role' => 'pencari_kerja']) }}" id="google-login-btn" class="social-btn">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="G" style="width:16px">
                        Google
                    </a>
                    <button class="social-btn" onclick="showToast('Fitur segera hadir!')">
                        <img src="https://www.svgrepo.com/show/303114/facebook-3.svg" alt="F" style="width:16px">
                        Facebook
                    </button>
                </div>

                <p class="lform-foot">Belum punya akun? <span class="f-link" onclick="showLV('register')">Daftar gratis</span></p>
            </div>

            <!-- VIEW: REGISTER -->
            <div class="lform-view" id="lv-register">
                <h2 class="lform-ttl">Buat Akun Gratis</h2>
                <p class="lform-sub">Pilih tipe akun Anda untuk memulai.</p>

                <div class="role-tabs">
                    <div class="rt on" id="rtr-pencari_kerja" onclick="setRRole('pencari_kerja')">
                        <div class="rt-icon">🎓</div>
                        <div class="rt-label">Pencari Kerja</div>
                    </div>
                    <div class="rt" id="rtr-perus" onclick="setRRole('perus')">
                        <div class="rt-icon">🏢</div>
                        <div class="rt-label">Perusahaan</div>
                    </div>
                    <div class="rt" id="rtr-lpk" onclick="setRRole('lpk')">
                        <div class="rt-icon">🏫</div>
                        <div class="rt-label">LPK</div>
                    </div>
                </div>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" id="reg-role-input" value="pencari_kerja">
                    
                    <div class="f-group">
                        <label>Nama Lengkap / Instansi</label>
                        <input type="text" name="name" placeholder="Masukkan nama" required>
                    </div>

                    <div class="f-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" placeholder="email@domain.com" required>
                    </div>

                    <div class="f-group">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" id="r-pw" placeholder="Min. 8 karakter" required oninput="checkStrength(this.value)">
                        <div class="pw-strength">
                            <div class="pw-bar" id="pb1"></div>
                            <div class="pw-bar" id="pb2"></div>
                            <div class="pw-bar" id="pb3"></div>
                            <div class="pw-bar" id="pb4"></div>
                        </div>
                        <div class="pw-hint" id="pw-hint">Min. 8 karakter</div>
                    </div>

                    <div class="f-group">
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    </div>

                    <div class="check-row">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a></label>
                    </div>

                    <button type="submit" class="submit-btn">Buat Akun Sekarang →</button>
                </form>

                <p class="lform-foot">Sudah punya akun? <span class="f-link" onclick="showLV('main')">Masuk</span></p>
            </div>
            
        </div>
    </div>
</div>

<style>
/* CSS styles preserved from previous version but optimized for Pencari Kerja theme */
</style>

<script>
function setLRole(r) {
    document.getElementById('login-role-input').value = r;
    document.getElementById('google-login-btn').href = "{{ route('google.redirect', ['role' => ':role']) }}".replace(':role', r);
    ['pencari_kerja', 'perus', 'lpk'].forEach(x => {
        const el = document.getElementById('rt-' + x);
        if(el) el.classList.remove('on');
    });
    const activeEl = document.getElementById('rt-' + r);
    if(activeEl) activeEl.classList.add('on');
}

function setRRole(r) {
    document.getElementById('reg-role-input').value = r;
    ['pencari_kerja', 'perus', 'lpk'].forEach(x => {
        const el = document.getElementById('rtr-' + x);
        if(el) el.classList.remove('on');
    });
    const activeEl = document.getElementById('rtr-' + r);
    if(activeEl) activeEl.classList.add('on');
}
</script>
@endsection
