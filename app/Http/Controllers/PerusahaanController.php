<?php

namespace App\Http\Controllers;

use App\Mail\InterviewScheduledMail;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function lowongan()
    {
        $user = Auth::user();
        $jobs = Job::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.perusahaan_lowongan', [
            'user' => $user,
            'active_page' => 'kelola_lowongan',
            'jobs' => $jobs,
        ]);
    }

    public function storeLowongan(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'hide_salary' => 'nullable|boolean',
        ]);

        Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'company' => Auth::user()->name,
            'location' => $request->location,
            'sector' => $request->sector,
            'type' => $request->type,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'salary' => $request->salary,
            'hide_salary' => $request->has('hide_salary'),
            'match_score' => rand(70, 95),
            'is_featured' => false,
        ]);

        return back()->with('success', 'Lowongan berhasil diterbitkan!');
    }

    public function kandidat()
    {
        $user = Auth::user();

        // Get all jobs owned by this company
        $jobs = Job::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Get all applications for this company's jobs with their applicants
        $applications = JobApplication::whereIn('job_id', $jobs->pluck('id'))
            ->with(['user', 'job'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Group applications by job for the filter
        $applicationsByJob = $applications->groupBy('job_id');

        // Stats
        $totalPelamar = $applications->count();
        $interviewCount = $applications->where('status', 'interview')->count();
        $diterimaCount = $applications->where('status', 'diterima')->count();
        $pendingCount = $applications->whereIn('status', ['pending', 'review'])->count();

        // Fetch all job seekers for the Talent Database
        $talentPool = User::where('role', 'pencari_kerja')
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard.perusahaan_kandidat', [
            'user' => $user,
            'active_page' => 'cari_kandidat',
            'jobs' => $jobs,
            'applications' => $applications,
            'applicationsByJob' => $applicationsByJob,
            'totalPelamar' => $totalPelamar,
            'interviewCount' => $interviewCount,
            'diterimaCount' => $diterimaCount,
            'pendingCount' => $pendingCount,
            'talentPool' => $talentPool,
        ]);
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        // Ensure this application belongs to one of this company's jobs
        $this->authorizeApplication($application);

        $request->validate([
            'status' => 'required|in:pending,review,interview,diterima,ditolak',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }

    public function setInterview(Request $request, JobApplication $application)
    {
        $this->authorizeApplication($application);

        $request->validate([
            'interview_date' => 'required|date|after_or_equal:today',
            'interview_time' => 'required',
            'interview_location' => 'nullable|string|max:255',
            'interview_note' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => 'interview',
            'interview_date' => $request->interview_date,
            'interview_time' => $request->interview_time,
            'interview_location' => $request->interview_location,
            'interview_note' => $request->interview_note,
        ]);

        // Send email notification to candidate
        try {
            Mail::to($application->user->email)->send(new InterviewScheduledMail($application));
        } catch (\Exception $e) {
            // Mail sending failed but interview was set — log silently
            logger()->error('Interview mail failed: '.$e->getMessage());
        }

        return back()->with('success', 'Jadwal interview berhasil disimpan dan email notifikasi telah dikirim ke kandidat.');
    }

    public function downloadCv(JobApplication $application)
    {
        $this->authorizeApplication($application);

        // Always get the LATEST CV from the user's profile
        $user = $application->user;
        $path = $user->cv_path;

        if (! $path || ! Storage::disk('private')->exists($path)) {
            return back()->with('error', 'Kandidat belum mengunggah CV terbaru di profil mereka.');
        }

        $candidateName = str_replace(' ', '_', $user->name);
        $fileName = "CV_Terbaru_{$candidateName}.pdf";

        return Storage::disk('private')->download($path, $fileName);
    }

    /** @throws AuthorizationException */
    private function authorizeApplication(JobApplication $application): void
    {
        $jobBelongsToCompany = Job::where('id', $application->job_id)
            ->where('user_id', Auth::id())
            ->exists();

        abort_if(! $jobBelongsToCompany, 403, 'Akses tidak diizinkan.');
    }
}
