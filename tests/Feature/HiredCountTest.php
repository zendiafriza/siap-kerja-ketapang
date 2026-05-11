<?php

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;

it('can fetch the hired count', function () {
    // Create a job and a user
    $job = Job::factory()->create();
    $user = User::factory()->create();

    // Create 3 accepted applications
    JobApplication::factory()->count(3)->create([
        'status' => 'diterima',
    ]);

    // Create 2 pending applications
    JobApplication::factory()->count(2)->create([
        'status' => 'pending',
    ]);

    $response = $this->getJson(route('api.stats.hired'));

    $response->assertStatus(200)
        ->assertJson([
            'count' => 3,
        ]);
});
