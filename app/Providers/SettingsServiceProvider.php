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
        // Check if the settings table exists to avoid errors during initial migrations
        if (Schema::hasTable('settings')) {
            try {
                $settings = Setting::pluck('value', 'key');

                // Set application config values from database settings
                if ($settings->has('app_name')) {
                    Config::set('app.name', $settings['app_name']);
                }

                if ($settings->has('app_theme')) {
                    Config::set('app.theme', $settings['app_theme']);
                    View::share('theme', $settings['app_theme']);
                } else {
                    View::share('theme', 'dark'); // Default fallback
                }

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
                // Log the error or handle it gracefully
                // This can prevent crashes if the database is not ready
                return;
            }
        }
    }
}
