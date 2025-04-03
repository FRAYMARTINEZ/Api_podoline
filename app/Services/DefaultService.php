<?php

namespace App\Services;

use App\Repositories\DefaultRepository;
use Illuminate\Database\Eloquent\Collection;

class DefaultService
{
    protected $defaultRepository;

    public function __construct(DefaultRepository $defaultRepository)
    {
        $this->defaultRepository = $defaultRepository;
    }

    public function defaultData(): array
    {
        return $this->defaultRepository->defaultData();
    }

    public function findCity(int $department_id): ?Collection
    {
        return $this->defaultRepository->findCity($department_id);
    }
}
