<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/auth/google/pilih-role', [GoogleAuthController::class, 'showRoleSelection'])->name('google.role-selection');
    Route::get('/auth/google/redirect/{role}', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard pages
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/cari-kerja', [DashboardController::class, 'cariKerja'])->name('dashboard.cari-kerja');
    Route::get('/dashboard/lms', [DashboardController::class, 'lms'])->name('dashboard.lms');
    Route::get('/dashboard/lamaran', [DashboardController::class, 'lamaran'])->name('dashboard.lamaran');
    Route::get('/dashboard/profil', [DashboardController::class, 'profil'])->name('dashboard.profil');
    Route::get('/dashboard/rekomendasi', [DashboardController::class, 'rekomendasi'])->name('dashboard.rekomendasi');
    Route::get('/dashboard/disimpan', [DashboardController::class, 'disimpan'])->name('dashboard.disimpan');
    Route::get('/dashboard/lpk', [DashboardController::class, 'lpk'])->name('dashboard.lpk');
    Route::get('/dashboard/perusahaan', [DashboardController::class, 'perusahaan'])->name('dashboard.perusahaan');

    // Job application flow
    Route::get('/dashboard/cari-kerja/{id}/lamar', [DashboardController::class, 'showLamar'])->name('dashboard.lamar.show');
    Route::post('/dashboard/cari-kerja/{id}/lamar', [DashboardController::class, 'submitLamar'])->name('dashboard.lamar.submit');
    Route::post('/dashboard/cari-kerja/{id}/simpan', [DashboardController::class, 'simpanJob'])->name('dashboard.job.simpan');

    // Perusahaan routes
    Route::get('/dashboard/perusahaan/lowongan', [\App\Http\Controllers\PerusahaanController::class, 'lowongan'])->name('perusahaan.lowongan');
    Route::post('/dashboard/perusahaan/lowongan', [\App\Http\Controllers\PerusahaanController::class, 'storeLowongan'])->name('perusahaan.store_lowongan');
    Route::get('/dashboard/perusahaan/kandidat', [\App\Http\Controllers\PerusahaanController::class, 'kandidat'])->name('perusahaan.kandidat');

    // Profile update
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update-modal', [ProfilController::class, 'update'])->name('profile.update.modal');
    Route::post('/profile/lengkap', [ProfilController::class, 'updateLengkap'])->name('profile.update.lengkap');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__ . '/auth.php';
