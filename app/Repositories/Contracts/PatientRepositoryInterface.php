<?php

namespace App\Repositories\Contracts;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

interface PatientRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Patient;
    public function create(array $data): Patient;
    public function update(int $id, array $data): ?Patient;
    public function delete(int $id): bool;
}