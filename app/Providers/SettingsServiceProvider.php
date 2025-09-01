<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            try {
                $settings = Setting::pluck('value', 'key');

                if ($settings->has('app_name')) {
                    Config::set('app.name', $settings['app_name']);
                }

                $lightTheme = $settings->get('theme_light', 'garden');
                $darkTheme = $settings->get('theme_dark', 'dark');
                View::share('theme_light', $lightTheme);
                View::share('theme_dark', $darkTheme);

                if ($settings->has('app_logo')) {
                    Config::set('app.logo', $settings['app_logo']);
                    View::share('logo', $settings['app_logo']);
                } else {
                    View::share('logo', null);
                }

                if ($settings->has('app_currency')) {
                    Config::set('app.currency', $settings['app_currency']);
                }

            } catch (\Exception $e) {
                // Fails gracefully if db is not ready
                return;
            }
        }
    }
}
