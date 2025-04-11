<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Contracts\PatientRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PatientRepository implements PatientRepositoryInterface
{
    public function all()
    {
        return Patient::withTrashed()->paginate(15);
    }

    public function find(int $id): ?Patient
    {
        return Patient::with('attentions.images')->findOrFail($id);
    }

    public function searchPatientAttention(int $search, string $type = ""): ?Patient
    {
        $patient =  Patient::with('attentions.images')->where('number_document', $search)->first();
        Log::info($patient);


        /*if ($type === 'cellphone') {
            $patient->where('cellphone', $search);
        } else {
            $patient->where('number_document', $search);
        }*/

        return $patient;
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

    public function restore(int $id): ?Patient
    {
        $patient = Patient::withTrashed()->findOrFail($id);

        if ($patient->trashed()) {
            $patient->restore();
        }

        return $patient;
    }
}