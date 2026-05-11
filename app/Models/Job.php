<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'location',
        'sector',
        'type',
        'description',
        'salary',
        'hide_salary',
        'match_score',
        'deadline',
        'is_featured',
    ];

    /**
     * Calculate Job-Specific Match Score for a given User
     * Based on: Jurusan (40%), Pengalaman (30%), Sertifikasi/Keahlian (30%)
     */
    public function calculateUserMatch(User $user): int
    {
        $score = 0;
        $meta = $user->profile_metadata ?? [];

        // 1. Jurusan Match (40 pts)
        $userJurusan = strtolower($user->jurusan ?? '');
        $jobTitle = strtolower($this->title);
        $jobSector = strtolower($this->sector);

        if ($userJurusan && (str_contains($jobTitle, $userJurusan) || str_contains($jobSector, $userJurusan))) {
            $score += 40;
        } elseif ($userJurusan) {
            $score += 15; // Partial match for having any jurusan
        }

        // 2. Experience Match (30 pts)
        $experiences = $meta['pengalaman'] ?? [];
        if (! empty($experiences)) {
            $expText = strtolower(json_encode($experiences));
            $foundMatch = false;
            foreach (explode(' ', $jobTitle) as $word) {
                if (strlen($word) > 3 && str_contains($expText, $word)) {
                    $foundMatch = true;
                    break;
                }
            }
            $score += $foundMatch ? 30 : 10;
        }

        // 3. Certification / Skills Match (30 pts)
        $skills = strtolower(($meta['hard_skills'] ?? '').' '.($meta['sertifikat'] ?? ''));
        if ($skills) {
            $foundMatch = false;
            foreach (explode(' ', $jobTitle) as $word) {
                if (strlen($word) > 3 && str_contains($skills, $word)) {
                    $foundMatch = true;
                    break;
                }
            }
            $score += $foundMatch ? 30 : 10;
        }

        return min(100, $score);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
