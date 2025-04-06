<?php

namespace App\Repositories;

use App\Models\ConsultingOffice;
use App\Repositories\Contracts\ConsultingOfficeRepositoryInterface;

class ConsultingOfficeRepository implements ConsultingOfficeRepositoryInterface
{
    public function all()
    {
        return ConsultingOffice::withTrashed()->paginate(15);
    }

    public function find($id)
    {
        return ConsultingOffice::findOrFail($id);
    }

    public function create(array $data)
    {
        return ConsultingOffice::create($data);
    }

    public function update($id, array $data)
    {
        $office = ConsultingOffice::findOrFail($id);
        $office->update($data);
        return $office;
    }

    public function delete($id)
    {
        return ConsultingOffice::destroy($id);
    }
}
