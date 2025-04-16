<?php

namespace App\Models;

use App\Scopes\CreatedByScope;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Attention extends Model
{
    use SoftDeletes, HasImages;
    protected $table = 'attentions';

    protected $fillable = [
        'appointment_date', // Fecha de atención
        'shoe_size', // Talla de zapato
        'footstep_type_left', // Tipo pisada Izq
        'footstep_type_right', // Tipo pisada Der

        'foot_type_left', // Tipo Pie Izq
        'foot_type_right', // Tipo Pie Der

        'heel_type_left', // Tipo Talón Izq
        'heel_type_right', // Tipo Talón Der

        'observations' // Observaciones
    ];


    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'attention_patients')
            ->withTimestamps();
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

       // static::addGlobalScope(new CreatedByScope);
    }
}
