<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoMembresia;

class TipoMembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoMembresia::create(['nombre' => 'Diario', 'precio' => 10000, 'duracion_dias' => 1]);
        TipoMembresia::create(['nombre' => 'Quincenal', 'precio' => 80000, 'duracion_dias' => 15]);
        TipoMembresia::create(['nombre' => 'Mensual', 'precio' => 130000, 'duracion_dias' => 30]);
        TipoMembresia::create(['nombre' => '3 veces por semana', 'precio' => 100000, 'duracion_dias' => 30]);
    }
}
