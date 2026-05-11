<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        $user = Auth::user();

        return view('auth.login', compact('user'));
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:pencari_kerja,perusahaan,lpk', // Role dari tombol toggle manual
        ]);

        $requestedRole = strtoupper($request->role);
        $user = User::where('email', $request->email)->first();

        // VALIDASI UTAMA: Cek apakah role di database sama dengan yang dipilih
        if ($user && strtolower($user->role) !== strtolower($requestedRole)) {
            return back()->with('error', "Akses Ditolak! Akun ini terdaftar sebagai {$user->role}, bukan {$requestedRole}.");
        }

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
