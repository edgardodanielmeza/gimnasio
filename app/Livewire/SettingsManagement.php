<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class SettingsManagement extends Component
{
    use WithFileUploads;

    public $settings;
    public $app_name;
    public $app_logo;
    public $app_theme;
    public $app_currency;
    public $new_logo;

    public function mount()
    {
        // Cargar todas las configuraciones en un array asociativo y luego a propiedades
        $this->settings = Setting::pluck('value', 'key');
        $this->app_name = $this->settings['app_name'] ?? 'Gym Management';
        $this->app_logo = $this->settings['app_logo'] ?? null;
        $this->app_theme = $this->settings['app_theme'] ?? 'dark';
        $this->app_currency = $this->settings['app_currency'] ?? '$';
    }

    public function render()
    {
        abort_if(!auth()->user()->can('manage settings'), 403);

        $themes = config('daisyui.themes', ['light', 'dark']);
        return view('livewire.settings-management', [
            'themes' => $themes
        ])->layout('layouts.app');
    }

    public function update()
    {
        $this->validate([
            'app_name' => 'required|string|max:255',
            'app_theme' => 'required|string|max:50',
            'app_currency' => 'required|string|max:5',
            'new_logo' => 'nullable|image|max:1024', // 1MB Max
        ]);

        $settingsToUpdate = [
            'app_name' => $this->app_name,
            'app_theme' => $this->app_theme,
            'app_currency' => $this->app_currency,
        ];

        if ($this->new_logo) {
            // Eliminar el logo anterior si existe
            if ($this->app_logo) {
                Storage::disk('public')->delete($this->app_logo);
            }
            // Guardar el nuevo logo
            $settingsToUpdate['app_logo'] = $this->new_logo->store('logos', 'public');
        }

        foreach ($settingsToUpdate as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Limpiar la caché de configuración para que los cambios se reflejen globalmente
        Artisan::call('config:clear');

        session()->flash('message', 'Configuración guardada exitosamente.');
        $this->mount(); // Recargar los datos
    }
}
