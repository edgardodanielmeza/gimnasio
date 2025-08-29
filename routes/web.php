<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Livewire\UserManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

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

    // Sucursales Management Route
    Route::get('/sucursales', \App\Livewire\SucursalManagement::class)->name('sucursales.index');

    // Tipos de Membresía Management Route
    Route::get('/tipos-membresia', \App\Livewire\TipoMembresiaManagement::class)->name('tipos-membresia.index');

    // Miembros Management Route
    Route::get('/miembros', \App\Livewire\MiembroManagement::class)->name('miembros.index');
    Route::get('/miembros/{miembro}', \App\Livewire\MiembroShow::class)->name('miembros.show');

    // Asistencia Management Route
    Route::get('/asistencias', \App\Livewire\AsistenciaManagement::class)->name('asistencias.index');
});
