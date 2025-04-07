<?php

namespace App\Repositories\Contracts;

use App\Models\ConsultingOffice;

interface ConsultingOfficeRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function restore(int $id): ?ConsultingOffice;
}
