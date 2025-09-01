<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Setting::create(['key' => 'app_name', 'value' => 'Gym Management']);
        Setting::create(['key' => 'app_logo', 'value' => null]);
        Setting::create(['key' => 'theme_light', 'value' => 'garden']);
        Setting::create(['key' => 'theme_dark', 'value' => 'dark']);
        Setting::create(['key' => 'app_currency', 'value' => '$']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
