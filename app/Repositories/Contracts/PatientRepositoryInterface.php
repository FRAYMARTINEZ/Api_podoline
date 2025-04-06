<?php

namespace App\Repositories\Contracts;

use App\Models\Patient;


interface PatientRepositoryInterface
{
    public function all();
    public function find(int $id): ?Patient;
    public function searchPatientAttention(int $search, string $type=""): ?Patient;
    public function create(array $data): Patient;
    public function update(int $id, array $data): ?Patient;
    public function delete(int $id): bool;
}