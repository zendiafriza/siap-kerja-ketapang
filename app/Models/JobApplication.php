<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'cover_letter',
        'cv_path',
        'status',
        'interview_date',
        'interview_time',
        'interview_note',
        'interview_location',
    ];

    protected function casts(): array
    {
        return [
            'interview_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function hasCv(): bool
    {
        return ! empty($this->cv_path);
    }

    public function hasInterview(): bool
    {
        return ! empty($this->interview_date) && ! empty($this->interview_time);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending' => 'Sedang Diproses',
            'review' => 'Sedang Direview',
            'interview' => 'Dipanggil Interview',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'pending' => '#f59e0b',
            'review' => '#3b82f6',
            'interview' => '#10b981',
            'diterima' => '#059669',
            'ditolak' => '#ef4444',
            default => '#94a3b8',
        };
    }
}
