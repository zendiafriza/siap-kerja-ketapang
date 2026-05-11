<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user && strtolower($user->role) === 'perusahaan') {
            return redirect()->route('dashboard.perusahaan');
        }

        if ($user && strtolower($user->role) === 'lpk') {
            return redirect()->route('dashboard.lpk');
        }

        $query = Job::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%'.$request->q.'%')
                ->orWhere('company', 'like', '%'.$request->q.'%');
        }

        if ($request->has('type') && $request->type != 'semua') {
            $query->where('type', $request->type);
        }

        if ($request->has('location') && $request->location != 'semua') {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        $jobs = $query->latest()->get();

        return view('dashboard.cari-kerja', [
            'user' => $user,
            'active_page' => 'kerja',
            'jobs' => $jobs,
        ]);
    }

    public function lamaran()
    {
        $user = Auth::user();
        $applications = JobApplication::with('job')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard.lamaranku', [
            'user' => $user,
            'active_page' => 'lamaran',
            'applications' => $applications,
        ]);
    }

    public function profil()
    {
        $user = Auth::user();

        return view('dashboard.profil', [
            'user' => $user,
            'active_page' => 'profil',
        ]);
    }

    public function cariKerja(Request $request)
    {
        return $this->index($request);
    }

    public function showLamar($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        // STRICT SCORE CHECK (Minimum 40% unless Magang)
        if (($user->match_score ?? 0) < 40 && strtolower($job->type) !== 'magang') {
            return redirect()->route('dashboard.index')->with('error', 'Match Score Profil Anda di bawah 40%. Silakan lengkapi profil Anda terlebih dahulu untuk melamar pekerjaan ini. (Kecuali untuk program Magang)');
        }

        return view('dashboard.lamar-kerja', [
            'user' => $user,
            'job' => $job,
            'active_page' => 'kerja',
        ]);
    }

    public function submitLamar(Request $request, $id)
    {
        $user = Auth::user();
        $job = Job::findOrFail($id);

        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        // STRICT SCORE CHECK (Minimum 40% unless Magang)
        if (($user->match_score ?? 0) < 40 && strtolower($job->type) !== 'magang') {
            return redirect()->route('dashboard.index')->with('error', 'Match Score Profil Anda di bawah 40%. Silakan lengkapi profil Anda terlebih dahulu untuk melamar pekerjaan ini.');
        }

        // MANDATORY CV CHECK
        if (! $user->cv_path) {
            return redirect()->route('dashboard.profil')->with('error', 'Wajib upload CV di profil sebelum melamar pekerjaan!');
        }

        // Use CV from user profile (already stored), no re-upload needed
        $cvPath = $user->cv_path;

        JobApplication::create([
            'user_id' => $user->id,
            'job_id' => $id,
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard.lamaran')
            ->with('success', 'Lamaran Anda berhasil terkirim! Tim HRD akan segera meninjau profil Anda.');
    }

    public function simpanJob($id)
    {
        $user = Auth::user();
        $exists = SavedJob::where('user_id', $user->id)->where('job_id', $id)->first();

        if (! $exists) {
            SavedJob::create(['user_id' => $user->id, 'job_id' => $id]);

            return back()->with('success', 'Lowongan berhasil disimpan ke daftar favorit Anda.');
        }

        return back()->with('info', 'Lowongan sudah ada di daftar simpan Anda.');
    }

    public function rekomendasi()
    {
        $user = Auth::user();
        $jobs = Job::where('match_score', '>=', 80)->latest()->get();

        return view('dashboard.rekomendasi', [
            'user' => $user,
            'active_page' => 'rekomendasi',
            'jobs' => $jobs,
        ]);
    }

    public function disimpan()
    {
        $user = Auth::user();
        $savedJobs = SavedJob::with('job')->where('user_id', $user->id)->latest()->get();

        return view('dashboard.disimpan', [
            'user' => $user,
            'active_page' => 'disimpan',
            'savedJobs' => $savedJobs,
        ]);
    }

    public function lpk()
    {
        $user = Auth::user();

        return view('dashboard.lpk', [
            'user' => $user,
            'active_page' => 'lpk',
        ]);
    }

    public function perusahaan()
    {
        $user = Auth::user();
        $jobIds = Job::where('user_id', $user->id)->pluck('id');

        $applications = JobApplication::with(['job', 'user'])
            ->whereIn('job_id', $jobIds)
            ->latest()
            ->get();

        return view('dashboard.perusahaan', [
            'user' => $user,
            'active_page' => 'perusahaan',
            'applications' => $applications,
            'total_applicants' => $applications->count(),
            'total_hired' => $applications->where('status', 'diterima')->count(),
        ]);
    }

    /** Upload CV from profile page — stores in private disk and updates user record */
    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();

        // Delete old CV if exists
        if ($user->cv_path && Storage::disk('private')->exists($user->cv_path)) {
            Storage::disk('private')->delete($user->cv_path);
        }

        $path = $request->file('cv')->store('cvs', 'private');

        $user->update(['cv_path' => $path]);

        return back()->with('success', 'CV berhasil diupload dan disimpan di profil Anda!');
    }

    public function getLandingStats()
    {
        $hiredCount = JobApplication::where('status', 'diterima')->count();
        $talentaCount = User::where('role', 'PENCARI_KERJA')->count();
        $lowonganCount = Job::count();
        $mitraCount = User::whereIn('role', ['PERUSAHAAN', 'LPK'])->count();
        
        // Calculate average match rate (default to 88% if no users)
        $avgMatch = User::where('role', 'PENCARI_KERJA')->avg('match_score') ?? 88;
        
        return response()->json([
            'hired' => $hiredCount,
            'talenta' => $talentaCount,
            'lowongan' => $lowonganCount,
            'match_rate' => round($avgMatch),
            'mitra' => $mitraCount,
        ]);
    }
}
