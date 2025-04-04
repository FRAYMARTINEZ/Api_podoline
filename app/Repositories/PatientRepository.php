<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Contracts\PatientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository implements PatientRepositoryInterface
{
    public function all(): Collection
    {
        return Patient::all();
    }

    public function find(int $id): ?Patient
    {
        return Patient::with('attentions.images')->findOrFail($id);
    }

    public function create(array $data): Patient
    {
        return Patient::create($data);
    }

    public function update(int $id, array $data): ?Patient
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->update($data);
        }
        return $patient;
    }

    public function delete(int $id): bool
    {
        $patient = Patient::find($id);
        return $patient ? $patient->delete() : false;
    }
}