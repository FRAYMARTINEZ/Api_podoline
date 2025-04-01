<?php

namespace App\Services;

use App\Repositories\PatientRepository;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientService
{
    protected $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getAllPatients(): Collection
    {
        return $this->patientRepository->all();
    }

    public function getPatientById(int $id): ?Patient
    {
        return $this->patientRepository->find($id);
    }

    public function createPatient(array $data): Patient
    {
        return $this->patientRepository->create($data);
    }

    public function updatePatient(int $id, array $data): ?Patient
    {
        return $this->patientRepository->update($id, $data);
    }

    public function deletePatient(int $id): bool
    {
        return $this->patientRepository->delete($id);
    }
}
