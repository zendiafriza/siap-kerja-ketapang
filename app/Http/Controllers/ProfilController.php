<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'sekolah' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'sekolah' => $request->sekolah,
            'jurusan' => $request->jurusan,
        ]);


        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateLengkap(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            // 1. Data Pribadi (Wajib)
            'nama_lengkap' => 'required|string|max:255',
            'email_profesional' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'domisili' => 'required|string|max:255',
            'linkedin' => 'nullable|url',

            // 2. Profil Profesional
            'headline' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'gaji' => 'nullable|string|max:255',

            // 3. Pengalaman Kerja (Arrays)
            'pengalaman_perusahaan' => 'nullable|array',
            'pengalaman_posisi' => 'nullable|array',
            'pengalaman_durasi' => 'nullable|array',
            'pengalaman_deskripsi' => 'nullable|array',

            // 4. Riwayat Pendidikan (Arrays)
            'pendidikan_institusi' => 'nullable|array',
            'pendidikan_jurusan' => 'nullable|array',
            'pendidikan_lulus' => 'nullable|array',
            'pendidikan_ipk' => 'nullable|array',

            // 5. Keahlian
            'hard_skills' => 'nullable|string',
            'soft_skills' => 'nullable|string',
            'bahasa' => 'nullable|string',

            // 6. Sertifikasi
            'sertifikat' => 'nullable|string',
            'portofolio' => 'nullable|url',

            // 7. Dokumen
            'resume' => 'nullable|file|mimes:pdf|max:2048',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi!',
            'email_profesional.required' => 'Email wajib diisi!',
            'no_hp.required' => 'Nomor HP/WA wajib diisi!',
            'domisili.required' => 'Domisili wajib diisi!',
            'resume.mimes' => 'Resume harus dalam format PDF!',
            'foto.image' => 'Foto harus berupa gambar (JPG/PNG)!',
        ]);

        // Process dynamic arrays
        $pengalaman = [];
        if ($request->has('pengalaman_perusahaan')) {
            foreach ($request->pengalaman_perusahaan as $i => $comp) {
                if ($comp) {
                    $pengalaman[] = [
                        'perusahaan' => $comp,
                        'posisi' => $request->pengalaman_posisi[$i] ?? '',
                        'durasi' => $request->pengalaman_durasi[$i] ?? '',
                        'deskripsi' => $request->pengalaman_deskripsi[$i] ?? '',
                    ];
                }
            }
        }

        $pendidikan = [];
        if ($request->has('pendidikan_institusi')) {
            foreach ($request->pendidikan_institusi as $i => $inst) {
                if ($inst) {
                    $pendidikan[] = [
                        'institusi' => $inst,
                        'jurusan' => $request->pendidikan_jurusan[$i] ?? '',
                        'lulus' => $request->pendidikan_lulus[$i] ?? '',
                        'ipk' => $request->pendidikan_ipk[$i] ?? '',
                    ];
                }
            }
        }

        // Handle File Uploads
        $existingMeta = $user->profile_metadata ?? [];
        $resumePath = $existingMeta['resume_path'] ?? null;
        $fotoPath = $existingMeta['foto_path'] ?? null;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('photos', 'public');
        }

        // Hitung Match Score
        $score = 0;
        if ($request->nama_lengkap && $request->email_profesional && $request->no_hp && $request->domisili) {
            $score += 20;
        }
        if ($request->headline || $request->summary) {
            $score += 15;
        }
        if (! empty($pengalaman)) {
            $score += 25;
        }
        if (! empty($pendidikan)) {
            $score += 20;
        }
        if ($request->hard_skills || $request->soft_skills) {
            $score += 10;
        }
        if ($request->sertifikat || $request->portofolio) {
            $score += 10;
        }

        $metadata = array_merge($existingMeta, [
            'nama_lengkap' => $request->nama_lengkap,
            'email_profesional' => $request->email_profesional,
            'no_hp' => $request->no_hp,
            'domisili' => $request->domisili,
            'linkedin' => $request->linkedin,
            'headline' => $request->headline,
            'summary' => $request->summary,
            'gaji' => $request->gaji,
            'pengalaman' => $pengalaman,
            'pendidikan' => $pendidikan,
            'hard_skills' => $request->hard_skills,
            'soft_skills' => $request->soft_skills,
            'bahasa' => $request->bahasa,
            'sertifikat' => $request->sertifikat,
            'portofolio' => $request->portofolio,
            'resume_path' => $resumePath,
            'foto_path' => $fotoPath,
            'match_score' => $score,
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
            'profile_metadata' => $metadata,
            'match_score' => $score, // Sync with top-level column
        ]);


        return back()->with('success', 'Profil lengkap berhasil disimpan! Match Score Anda telah diperbarui.');
    }
}
