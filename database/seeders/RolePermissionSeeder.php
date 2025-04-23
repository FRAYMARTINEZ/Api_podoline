<?php

namespace Database\Seeders;

use App\Models\ConsultingOffice;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Storage::deleteDirectory('attentions');

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


        ConsultingOffice::create(
            [
                'name' => 'Consultorio Cali',
                'email'=>'consultorio1@gmail.com',
                'phone'=>'34343434', 
                'page_web'=>'consultorio1.web',
                'country_id' => 1, // Asegúrate de que exista en la tabla countries
                'department_id' => 1, // Asegúrate de que exista en la tabla departments
                'city_id' => 1, // Asegúrate de que exista en la tabla cities
                'address' => 'Calle 123 #45-67, Medellín',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        ConsultingOffice::create(
            [
                'name' => 'Consultorio Medellin',
                'email'=>'consultorio2@gmail.com',
                'phone'=>'34343423', 
                'page_web'=>'consultorio2.web',
                'country_id' => 1,
                'department_id' => 2,
                'city_id' => 2,
                'address' => 'Carrera 89 #12-34, Bogotá',
                'created_at' => now(),
                'updated_at' => now(),

            ]
        );


        // Crear usuarios y asignar roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'phone'=>'3456676867', 
                'position'=>'Gerente',
                'password' => Hash::make('password'),
                'office_id' => 1,
            ]
        );
        $admin->assignRole('Administrador');

        $user1 = User::firstOrCreate(
            ['email' => 'profesional1@example.com'],
            [
                'name' => 'Profesional 1',
                'phone'=>'3434343434', 
                'position'=>'Secretaria',
                'password' => Hash::make('password'),
                'office_id' => 1,
            ]
        );
        $user1->assignRole('Profesional1');

        $user2 = User::firstOrCreate(
            ['email' => 'profesional2@example.com'],
            [
                'name' => 'Profesional 2',
                'phone'=>'3434344545', 
                'position'=>'Secretaria 2',
                'password' => Hash::make('password'),
                'office_id' => 1
            ]
        );

        $user2->assignRole('Profesional2');

        Artisan::call('storage:link');
    }
}
