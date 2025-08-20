<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create([
            'nombre' => 'Casa Central',
            'direccion' => 'Av. Principal 123',
            'telefono' => '021-123-456',
        ]);

        Sucursal::create([
            'nombre' => 'Sucursal Villa Morra',
            'direccion' => 'Av. Mcal. Lopez 456',
            'telefono' => '021-987-654',
        ]);
    }
}
