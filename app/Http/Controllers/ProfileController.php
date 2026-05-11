<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Mengambil objek user yang sedang login
        $user = Auth::user();

        // Mengirim data user ke view 'profil'
        return view('dashboard.profil', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'sekolah' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
        ]);

        // Update data
        $user->update([
            'name' => $request->name,
            'sekolah' => $request->sekolah,
            'jurusan' => $request->jurusan,
        ]);

        // Kembali ke halaman sebelumnya dengan notifikasi
        return back()->with('success', 'Profil kamu berhasil diperbarui!');
    }
}