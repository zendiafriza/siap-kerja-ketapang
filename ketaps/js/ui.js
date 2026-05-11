// UI Management Module
class UIManager {
    constructor() {
        this.toastQueue = [];
        this.isToastShowing = false;
    }

    // Show toast notification
    showToast(message, duration = 3000) {
        this.toastQueue.push({ message, duration });

        if (!this.isToastShowing) {
            this.processToastQueue();
        }
    }

    processToastQueue() {
        if (this.toastQueue.length === 0) {
            this.isToastShowing = false;
            return;
        }

        this.isToastShowing = true;
        const { message, duration } = this.toastQueue.shift();

        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-msg');

        if (toast && toastMsg) {
            toastMsg.textContent = message;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => this.processToastQueue(), 300);
            }, duration);
        } else {
            console.warn('Toast elements not found');
            this.isToastShowing = false;
        }
    }

    // Update profile sidebar
    updateProfileSidebar(authStatus) {
        const profileContainer = document.getElementById('sb-profile');

        if (!profileContainer) return;

        if (authStatus.isGuest) {
            profileContainer.innerHTML = this.renderGuestProfile();
        } else if (authStatus.isLoggedIn && authStatus.userProfile.name) {
            profileContainer.innerHTML = this.renderUserProfile(authStatus.userProfile);
        } else {
            profileContainer.innerHTML = this.renderRegistrationPrompt();
        }
    }

    // Update main banner
    updateMainBanner(authStatus) {
        const bannerContainer = document.getElementById('main-banner');

        if (!bannerContainer) return;

        if (authStatus.isGuest) {
            bannerContainer.innerHTML = this.renderGuestBanner();
        } else if (authStatus.isLoggedIn) {
            bannerContainer.innerHTML = this.renderUserBanner(authStatus.userProfile);
        } else {
            bannerContainer.innerHTML = this.renderDefaultBanner();
        }
    }

    // Update topbar
    updateTopbar(authStatus) {
        const userPill = document.querySelector('.user-pill');
        const topbarRight = document.querySelector('.topbar-right');

        if (authStatus.isLoggedIn && authStatus.userProfile.name) {
            // Show user pill for logged in users
            if (userPill) userPill.style.display = 'flex';
            if (topbarRight) {
                const avatarInitials = authStatus.userProfile.name
                    .split(' ')
                    .map(n => n[0])
                    .join('')
                    .toUpperCase();

                const userAvatar = topbarRight.querySelector('.user-avatar');
                const userName = topbarRight.querySelector('.user-name');

                if (userAvatar) userAvatar.textContent = avatarInitials;
                if (userName) {
                    userName.textContent = authStatus.userProfile.name.split(' ')[0] +
                        ' ' + authStatus.userProfile.name.split(' ')[1][0] + '.';
                }
            }
        } else {
            // Hide user pill and show login/register links
            if (userPill) userPill.style.display = 'none';
            if (topbarRight) {
                topbarRight.innerHTML = `
                    <a href="ketapang_login_v2.html" style="padding:7px 11px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:8px;font-family:'Sora',sans-serif;font-size:11px;font-weight:600;color:rgba(255,255,255,.75);text-decoration:none;transition:.15s" onmouseover="this.style.background='rgba(255,255,255,.14)'" onmouseout="this.style.background='rgba(255,255,255,.07)'">Masuk</a>
                    <a href="ketapang_login_v2.html" style="padding:7px 11px;background:var(--teal);border:1px solid var(--teal);border-radius:8px;font-family:'Sora',sans-serif;font-size:11px;font-weight:600;color:#fff;text-decoration:none;transition:.15s" onmouseover="this.style.background='var(--teal2)'" onmouseout="this.style.background='var(--teal)'">Daftar</a>
                `;
            }
        }
    }

    // Disable apply buttons for guests
    disableApplyButtons() {
        const applyButtons = document.querySelectorAll('.btn-teal, .btn-sm.btn-teal');
        applyButtons.forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault();
                this.showToast('Daftar akun untuk dapat melamar pekerjaan');
                return false;
            };
            btn.style.opacity = '0.6';
            btn.style.cursor = 'not-allowed';
        });
    }

    // Sync job card UI with saved/applied state from localStorage
    updateJobCardStates() {
        if (!window.app) return;
        
        const appliedJobs = window.app.getApplications().map(a => a.id);
        const savedJobs = window.app.getSavedJobs();
        
        document.querySelectorAll('.job-card').forEach(card => {
            const jobId = card.dataset.id;
            if (!jobId) return;
            
            // Check applied state
            if (appliedJobs.includes(jobId)) {
                card.classList.add('applied');
                const applyBtn = card.querySelector('.btn-teal');
                if (applyBtn) {
                    applyBtn.textContent = '✓ Terkirim!';
                    applyBtn.className = 'btn-sm btn-applied';
                    applyBtn.disabled = true;
                    applyBtn.onclick = null;
                }
            }
            
            // Check saved state
            if (savedJobs.includes(jobId)) {
                const saveBtn = card.querySelector('.btn-outline');
                if (saveBtn && saveBtn.textContent.includes('Simpan')) {
                    saveBtn.textContent = '✓ Tersimpan';
                    saveBtn.style.background = 'var(--purple-lt)';
                    saveBtn.style.color = 'var(--purple)';
                }
            }
        });
    }

    // Render methods
    renderGuestProfile() {
        return `
            <div style="text-align: center; padding: 20px;">
                <div style="font-size: 48px; margin-bottom: 16px;">👤</div>
                <div style="font-size: 16px; font-weight: 600; color: var(--navy); margin-bottom: 8px;">Mode Tamu</div>
                <div style="font-size: 12px; color: var(--muted); margin-bottom: 20px; line-height: 1.5;">
                    Anda sedang browsing sebagai tamu. Daftar untuk mengakses fitur lengkap termasuk melamar pekerjaan.
                </div>
                <div style="display: flex; gap: 8px; justify-content: center; margin-bottom: 12px;">
                    <a href="ketapang_login_v2.html" style="display: inline-block; padding: 8px 16px; background: var(--teal); color: white; text-decoration: none; border-radius: 6px; font-size: 11px; font-weight: 600; transition: background 0.15s;">
                        Daftar Sekarang
                    </a>
                </div>
                <button onclick="window.exitGuestMode()" style="background: none; border: none; color: var(--muted); font-size: 11px; cursor: pointer; text-decoration: underline;">Keluar dari mode tamu</button>
            </div>
        `;
    }

    renderUserProfile(profile) {
        const avatarInitials = profile.name
            .split(' ')
            .map(n => n[0])
            .join('')
            .toUpperCase();

        const matchScore = profile.matchScore || 0;
        const tags = profile.tags || [];

        return `
            <div class="sb-avatar">${avatarInitials}</div>
            <div class="sb-name">${profile.name || 'Nama Pengguna'}</div>
            <div class="sb-school">${profile.school || 'Sekolah belum diisi'}</div>
            <div class="sb-score-wrap">
                <div class="sb-score-val">${matchScore}</div>
                <div class="sb-score-lbl">Match Score keseluruhanmu</div>
                <div class="progress-bar">
                    <div class="pb-fill" style="width:${matchScore}%"></div>
                </div>
            </div>
            <div class="sb-tags">
                ${tags.map(tag => {
                    const colors = {
                        'Agribisnis': 'var(--teal-lt), var(--teal)',
                        'RSPO': 'var(--amber-lt), var(--amber)',
                        'Sawit': 'var(--sky-lt), var(--sky)',
                        'Kesehatan': 'var(--coral-lt), var(--coral)',
                        'TIK': 'var(--purple-lt), var(--purple)',
                        'Belum Lengkap': 'var(--line), var(--muted)'
                    };
                    const [bg, color] = (colors[tag] || 'var(--teal-lt), var(--teal)').split(', ');
                    return `<span class="sb-tag" style="background:${bg};color:${color}">${tag}</span>`;
                }).join('')}
            </div>
        `;
    }

    renderRegistrationPrompt() {
        return `
            <div style="text-align: center; padding: 20px;">
                <div style="font-size: 48px; margin-bottom: 16px;">👤</div>
                <div style="font-size: 16px; font-weight: 600; color: var(--navy); margin-bottom: 8px;">Belum Terdaftar?</div>
                <div style="font-size: 12px; color: var(--muted); margin-bottom: 20px; line-height: 1.5;">
                    Daftar sekarang untuk melihat profilmu dan mendapatkan rekomendasi lowongan yang sesuai
                </div>
                <a href="ketapang_login_v2.html" style="display: inline-block; padding: 10px 20px; background: var(--teal); color: white; text-decoration: none; border-radius: 8px; font-size: 12px; font-weight: 600; transition: background 0.15s;">
                    Daftar Sekarang →
                </a>
            </div>
        `;
    }

    renderGuestBanner() {
        return `
            <div class="banner-emoji">🔍</div>
            <div class="banner-content">
                <div class="banner-title">Jelajahi Lowongan Kerja di Ketapang</div>
                <div class="banner-sub">Daftar akun untuk dapat melamar pekerjaan dan mendapatkan rekomendasi personal</div>
            </div>
            <a href="ketapang_login_v2.html" class="banner-btn">Daftar & Lamar →</a>
        `;
    }

    renderUserBanner(profile) {
        const profileCompletion = profile.tags && profile.tags.includes('Belum Lengkap') ? 25 : 78;
        return `
            <div class="banner-emoji">🎯</div>
            <div class="banner-content">
                <div class="banner-title">Profil ${profileCompletion}% lengkap — Tambahkan CV untuk skor lebih tinggi</div>
                <div class="banner-sub">Profil lengkap meningkatkan peluang dilihat pemberi kerja hingga 3×</div>
            </div>
            <button class="banner-btn" onclick="uiManager.showToast('Fitur upload CV segera hadir!')">Lengkapi Profil →</button>
        `;
    }

    renderDefaultBanner() {
        return `
            <div class="banner-emoji">🚀</div>
            <div class="banner-content">
                <div class="banner-title">Bergabunglah dengan Siap Lulus Ketapang</div>
                <div class="banner-sub">Daftar gratis untuk mendapatkan akses ke ribuan lowongan kerja yang sesuai dengan profilmu</div>
            </div>
            <a href="ketapang_login_v2.html" class="banner-btn">Daftar Sekarang →</a>
        `;
    }
}

// Create global instance
const uiManager = new UIManager();