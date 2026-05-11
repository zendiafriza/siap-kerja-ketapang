<?php

test('globals')
    ->expect(['dd', 'dump', 'var_dump', 'print_r'])
    ->not->toBeUsed();

test('dangerous functions')
    ->expect(['eval', 'exec', 'system', 'passthru', 'shell_exec'])
    ->not->toBeUsed();

test('controllers should be authorized')
    ->expect('App\Http\Controllers')
    ->toUse('Illuminate\Support\Facades\Auth')
    ->or->toUse('Illuminate\Foundation\Auth\Access\AuthorizesRequests');

test('models should not use mass assignment by default')
    ->expect('App\Models')
    ->toOnlyUse(['Illuminate\Database\Eloquent\Attributes\Fillable', 'Illuminate\Database\Eloquent\Factories\HasFactory', 'Illuminate\Notifications\Notifiable', 'Illuminate\Foundation\Auth\User', 'Database\Factories\UserFactory']);
