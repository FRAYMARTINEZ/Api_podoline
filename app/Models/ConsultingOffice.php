<?php

namespace App\Models;

use App\Models\Scopes\CreatedByScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ConsultingOffice extends Model
{
    use SoftDeletes;
    protected $table = 'consulting_offices';

    protected $fillable = [
        'name',
        'city_id',
        'country_id',
        'department_id',
        'address',
        'created_by',
        'updated_by',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $userId = Auth::id() ?? 1;
            if ($userId) {
                $model->created_by = $userId;
                $model->updated_by = $userId;
            }
        });

        static::updating(function ($model) {
            $userId = Auth::id() ?? 1;
            if ($userId) {
                $model->updated_by = $userId;
            }
        });

        static::addGlobalScope(new CreatedByScope);
    }
}
