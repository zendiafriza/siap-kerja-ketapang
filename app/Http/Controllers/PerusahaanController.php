<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function lowongan()
    {
        $user = Auth::user();
        $jobs = Job::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.perusahaan_lowongan', [
            'user' => $user,
            'active_page' => 'kelola_lowongan',
            'jobs' => $jobs
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
            'is_featured' => false
        ]);

        return back()->with('success', 'Lowongan berhasil diterbitkan!');
    }

    public function kandidat()
    {
        $user = Auth::user();
        // Fetch all candidates (role: pencari_kerja)
        $candidates = User::where('role', 'pencari_kerja')
                          ->get();

        return view('dashboard.perusahaan_kandidat', [
            'user' => $user,
            'active_page' => 'cari_kandidat',
            'candidates' => $candidates
        ]);
    }
}
