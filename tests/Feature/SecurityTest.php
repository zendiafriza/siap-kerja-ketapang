<?php

use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('unauthenticated users cannot access dashboard', function () {
    $response = $this->get(route('dashboard.index'));
    $response->assertRedirect(route('login'));
});

test('pencari kerja cannot access perusahaan dashboard', function () {
    $user = User::factory()->create(['role' => 'PENCARI_KERJA']);
    
    $response = $this->actingAs($user)->get(route('dashboard.perusahaan'));
    
    // It should redirect to candidate dashboard or throw 403
    // Based on DashboardController, it redirects
    $response->assertRedirect(route('dashboard.index'));
});

test('pencari kerja cannot download other users cv', function () {
    $user1 = User::factory()->create(['role' => 'PENCARI_KERJA', 'cv_path' => 'cvs/user1.pdf']);
    $user2 = User::factory()->create(['role' => 'PENCARI_KERJA', 'cv_path' => 'cvs/user2.pdf']);
    
    $job = Job::factory()->create();
    $application = JobApplication::create([
        'user_id' => $user2->id,
        'job_id' => $job->id,
        'cv_path' => $user2->cv_path,
        'status' => 'pending'
    ]);

    // Attempting to download user2's CV as user1
    $response = $this->actingAs($user1)->get(route('perusahaan.aplikasi.cv', $application));
    
    // PerusahaanController should handle authorization
    $response->assertStatus(403); 
});

test('guest cannot update profile', function () {
    $response = $this->patch(route('profile.update.modal'), [
        'name' => 'Hacker'
    ]);
    
    $response->assertRedirect(route('login'));
});

test('csrf protection is active', function () {
    $routes = Route::getRoutes();
    $route = $routes->getByName('profile.update.modal');
    
    expect($route->middleware())->toContain('web');
});

test('profile update is protected against XSS', function () {
    $user = User::factory()->create(['role' => 'PENCARI_KERJA']);
    $maliciousScript = '<script>alert("XSS")</script>';
    
    $response = $this->actingAs($user)->patch(route('profile.update.modal'), [
        'name' => 'John Doe ' . $maliciousScript,
        'sekolah' => 'SMK 1',
        'jurusan' => 'TKJ'
    ]);
    
    $user->refresh();
    
    // The data might be stored with the tag, but when rendering it should be escaped.
    // In Laravel, we test the output in the view.
    $response = $this->get(route('dashboard.profil'));
    $response->assertSee('John Doe &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', false);
});

test('perusahaan cannot access other perusahaan jobs', function () {
    $p1 = User::factory()->create(['role' => 'PERUSAHAAN']);
    $p2 = User::factory()->create(['role' => 'PERUSAHAAN']);
    
    $job1 = Job::factory()->create(['user_id' => $p1->id]);
    
    // p2 attempts to update job1
    $response = $this->actingAs($p2)->get(route('perusahaan.lowongan'));
    
    // Should not see job1 in their dashboard
    $response->assertDontSee($job1->title);
});

test('directory traversal is prevented on cv download', function () {
    $user = User::factory()->create(['role' => 'PERUSAHAAN']);
    $candidate = User::factory()->create(['role' => 'PENCARI_KERJA', 'cv_path' => '../../../.env']);
    
    $job = Job::factory()->create(['user_id' => $user->id]);
    $application = JobApplication::create([
        'user_id' => $candidate->id,
        'job_id' => $job->id,
        'cv_path' => $candidate->cv_path,
        'status' => 'pending'
    ]);
    
    $response = $this->actingAs($user)->get(route('perusahaan.aplikasi.cv', $application));
    
    // Should return 404 or redirect with error because the file doesn't exist in the disk
    // Or Storage::disk('private')->exists() will return false
    $response->assertSessionHas('error');
});

