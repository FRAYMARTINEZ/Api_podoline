<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('genders')->insert([
            [
                'name' => 'Masculino',
            ],
            [
                'name' => 'Femenino',
            ],
        ]);
        DB::table('patients')->insert([
            [
                'name' => 'Juan',
                'last_name' => 'Pérez',
                'type_document' => 'CC',
                'number_document' => '1234567890',
                'date_of_birth' => '1990-05-12',
                'email' => 'juan.perez@example.com',
                'cellphone' => '3001234567',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'gender_id' => 1,
                'office_id' => 1
            ],
            [
                'name' => 'María',
                'last_name' => 'Gómez',
                'type_document' => 'TI',
                'number_document' => '987654321',
                'date_of_birth' => '1995-08-23',
                'email' => 'maria.gomez@example.com',
                'cellphone' => '3007654321',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'gender_id' => 2,
                'office_id' => 1
            ],
            [
                'name' => 'Carlos',
                'last_name' => 'Rodríguez',
                'type_document' => 'CC',
                'number_document' => '456789123',
                'date_of_birth' => '1988-11-30',
                'email' => 'carlos.rodriguez@example.com',
                'cellphone' => '3004567891',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'gender_id' => 1,
                'office_id' => 1
            ]
        ]);
    }
}
