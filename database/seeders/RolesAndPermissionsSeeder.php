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

        // User Management Permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Gym Management Permissions
        Permission::create(['name' => 'manage sucursales']);
        Permission::create(['name' => 'manage membership types']);
        Permission::create(['name' => 'manage members']);
        Permission::create(['name' => 'manage payments']);
        Permission::create(['name' => 'manage asistencias']);
        Permission::create(['name' => 'manage settings']);
        Permission::create(['name' => 'view reports']);

        // Create Roles and assign permissions
        $roleAdmin = Role::create(['name' => 'Administrador']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleRecepcionista = Role::create(['name' => 'Recepcionista']);
        $roleRecepcionista->givePermissionTo([
            'read users',
            'manage members',
            'manage payments',
            'manage asistencias',
        ]);

        // Create a default Admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole($roleAdmin);

        // Create a default Receptionist user
        $receptionistUser = User::factory()->create([
            'name' => 'Recepcionista',
            'email' => 'recepcion@gym.com',
            'password' => Hash::make('password'),
        ]);
        $receptionistUser->assignRole($roleRecepcionista);
    }
}
