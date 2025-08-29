<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos para la gestión de usuarios
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Crear permisos para la gestión del gimnasio
        Permission::create(['name' => 'manage sucursales']);
        Permission::create(['name' => 'manage membership types']);
        Permission::create(['name' => 'manage members']);
        Permission::create(['name' => 'manage payments']);
        Permission::create(['name' => 'manage asistencias']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'manage settings']);


        // Crear rol de Administrador y asignarle todos los permisos
        $roleAdmin = Role::create(['name' => 'Administrador']);
        $roleAdmin->givePermissionTo(Permission::all());

        // Crear rol de Recepcionista y asignarle permisos específicos
        $roleRecepcionista = Role::create(['name' => 'Recepcionista']);
        $roleRecepcionista->givePermissionTo([
            'read users',
            'manage members',
            'manage payments',
            'manage asistencias'
        ]);

        // Crear usuario administrador por defecto
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole($roleAdmin);

        // Crear usuario recepcionista de ejemplo
        $receptionistUser = User::factory()->create([
            'name' => 'Recepcionista',
            'email' => 'recepcion@gym.com',
            'password' => Hash::make('password'),
        ]);
        $receptionistUser->assignRole($roleRecepcionista);
    }
}
