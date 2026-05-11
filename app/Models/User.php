<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'gauth_id',
    'gauth_type',
    'sekolah',
    'jurusan',
    'match_score',
    'xp',
    'profile_metadata',
    'cv_path',
])]

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_metadata' => 'array',
        ];
    }


    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function hasPersonalData(): bool
    {
        $meta = $this->profile_metadata ?? [];

        return ! empty($meta['nama_lengkap']) && ! empty($meta['no_hp']);
    }

    public function hasExperience(): bool
    {
        $meta = $this->profile_metadata ?? [];

        return ! empty($meta['pengalaman']) && count($meta['pengalaman']) > 0 && ! empty($meta['pengalaman'][0]['perusahaan']);
    }

    public function hasEducation(): bool
    {
        $meta = $this->profile_metadata ?? [];

        return ! empty($meta['pendidikan']) && count($meta['pendidikan']) > 0 && ! empty($meta['pendidikan'][0]['institusi']);
    }

    public function hasCvUploaded(): bool
    {
        return ! empty($this->cv_path);
    }
}
