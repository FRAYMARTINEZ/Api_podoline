<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [

            ['country_id' =>1, 'name' => 'Quindío', 'iso_2' => 'QUI', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Cundinamarca', 'iso_2' => 'CUN', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Chocó', 'iso_2' => 'CHO', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Norte de Santander', 'iso_2' => 'NSA', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Meta', 'iso_2' => 'MET', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Risaralda', 'iso_2' => 'RIS', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Atlántico', 'iso_2' => 'ATL', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Arauca', 'iso_2' => 'ARA', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Guainía', 'iso_2' => 'GUA', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Tolima', 'iso_2' => 'TOL', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Cauca', 'iso_2' => 'CAU', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Vaupés', 'iso_2' => 'VAU', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Magdalena', 'iso_2' => 'MAG', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Caldas', 'iso_2' => 'CAL', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Guaviare', 'iso_2' => 'GUV', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'La Guajira', 'iso_2' => 'LAG', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Antioquia', 'iso_2' => 'ANT', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Caquetá', 'iso_2' => 'CAQ', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Casanare', 'iso_2' => 'CAS', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Bolívar', 'iso_2' => 'BOL', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Vichada', 'iso_2' => 'VID', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Amazonas', 'iso_2' => 'AMA', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Putumayo', 'iso_2' => 'PUT', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Nariño', 'iso_2' => 'NAR', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Córdoba', 'iso_2' => 'COR', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Cesar', 'iso_2' => 'CES', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Archipiélago de San Andrés, Providencia y Santa Catalina', 'iso_2' => 'SAP', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Santander', 'iso_2' => 'SAN', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Sucre', 'iso_2' => 'SUC', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Boyacá', 'iso_2' => 'BOY', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Valle del Cauca', 'iso_2' => 'VAC', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Huila', 'iso_2' => 'HUI', 'created_at' => now(), 'updated_at' => now(), ],
            ['country_id' =>1, 'name' => 'Bogotá D.C.', 'iso_2' => 'DC', 'created_at' => now(), 'updated_at' => now(), ]
        ];
        Department::insert($states);
    }
}
