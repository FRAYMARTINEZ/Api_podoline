<?php

namespace App\Repositories\Contracts;

use App\Models\ConsultingOffice;

interface ConsultingOfficeRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function restore(int $id): ?ConsultingOffice;
}
