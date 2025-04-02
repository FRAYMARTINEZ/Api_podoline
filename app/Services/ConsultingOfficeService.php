<?php

namespace App\Services;

use App\Models\ConsultingOffice;
use App\Repositories\ConsultingOfficeRepository;
use Illuminate\Database\Eloquent\Collection;

class ConsultingOfficeService
{
    protected $consultingOfficeRepository;

    public function __construct(ConsultingOfficeRepository $consultingOfficeRepository)
    {
        $this->consultingOfficeRepository = $consultingOfficeRepository;
    }

    public function all(): Collection
    {
        return $this->consultingOfficeRepository->all();
    }

    public function find(int $id): ?ConsultingOffice
    {
        return $this->consultingOfficeRepository->find($id);
    }

    public function create(array $data): ConsultingOffice
    {
        return $this->consultingOfficeRepository->create($data);
    }

    public function update(int $id, array $data): ?ConsultingOffice
    {
        return $this->consultingOfficeRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->consultingOfficeRepository->delete($id);
    }
}
