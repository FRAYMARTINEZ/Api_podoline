<?php

namespace App\Models;

use App\Models\Scopes\CreatedByScope;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Attention extends Model
{
    use SoftDeletes, HasImages;
    protected $table = 'attentions';

    protected $fillable = [
        'office_id', // ID de la oficina
        'appointment_date', // Fecha de atención
        'shoe_size', // Talla de zapato
        'footstep_type_left', // Tipo pisada Izq
        'footstep_type_right', // Tipo pisada Der

        'foot_type_left', // Tipo Pie Izq
        'foot_type_right', // Tipo Pie Der

        'heel_type_left', // Tipo Talón Izq
        'heel_type_right', // Tipo Talón Der
        'extra',
        'side', // Lado
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
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
                $model->office_id = $user->office_id;
            } else {
                $model->created_by = 1;
                $model->updated_by = 1;
                $model->office_id = 1;
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
