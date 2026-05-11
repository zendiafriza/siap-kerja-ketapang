<?php

use App\Models\User;
use Illuminate\Support\Carbon;

it('locks features for users under 18', function () {
    $user = User::factory()->create([
        'birth_date' => Carbon::now()->subYears(17),
    ]);

    $this->actingAs($user)
        ->get(route('dashboard.index'))
        ->assertRedirect(route('dashboard.profil'))
        ->assertSessionHas('error', 'Akses Terbatas: Anda harus berusia minimal 18 tahun untuk menggunakan fitur platform ini. Silakan update tanggal lahir Anda jika terjadi kesalahan.');
});

it('allows features for users 18 and over', function () {
    $user = User::factory()->create([
        'birth_date' => Carbon::now()->subYears(19),
    ]);

    $this->actingAs($user)
        ->get(route('dashboard.index'))
        ->assertStatus(200);
});

it('allows access to profile page for underage users to fix their birth date', function () {
    $user = User::factory()->create([
        'birth_date' => Carbon::now()->subYears(17),
    ]);

    $this->actingAs($user)
        ->get(route('dashboard.profil'))
        ->assertStatus(200);
});
