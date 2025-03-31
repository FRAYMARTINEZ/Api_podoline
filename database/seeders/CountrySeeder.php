<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Colombia',
                'iso_2' => 'CO',
                'iso_3' => 'COL',
                'iso_number' => '170',
                'phone_code' => '57',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Country::insert($countries);
    }
}
