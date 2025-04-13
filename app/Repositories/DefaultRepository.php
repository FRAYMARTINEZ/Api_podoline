<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Gender;
use App\Repositories\Contracts\DefaultRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class DefaultRepository implements DefaultRepositoryInterface
{
    public function defaultData(): array
    {
        $cities = City::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $departments =  Department::select('id', 'name')->get();
        $genders = Gender::select('id', 'name')->get();
        return [
            'countries' => $countries,
            'departments' => $departments,
            'cities' => $cities,
            'genders' => $genders
        ];
    }

    public function findCity(int $department_id): Collection
    {
        $cities = City::where('department_id', $department_id)->get();
        if ($cities->count() == 0) {

            throw ValidationException::withMessages([
                'department_id' => ['El id de departamento no existe en nuestra base datos.'],
            ]);
        }
        return $cities;
    }
}
