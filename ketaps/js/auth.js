// Authentication Management Module
class AuthManager {
    constructor() {
        this.storageKeys = {
            loggedIn: 'user_logged_in',
            profile: 'user_profile',
            guest: 'user_guest',
            google: 'user_google_login'
        };
    }

    // Check authentication status
    getAuthStatus() {
        const isLoggedIn = localStorage.getItem(this.storageKeys.loggedIn) === 'true';
        const isGuest = localStorage.getItem(this.storageKeys.guest) === 'true';
        const isGoogle = localStorage.getItem(this.storageKeys.google) === 'true';

        return {
            isLoggedIn,
            isGuest,
            isGoogle,
            userProfile: this.getUserProfile()
        };
    }

    // Get user profile
    getUserProfile() {
        try {
            return JSON.parse(localStorage.getItem(this.storageKeys.profile) || '{}');
        } catch (e) {
            console.error('Error parsing user profile:', e);
            return {};
        }
    }

    // Set user profile
    setUserProfile(profile) {
        localStorage.setItem(this.storageKeys.profile, JSON.stringify(profile));
    }

    // Login with regular credentials
    login(email, password) {
        // Simulate API call
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (email && password) {
                    const profile = {
                        name: 'Aldi Ramadan',
                        email: email,
                        school: 'SMK ATP · Kelas XII · SMKN 1 Ketapang',
                        matchScore: 88,
                        tags: ['Agribisnis', 'RSPO', 'Sawit']
                    };

                    this.setUserProfile(profile);
                    localStorage.setItem(this.storageKeys.loggedIn, 'true');
                    localStorage.removeItem(this.storageKeys.guest);

                    resolve({ success: true, profile });
                } else {
                    reject({ success: false, message: 'Email dan password diperlukan' });
                }
            }, 1000);
        });
    }

    // Login with Google
    loginWithGoogle() {
        return new Promise((resolve) => {
            setTimeout(() => {
                const profile = {
                    name: 'User Google',
                    email: 'user@gmail.com',
                    school: 'Belum diisi · Lengkapi profil Anda',
                    matchScore: 0,
                    tags: ['Belum Lengkap']
                };

                this.setUserProfile(profile);
                localStorage.setItem(this.storageKeys.loggedIn, 'true');
                localStorage.setItem(this.storageKeys.google, 'true');
                localStorage.removeItem(this.storageKeys.guest);

                resolve({ success: true, profile });
            }, 1200);
        });
    }

    // Enter guest mode
    enterGuestMode() {
        return new Promise((resolve) => {
            setTimeout(() => {
                localStorage.setItem(this.storageKeys.guest, 'true');
                localStorage.removeItem(this.storageKeys.loggedIn);
                localStorage.removeItem(this.storageKeys.google);
                localStorage.removeItem(this.storageKeys.profile);

                resolve({ success: true });
            }, 800);
        });
    }

    // Register new user
    register(userData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (!userData.terms) {
                    reject({ success: false, message: 'Harap setujui syarat & ketentuan' });
                    return;
                }

                const profile = {
                    name: `${userData.firstName} ${userData.lastName}`,
                    email: userData.email,
                    school: `${userData.major} · ${userData.grade} · ${userData.school}`,
                    matchScore: 75,
                    tags: ['Belum Lengkap']
                };

                this.setUserProfile(profile);
                localStorage.setItem(this.storageKeys.loggedIn, 'true');
                localStorage.removeItem(this.storageKeys.guest);

                resolve({ success: true, profile });
            }, 1500);
        });
    }

    // Logout
    logout() {
        Object.values(this.storageKeys).forEach(key => {
            localStorage.removeItem(key);
        });
        return Promise.resolve({ success: true });
    }

    // Exit guest mode
    exitGuestMode() {
        localStorage.removeItem(this.storageKeys.guest);
        return Promise.resolve({ success: true });
    }
}

// Create global instance
const authManager = new AuthManager();