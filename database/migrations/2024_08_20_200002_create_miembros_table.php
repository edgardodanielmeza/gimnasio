<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('miembros', function (Blueprint $table) {
            $table->id();
            $table->string('documento_identidad')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->string('ruta_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('miembros');
    }
};
