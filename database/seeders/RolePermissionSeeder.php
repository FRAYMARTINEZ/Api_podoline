<?php

namespace Database\Seeders;

use App\Models\ConsultingOffice;
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
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $pro1Role = Role::firstOrCreate(['name' => 'Profesional1']);
        $pro2Role = Role::firstOrCreate(['name' => 'Profesional2']);


        // Crear permisos
        $editPermission = Permission::firstOrCreate(['name' => 'Editar consulta']);
        $viewPermission = Permission::firstOrCreate(['name' => 'Ver consulta']);
        $createPermission = Permission::firstOrCreate(['name' => 'Crear consulta']);
        $updatePermission = Permission::firstOrCreate(['name' => 'Actualizar consulta']);
        $searchPermission = Permission::firstOrCreate(['name' => 'Buscar consulta']);
        $disablePermission = Permission::firstOrCreate(['name' => 'Inabilitar consulta']);
        $crudPermission = Permission::firstOrCreate(['name' => 'Crud de usuario']);



        // Asignar permisos a roles
        $adminRole->givePermissionTo([$crudPermission,  $createPermission, $editPermission, $updatePermission, $viewPermission,  $searchPermission, $disablePermission]);
        $pro1Role->givePermissionTo([$createPermission, $viewPermission,  $editPermission, $updatePermission, $searchPermission, $disablePermission]);
        $pro2Role->givePermissionTo([$createPermission, $viewPermission, $searchPermission]);


        ConsultingOffice::insert([
            [
                'name'=>'Consultorio Cali',
                'country_id' => 1, // Asegúrate de que exista en la tabla countries
                'department_id' => 1, // Asegúrate de que exista en la tabla departments
                'city_id' => 1, // Asegúrate de que exista en la tabla cities
                'address' => 'Calle 123 #45-67, Medellín',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Consultorio Medellin',
                'country_id' => 1,
                'department_id' => 2,
                'city_id' => 2,
                'address' => 'Carrera 89 #12-34, Bogotá',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


        // Crear usuarios y asignar roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'office_id' => 1
            ]
        );
        $admin->assignRole('Administrador');

        $user1 = User::firstOrCreate(
            ['email' => 'profesional1@example.com'],
            [
                'name' => 'Profesional 1',
                'password' => Hash::make('password'),
                'office_id' => 1
            ]
        );
        $user1->assignRole('Profesional1');

        $user2 = User::firstOrCreate(
            ['email' => 'profesional2@example.com'],
            [
                'name' => 'Profesional 2',
                'password' => Hash::make('password'),
                'office_id' => 1
            ]
        );

        $user2->assignRole('Profesional2');
    }
}
