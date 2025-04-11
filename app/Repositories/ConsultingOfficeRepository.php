<?php

namespace App\Repositories;

use App\Models\ConsultingOffice;
use App\Repositories\Contracts\ConsultingOfficeRepositoryInterface;
use Illuminate\Support\Facades\Log;

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
        $consultingOffice =  new ConsultingOffice();
        $consultingOffice->name = $data['name'];
        $consultingOffice->city_id = $data['city_id'];
        $consultingOffice->country_id = $data['country_id'];
        $consultingOffice->department_id = $data['department_id'];
        $consultingOffice->address = $data['address'];
        return $consultingOffice->save() ? $consultingOffice : null;
    }

    public function update($id, array $data)
    {
        $consultingOffice = ConsultingOffice::findOrFail($id);
        $consultingOffice->name = $data['name'];
        $consultingOffice->city_id = $data['city_id'];
        $consultingOffice->country_id = $data['country_id'];
        $consultingOffice->department_id = $data['department_id'];
        $consultingOffice->address = $data['address'];
        $consultingOffice->save();
        return $consultingOffice;
    }

    public function delete($id)
    {
        return ConsultingOffice::destroy($id);
    }

    public function restore(int $id): ?ConsultingOffice
    {
        $consultingOffice = ConsultingOffice::withTrashed()->findOrFail($id);

        if ($consultingOffice->trashed()) {
            $consultingOffice->restore();
        }

        return $consultingOffice;
    }
}
