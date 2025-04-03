<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DefaultRepositoryInterface
{
    public function defaultData(): array;
    public function findCity(int $department_id): Collection;
}