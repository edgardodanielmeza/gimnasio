<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\ThemeController;
use App\Livewire\UserManagement;

Route::post('/theme/set', [ThemeController::class, 'set'])->name('theme.set');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Management Route
    Route::get('/users', UserManagement::class)->name('users.index');
});
