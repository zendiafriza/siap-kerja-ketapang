// Main Application Controller
class App {
    constructor() {
        this.authStatus = null;
        this.init();
    }

    init() {
        this.updateAuthStatus();
        this.bindEvents();
        this.renderUI();
    }

    updateAuthStatus() {
        this.authStatus = authManager.getAuthStatus();
    }

    renderUI() {
        if (typeof uiManager !== 'undefined') {
            uiManager.updateProfileSidebar(this.authStatus);
            uiManager.updateMainBanner(this.authStatus);
            uiManager.updateTopbar(this.authStatus);

            if (this.authStatus.isGuest) {
                uiManager.disableApplyButtons();
            }
            uiManager.updateJobCardStates();
        }
    }

    bindEvents() {
        // Portal-specific events
        if (document.getElementById('sb-profile')) {
            this.bindPortalEvents();
        }

        // Login-specific events
        if (document.querySelector('.view')) {
            this.bindLoginEvents();
        }
        
        // Handle clicking outside user dropdown
        document.addEventListener('click', (e) => {
            const w = document.getElementById('user-wrap');
            if (w && !w.contains(e.target)) {
                const drop = document.getElementById('user-dropdown');
                if (drop) drop.classList.remove('open');
            }
        });
    }

    bindPortalEvents() {
        // Logout modal events
        const logoutBtn = document.querySelector('[onclick*="showLogoutModal"]');
        if (logoutBtn) {
            logoutBtn.onclick = () => this.showLogoutModal();
        }

        // Logout confirmation
        const confirmLogoutBtn = document.querySelector('.lm-btn.confirm');
        if (confirmLogoutBtn) {
            confirmLogoutBtn.onclick = () => this.logout();
        }

        // Cancel logout
        const cancelLogoutBtn = document.querySelector('.lm-btn.cancel');
        if (cancelLogoutBtn) {
            cancelLogoutBtn.onclick = () => this.hideLogoutModal();
        }
    }

    bindLoginEvents() {
        // Handled by inline events in login v2 for now, but keeping this wrapper
    }

    // Job Management State
    getApplications() {
        return JSON.parse(localStorage.getItem('user_applications') || '[]');
    }

    addApplication(jobId, company, title) {
        const apps = this.getApplications();
        if (!apps.find(a => a.id === jobId)) {
            apps.push({
                id: jobId,
                company: company,
                title: title,
                date: new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}),
                status: 'proses',
                matchScore: Math.floor(Math.random() * 20) + 70 // Simulate
            });
            localStorage.setItem('user_applications', JSON.stringify(apps));
        }
    }
    
    withdrawApplication(company) {
        const apps = this.getApplications();
        const newApps = apps.filter(a => a.company !== company);
        localStorage.setItem('user_applications', JSON.stringify(newApps));
        uiManager.showToast('Lamaran dari ' + company + ' berhasil ditarik');
        setTimeout(() => window.location.reload(), 1000);
    }

    getSavedJobs() {
        return JSON.parse(localStorage.getItem('user_saved_jobs') || '[]');
    }

    toggleSavedJob(jobId) {
        let saved = this.getSavedJobs();
        let isSaved = false;
        if (saved.includes(jobId)) {
            saved = saved.filter(id => id !== jobId);
        } else {
            saved.push(jobId);
            isSaved = true;
        }
        localStorage.setItem('user_saved_jobs', JSON.stringify(saved));
        return isSaved;
    }

    // Authentication handlers
    async handleLogin() {
        const email = document.getElementById('login-email')?.value;
        const password = document.getElementById('login-pw')?.value;
        if (!email || !password) {
            uiManager.showToast('Mohon isi email dan kata sandi'); 
            return;
        }
        const btn = document.querySelector('#view-role .submit-btn') || document.querySelector('.submit-btn');
        if (btn) { btn.textContent = 'Memverifikasi...'; btn.classList.add('loading'); }

        try {
            const result = await authManager.login(email, password);
            if (result.success) {
                uiManager.showToast('Login berhasil!');
                setTimeout(() => {
                    window.location.href = 'ketapang_portal_siswa.html';
                }, 1000);
            }
        } catch (error) {
            uiManager.showToast(error.message || 'Login gagal');
            if (btn) { btn.textContent = 'Masuk →'; btn.classList.remove('loading'); }
        }
    }

    async handleGuestLogin() {
        uiManager.showToast('Masuk sebagai tamu...');
        try {
            await authManager.enterGuestMode();
            setTimeout(() => {
                window.location.href = 'ketapang_portal_siswa.html';
            }, 800);
        } catch (error) {
            uiManager.showToast('Gagal masuk sebagai tamu');
        }
    }

    async logout() {
        try {
            await authManager.logout();
            this.hideLogoutModal();
            uiManager.showToast('Berhasil keluar...');
            setTimeout(() => {
                window.location.href = 'ketapang_login_v2.html';
            }, 1200);
        } catch (error) {
            uiManager.showToast('Gagal logout');
        }
    }

    async exitGuestMode() {
        try {
            await authManager.exitGuestMode();
            uiManager.showToast('Keluar dari mode tamu...');
            setTimeout(() => {
                window.location.reload();
            }, 800);
        } catch (error) {
            uiManager.showToast('Gagal keluar dari mode tamu');
        }
    }

    // Modal handlers
    showLogoutModal() {
        const drop = document.getElementById('user-dropdown');
        if (drop) drop.classList.remove('open');
        const modal = document.getElementById('logout-modal');
        if (modal) modal.classList.add('show');
    }

    hideLogoutModal() {
        const modal = document.getElementById('logout-modal');
        if (modal) modal.classList.remove('show');
    }
}

// Global utility functions for inline HTML event handlers
window.showToast = function(msg) {
    if (typeof uiManager !== 'undefined') uiManager.showToast(msg);
    else alert(msg);
};

window.toggleUserMenu = function() {
    const dropdown = document.getElementById('user-dropdown');
    if (dropdown) dropdown.classList.toggle('open');
};

window.hideLogoutModal = function() {
    if (window.app) window.app.hideLogoutModal();
};

window.showLogoutModal = function() {
    if (window.app) window.app.showLogoutModal();
};

window.doLogout = function() {
    if (window.app) window.app.logout();
};

window.exitGuestMode = function() {
    if (window.app) window.app.exitGuestMode();
};

// Portal and Lamaran specific global functions
window.applyJob = function(btn, company, title, id) {
    if (window.app.authStatus && window.app.authStatus.isGuest) {
        showToast('Daftar akun untuk dapat melamar pekerjaan');
        return;
    }
    const card = btn.closest('.job-card');
    btn.textContent = '✓ Terkirim!';
    btn.className = 'btn-sm btn-applied';
    btn.disabled = true;
    if (card) card.classList.add('applied');
    
    const jobId = id || 'job_' + Date.now();
    const jobTitle = title || (card ? card.querySelector('.job-title').textContent : 'Lowongan');
    window.app.addApplication(jobId, company, jobTitle);
    
    showToast('Lamaran ke ' + company + ' berhasil dikirim!');
};

window.saveJob = function(btn, id) {
    const jobId = id || btn.closest('.job-card')?.dataset?.id || 'job_' + Date.now();
    const isSaved = window.app.toggleSavedJob(jobId);
    
    btn.textContent = isSaved ? '✓ Tersimpan' : '🔖 Simpan';
    btn.style.background = isSaved ? 'var(--purple-lt)' : '';
    btn.style.color = isSaved ? 'var(--purple)' : '';
    
    showToast(isSaved ? 'Lowongan berhasil disimpan!' : 'Dihapus dari daftar simpan');
};

// Lamaran page UI logic
window.toggleDetail = function(id) {
    const card = document.getElementById(id);
    const det = document.getElementById('detail-' + id);
    const txt = document.getElementById('expand-txt-' + id);
    const arrow = document.getElementById('expand-arrow-' + id);
    if (!card || !det) return;
    
    const isOpen = card.classList.contains('expanded');
    card.classList.toggle('expanded');
    det.style.display = isOpen ? 'none' : 'block';
    if(txt) txt.textContent = isOpen ? 'Lihat detail' : 'Tutup detail';
    if(arrow) arrow.style.transform = isOpen ? '' : 'rotate(180deg)';
};

window.setChip = function(el, status) {
    document.querySelectorAll('.fc').forEach(c => c.classList.remove('on'));
    el.classList.add('on');
    window.filterStatus(status, null);
};

window.filterStatus = function(status, kpiEl) {
    if (kpiEl) {
        document.querySelectorAll('.kpi-box').forEach(b => b.classList.remove('on'));
        kpiEl.classList.add('on');
    }
    const cards = document.querySelectorAll('.lc');
    let visible = 0;
    cards.forEach(c => {
        const cs = c.dataset.status;
        const show = (status === 'semua') || cs === status;
        c.style.display = show ? 'block' : 'none';
        if (show) visible++;
    });
    const emptyState = document.getElementById('empty-state');
    if (emptyState) emptyState.style.display = visible === 0 ? 'block' : 'none';
};

window.confirmWithdraw = function(company) {
    if (confirm('Yakin ingin menarik lamaran dari ' + company + '? Tindakan ini tidak dapat dibatalkan.')) {
        window.app.withdrawApplication(company);
    }
};

window.openNote = function() {
    const modal = document.getElementById('note-modal');
    if (modal) modal.classList.add('show');
};

window.closeNote = function(e) {
    const modal = document.getElementById('note-modal');
    if (modal && (!e || e.target === modal)) modal.classList.remove('show');
};

window.saveNote = function() {
    window.closeNote();
    showToast('Catatan berhasil disimpan!');
};

// Initialize app when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.app = new App();
});

// Global error handler
window.addEventListener('error', (e) => {
    console.error('Application error:', e.error);
});

window.addEventListener('unhandledrejection', (e) => {
    console.error('Unhandled promise rejection:', e.reason);
});