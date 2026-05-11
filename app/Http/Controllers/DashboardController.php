<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;

class DashboardController extends Controller
{
    // Halaman Cari Kerja (Index)
    public function index(Request $request)
    {
        $user = Auth::user();

        if (strtolower($user->role) === 'perusahaan') {
            return redirect()->route('dashboard.perusahaan');
        }

        if (strtolower($user->role) === 'lpk') {
            return redirect()->route('dashboard.lpk');
        }

        $query = Job::query();

        // Filter Pencarian
        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('company', 'like', '%' . $request->q . '%');
        }

        // Filter Tipe
        if ($request->has('type') && $request->type != 'semua') {
            $query->where('type', $request->type);
        }

        // Filter Lokasi
        if ($request->has('location') && $request->location != 'semua') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $query->latest()->get();

        return view('dashboard.cari-kerja', [
            'user'        => $user,
            'active_page' => 'kerja',
            'jobs'        => $jobs,
        ]);
    }

    // Halaman LMS Belajar
    public function lms()
    {
        $user = Auth::user();
        return view('dashboard.lms_belajar', [
            'user'        => $user,
            'active_page' => 'lms',
        ]);
    }

    // Halaman Status Lamaran
    public function lamaran()
    {
        $user = Auth::user();
        $applications = JobApplication::with('job')->where('user_id', $user->id)->latest()->get();
        return view('dashboard.lamaranku', [
            'user'        => $user,
            'active_page' => 'lamaran',
            'applications' => $applications
        ]);
    }

    // Halaman Profil
    public function profil()
    {
        $user = Auth::user();
        return view('dashboard.profil', [
            'user'        => $user,
            'active_page' => 'profil',
        ]);
    }

    // Halaman Cari Kerja (alias)
    public function cariKerja(Request $request)
    {
        return $this->index($request);
    }

    // Tampilkan Halaman Melamar
    public function showLamar($id)
    {
        $job = Job::find($id);
        
        // Mock data if job not found in DB
        if (!$job) {
            $job = (object)[
                'id' => $id,
                'title' => 'Operator Kebun & Pemantau Lingkungan',
                'company' => 'Cargill Ketapang Mill',
                'location' => 'Muara Pawan',
                'type' => 'Magang',
                'salary_range' => 'Rp 3.500.000 - Rp 4.500.000'
            ];
        }

        return view('dashboard.lamar-kerja', [
            'user' => Auth::user(),
            'job' => $job,
            'active_page' => 'kerja'
        ]);
    }

    // Submit Lamaran
    public function submitLamar(Request $request, $id)
    {
        $user = Auth::user();
        
        $request->validate([
            'cover_letter' => 'required|string'
        ]);

        JobApplication::create([
            'user_id' => $user->id,
            'job_id' => $id,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard.lamaran')->with('success', 'Lamaran Anda berhasil terkirim! Tim HRD akan segera meninjau profil Anda.');
    }

    // Simpan Lowongan
    public function simpanJob($id)
    {
        $user = Auth::user();
        
        $exists = SavedJob::where('user_id', $user->id)->where('job_id', $id)->first();
        
        if (!$exists) {
            SavedJob::create([
                'user_id' => $user->id,
                'job_id' => $id
            ]);
            return back()->with('success', 'Lowongan berhasil disimpan ke daftar favorit Anda.');
        }

        return back()->with('info', 'Lowongan sudah ada di daftar simpan Anda.');
    }

    // Halaman Rekomendasi AI
    public function rekomendasi()
    {
        $user = Auth::user();
        $jobs = Job::where('match_score', '>=', 80)->latest()->get();
        return view('dashboard.rekomendasi', [
            'user'        => $user,
            'active_page' => 'rekomendasi',
            'jobs'        => $jobs
        ]);
    }

    // Halaman Lowongan Disimpan
    public function disimpan()
    {
        $user = Auth::user();
        $savedJobs = SavedJob::with('job')->where('user_id', $user->id)->latest()->get();
        return view('dashboard.disimpan', [
            'user'        => $user,
            'active_page' => 'disimpan',
            'savedJobs'   => $savedJobs
        ]);
    }

    // Halaman LPK & Pelatihan
    public function lpk()
    {
        $user = Auth::user();
        return view('dashboard.lpk', [
            'user'        => $user,
            'active_page' => 'lpk',
        ]);
    }

    // Halaman Portal Perusahaan
    public function perusahaan()
    {
        $user = Auth::user();
        $jobIds = Job::where('user_id', $user->id)->pluck('id');
        $applications = JobApplication::with(['job', 'user'])->whereIn('job_id', $jobIds)->latest()->get();
        
        return view('dashboard.perusahaan', [
            'user'        => $user,
            'active_page' => 'perusahaan',
            'applications' => $applications,
            'total_applicants' => JobApplication::whereIn('job_id', $jobIds)->count(),
            'total_hired' => JobApplication::whereIn('job_id', $jobIds)->where('status', 'accepted')->count(),
        ]);
    }
}