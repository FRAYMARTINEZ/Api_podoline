<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Ejemplo de implementación
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Crear permisos
        $editPermission = Permission::firstOrCreate(['name' => 'edit articles']);
        $viewPermission = Permission::firstOrCreate(['name' => 'view articles']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo([$editPermission, $viewPermission]);
        $userRole->givePermissionTo([$viewPermission]);

        // Crear usuarios y asignar roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password')
            ]
        );
        $admin->assignRole('admin');

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password')
            ]
        );

        $user->assignRole('user');
    }
}
