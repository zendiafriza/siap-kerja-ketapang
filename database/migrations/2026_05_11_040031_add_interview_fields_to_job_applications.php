<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('cv_path')->nullable()->after('cover_letter');
            $table->date('interview_date')->nullable()->after('cv_path');
            $table->time('interview_time')->nullable()->after('interview_date');
            $table->text('interview_note')->nullable()->after('interview_time');
            $table->string('interview_location')->nullable()->after('interview_note');
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['cv_path', 'interview_date', 'interview_time', 'interview_note', 'interview_location']);
        });
    }
};
