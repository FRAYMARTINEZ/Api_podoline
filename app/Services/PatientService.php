<?php

namespace App\Services;

use App\Repositories\PatientRepository;
use App\Models\Patient;


class PatientService
{
    protected $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getAllPatients()
    {
        return $this->patientRepository->all();
    }

    public function getPatientById(int $id): ?Patient
    {
        return $this->patientRepository->find($id);
    }

    public function searchPatientAttention(int $search, string $type =""): ?Patient{
        return $this->patientRepository->searchPatientAttention($search, $type);
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

    public function restore(int $id): ?Patient
    {
        return $this->patientRepository->restore($id);
    }
}
