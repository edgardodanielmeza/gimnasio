<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'name' => 'Casa Central',
            'address' => 'Av. Principal 123',
            'phone' => '021-123-456',
        ]);

        Branch::create([
            'name' => 'Sucursal Villa Morra',
            'address' => 'Av. Mcal. Lopez 456',
            'phone' => '021-987-654',
        ]);
    }
}
