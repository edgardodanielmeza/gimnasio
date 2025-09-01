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
    public $theme_light;
    public $theme_dark;
    public $app_currency;
    public $new_logo;

    public function mount()
    {
        $this->settings = Setting::pluck('value', 'key');
        $this->app_name = $this->settings['app_name'] ?? 'Gym Management';
        $this->app_logo = $this->settings['app_logo'] ?? null;
        $this->theme_light = $this->settings['theme_light'] ?? 'garden';
        $this->theme_dark = $this->settings['theme_dark'] ?? 'dark';
        $this->app_currency = $this->settings['app_currency'] ?? '$';
    }

    public function render()
    {
        $themes = config('daisyui.themes', ['light', 'dark']);
        return view('livewire.settings-management', [
            'themes' => $themes
        ])->layout('layouts.app');
    }

    public function update()
    {
        $this->validate([
            'app_name' => 'required|string|max:255',
            'theme_light' => 'required|string|max:50',
            'theme_dark' => 'required|string|max:50',
            'app_currency' => 'required|string|max:5',
            'new_logo' => 'nullable|image|max:1024',
        ]);

        $settingsToUpdate = [
            'app_name' => $this->app_name,
            'theme_light' => $this->theme_light,
            'theme_dark' => $this->theme_dark,
            'app_currency' => $this->app_currency,
        ];

        if ($this->new_logo) {
            if ($this->app_logo) {
                Storage::disk('public')->delete($this->app_logo);
            }
            $settingsToUpdate['app_logo'] = $this->new_logo->store('logos', 'public');
        }

        foreach ($settingsToUpdate as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Artisan::call('config:clear');
        session()->flash('message', 'Configuración guardada exitosamente.');
        $this->mount();
    }
}
