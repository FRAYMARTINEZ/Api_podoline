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
        return Patient::whereNull('deleted_at')->paginate(5); // Filtro explícito
    }

    public function find(int $id): ?Patient
    {
        return Patient::with(['attentions.images', 'gender'])->findOrFail($id);
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
        $patient = new Patient();
        $patient->name = $data['name'] ?? '';
        $patient->last_name = $data['last_name'] ?? '';
        $patient->type_document = $data['type_documente'] ?? '';
        $patient->number_document = $data['number_document'] ?? '';
        $patient->date_of_birth = $data['date_of_birth'] ?? '';
        $patient->email = $data['email'] ?? '';
        $patient->cellphone = $data['cellphone'] ?? '';
        $patient->gender_id = $data['gender_id'] ?? '';
        $patient->save();
        return  $patient;
    }

    public function update(int $id, array $data): ?Patient
    {
        $patient = Patient::findOrFail($id);
        if ($patient) {
            $patient->name = $data['name'] ??  $patient->name;
            $patient->last_name = $data['last_name'] ??  $patient->last_name;
            $patient->type_document = $data['type_documente'] ??  $patient->type_document;
            $patient->number_document = $data['number_document'] ??  $patient->number_document;
            $patient->date_of_birth = $data['date_of_birth'] ??  $patient->date_of_birth;
            $patient->email = $data['email'] ??  $patient->email;
            $patient->cellphone = $data['cellphone'] ??  $patient->cellphone;
            $patient->gender_id = $data['gender_id'] ??  $patient->gender_id;
            $patient->save();
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
