<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create(['nombre' => 'Central', 'direccion' => 'Calle Principal 123']);
        Sucursal::create(['nombre' => 'Sucursal 1', 'direccion' => 'Avenida Secundaria 456']);
    }
}
