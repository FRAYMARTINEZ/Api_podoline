<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attention extends Model
{
    use SoftDeletes;
    protected $table = 'attentions';



    protected $fillable = [


        'appointment_date', // Fecha de atención
        'shoe_size', // Talla de zapato

        // Imágenes
        'back_standing_up_image',
        'back_45_image',
        'back_toes_up_image',
        'from_chaplin_image',
        'from_chaplin_toes_up_image',
        'with_insoles_image',

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
}
