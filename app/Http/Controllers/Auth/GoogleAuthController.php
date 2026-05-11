<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function showRoleSelection()
    {
        return view('auth.google-role');
    }

    public function redirect($role)
    {
        $allowedRoles = ['PENCARI_KERJA', 'PERUSAHAAN', 'LPK'];

        $role = strtoupper($role);

        if (! in_array($role, $allowedRoles)) {
            return redirect()->route('login')->with('error', 'Peran tidak valid!');
        }

        // Simpan role pilihan di session agar tidak hilang saat di Google
        Session::put('auth_role', $role);

        // Bypass Google Login untuk testing lokal jika kredensial belum diset
        if (empty(env('GOOGLE_CLIENT_ID')) && app()->environment('local')) {
            return redirect('/auth/google/callback');
        }

        // Paksa Google memunculkan halaman "Pilih Akun" (Select Account)
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function callback()
    {
        try {
            $selectedRole = Session::get('auth_role');

            if (! $selectedRole) {
                return redirect('/login')->with('error', 'Sesi kedaluwarsa. Silakan pilih peran kembali.');
            }

            if (empty(env('GOOGLE_CLIENT_ID')) && app()->environment('local')) {
                // Mock Google User untuk testing lokal
                $googleUser = new \stdClass;
                $googleUser->id = '1234567890_test';
                $googleUser->name = 'Pengguna Google (Demo)';
                $googleUser->email = 'demo_google@example.com';
            } else {
                $googleUser = Socialite::driver('google')->user();
            }

            $user = User::where('gauth_id', $googleUser->id)->first();

            if ($user) {
                if (strtolower($user->role) !== strtolower($selectedRole)) {
                    return redirect('/login')->with('error', "Gagal! Akun Google ini sudah terdaftar sebagai {$user->role}.");
                }
                Auth::login($user);

                return redirect()->route('dashboard.index');
            }

            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                if (strtolower($existingUser->role) !== strtolower($selectedRole)) {
                    return redirect('/login')->with('error', "Gagal! Email ini sudah terdaftar sebagai {$existingUser->role}.");
                }

                $existingUser->update([
                    'gauth_id' => $googleUser->id,
                    'gauth_type' => 'google',
                ]);

                Auth::login($existingUser);

                return redirect()->route('dashboard.index');
            }

            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'gauth_id' => $googleUser->id,
                'gauth_type' => 'google',
                'role' => $selectedRole,
                'password' => bcrypt(Str::random(24)),
                'match_score' => 0,
                'xp' => 0,
            ]);

            Auth::login($newUser);

            return redirect()
                ->route('dashboard.index')
                ->with('success', "Akun $selectedRole berhasil dibuat!");
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat masuk dengan Google.');
        }
    }
}
