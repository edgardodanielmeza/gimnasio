<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Livewire\UserManagement;
use App\Livewire\SucursalManagement;
use App\Livewire\TipoMembresiaManagement;
use App\Livewire\MiembroManagement;
use App\Livewire\MiembroShow;
use App\Livewire\AsistenciaManagement;
use App\Livewire\SettingsManagement;

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

    Route::get('/users', UserManagement::class)->name('users.index');
    Route::get('/sucursales', SucursalManagement::class)->name('sucursales.index');
    Route::get('/tipos-membresia', TipoMembresiaManagement::class)->name('tipos-membresia.index');
    Route::get('/miembros', MiembroManagement::class)->name('miembros.index');
    Route::get('/miembros/{miembro}', MiembroShow::class)->name('miembros.show');
    Route::get('/asistencias', AsistenciaManagement::class)->name('asistencias.index');
    Route::get('/configuracion', SettingsManagement::class)->name('settings.index');
});
