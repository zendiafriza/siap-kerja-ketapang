let currentRole = 'siswa';
function showToast(m) { const t = document.getElementById('toast'); document.getElementById('toast-msg').textContent = m; t.classList.add('show'); setTimeout(() => t.classList.remove('show'), 3000) }
function showView(name) { document.querySelectorAll('.view').forEach(v => v.classList.remove('active')); document.getElementById('view-' + name).classList.add('active') }
// Function to toggle password visibility
function togglePw(id, btn) { const i = document.getElementById(id); i.type = i.type === 'password' ? 'text' : 'password'; btn.style.opacity = i.type === 'text' ? '1' : '.5' }
function checkStrength(pw) {
  const bars = [1, 2, 3, 4].map(i => document.getElementById('pb' + i)); const hint = document.getElementById('pw-hint');
  bars.forEach(b => { b.className = 'pw-bar' });
  let s = 0; if (pw.length >= 8) s++; if (/[A-Z]/.test(pw)) s++; if (/[0-9]/.test(pw)) s++; if (/[^A-Za-z0-9]/.test(pw)) s++;
  const c = s <= 1 ? 'w' : s <= 2 ? 'm' : 's';
  for (let i = 0; i < s; i++)bars[i].classList.add(c);
  hint.textContent = ['', 'Sandi lemah', 'Cukup kuat', 'Kuat', 'Sangat kuat'][s] || 'Min. 8 karakter';
  hint.style.color = s <= 1 ? 'var(--coral)' : s <= 2 ? 'var(--amber)' : 'var(--teal)';
}
function setRole(r) {
  currentRole = r;
  ['siswa', 'perusahaan', 'lpk'].forEach(x => document.getElementById('rt-' + x).classList.remove('on'));
  document.getElementById('login-role-input').value = r; // Update hidden role input for login
  document.getElementById('rt-' + r).classList.add('on');
}
function setRegRole(r) {
  ['siswa', 'perusahaan', 'lpk'].forEach(x => {
    document.getElementById('rtr-' + x).classList.remove('on');
    const f = document.getElementById('reg-' + x + '-fields');
    if (f) f.style.display = 'none';
  });
  document.getElementById('rtr-' + r).classList.add('on');
  document.getElementById('register-role-input').value = r; // Update hidden role input for registration
  const tf = document.getElementById('reg-' + r + '-fields');
  if (tf) tf.style.display = 'block';
}
function selectRole(r) {
  // This function is called from the left panel's role showcase.
  // It should probably lead to the login/register view with the role pre-selected.
  if (r === 'lms') { window.location.href = '{{ route("lms") }}'; return; }
  showView('role'); // Show the main login view
  setRole(r); // Pre-select the role for login
  if (r === 'perusahaan') { // If it's a company, maybe suggest registration or direct to login
    // For now, just pre-select role on login view.
    // A more complex flow might involve showing register directly or a specific company login page.
  }
}
// The googleLogin and googleGo functions are for client-side simulation.
// With backend integration, the 'Lanjutkan dengan Google' button will directly link to the socialite route.
// The backend will handle the callback and redirection.
// Therefore, these client-side simulation functions are removed/replaced.

// Function to handle form submission for login
document.getElementById('login-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission
  const btn = document.getElementById('login-submit-btn');
  btn.textContent = 'Memverifikasi...';
  btn.classList.add('loading');
  this.submit(); // Submit the form
});

// Function to handle form submission for registration
document.getElementById('register-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission
  const btn = document.getElementById('register-submit-btn');
  btn.textContent = 'Membuat akun...';
  btn.classList.add('loading');
  this.submit(); // Submit the form
});

function enterAsGuest() {
  showToast('Masuk sebagai tamu...');
  setTimeout(() => {
    // Set guest mode - user can browse but cannot apply
    localStorage.setItem('user_guest', 'true');
    localStorage.removeItem('user_logged_in');
    localStorage.removeItem('user_profile');
    window.location.href = '{{ route("portal.siswa") }}';
  }, 800);
}

// ── ONBOARDING ──
let obAv = '🌿';
function pickAv(el) { document.querySelectorAll('.av-opt').forEach(a => a.classList.remove('on')); el.classList.add('on'); obAv = el.textContent }
function obNext(step) {
  if (step === 1) {
    const f = document.getElementById('ob-fname').value.trim();
    const l = document.getElementById('ob-lname').value.trim();
    const d = document.getElementById('ob-dob').value;
    const g = document.getElementById('ob-gender').value;
    const h = document.getElementById('ob-hp').value.trim();
    if (!f || !l || !d || !g || !h) { showToast('Mohon isi semua field wajib (*)'); return }
    document.getElementById('ob-s1').style.display = 'none';
    document.getElementById('ob-s2').style.display = 'block';
    document.getElementById('ob-dot-1').className = 'ob-dot done'; document.getElementById('ob-dot-1').textContent = '✓';
    document.getElementById('ob-line-1').className = 'ob-line done';
    document.getElementById('ob-dot-2').className = 'ob-dot active';
  } else if (step === 2) {
    const s = document.getElementById('ob-school').value;
    const m = document.getElementById('ob-major').value;
    const g = document.getElementById('ob-grade').value;
    if (!s || !m || !g) { showToast('Mohon isi semua field wajib (*)'); return }
    document.getElementById('ob-s2').style.display = 'none';
    document.getElementById('ob-s3').style.display = 'block';
    document.getElementById('ob-dot-2').className = 'ob-dot done'; document.getElementById('ob-dot-2').textContent = '✓';
    document.getElementById('ob-line-2').className = 'ob-line done';
    document.getElementById('ob-dot-3').className = 'ob-dot active';
  }
}
function obBack(step) {
  if (step === 2) {
    document.getElementById('ob-s2').style.display = 'none';
    document.getElementById('ob-s1').style.display = 'block';
    document.getElementById('ob-dot-2').className = 'ob-dot todo'; document.getElementById('ob-dot-2').textContent = '2';
    document.getElementById('ob-line-1').className = 'ob-line';
    document.getElementById('ob-dot-1').className = 'ob-dot active'; document.getElementById('ob-dot-1').textContent = '1';
  } else if (step === 3) {
    document.getElementById('ob-s3').style.display = 'none';
    document.getElementById('ob-s2').style.display = 'block';
    document.getElementById('ob-dot-3').className = 'ob-dot todo'; document.getElementById('ob-dot-3').textContent = '3';
    document.getElementById('ob-line-2').className = 'ob-line';
    document.getElementById('ob-dot-2').className = 'ob-dot active'; document.getElementById('ob-dot-2').textContent = '2';
  }
}
function obFinish() {
  const k = document.getElementById('ob-kec').value;
  const a = document.getElementById('ob-avail').value;
  if (!k || !a) { showToast('Mohon isi kecamatan dan status ketersediaan'); return }
  const btn = document.getElementById('ob-finish-btn');
  btn.textContent = 'Menyimpan...'; btn.classList.add('loading');
  setTimeout(() => {
    btn.classList.remove('loading'); btn.textContent = 'Simpan & Masuk →';
    // Save login status and user profile from onboarding
    const fname = document.getElementById('ob-fname').value.trim();
    const lname = document.getElementById('ob-lname').value.trim();
    const school = document.getElementById('ob-school').value;
    const major = document.getElementById('ob-major').value;
    const grade = document.getElementById('ob-grade').value;

    localStorage.setItem('user_logged_in', 'true');
    localStorage.setItem('user_profile', JSON.stringify({
      name: fname + ' ' + lname,
      school: major + ' · ' + grade + ' · ' + school,
      matchScore: 75, // Default score for new users
      tags: ['Belum Lengkap'] // Default tags
    }));
    window.location.href = '{{ route("portal.siswa") }}';
  }, 1600);
}