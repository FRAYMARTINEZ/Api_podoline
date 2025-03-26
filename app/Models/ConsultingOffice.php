<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultingOffice extends Model
{
    use SoftDeletes;
    protected $table = 'consulting_offices';

    protected $fillable = [
        'city_id',
        'country_id',
        'department_id',
        'address'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
