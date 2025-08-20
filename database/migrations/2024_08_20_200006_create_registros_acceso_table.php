<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros_acceso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('miembro_id')->constrained('miembros')->onDelete('cascade');
            $table->foreignId('sucursal_id')->constrained('sucursales')->onDelete('cascade');
            $table->dateTime('fecha_ingreso');
            $table->dateTime('fecha_salida')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros_acceso');
    }
};
