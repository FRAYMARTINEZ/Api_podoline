<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $table = 'patients';

    protected $fillable = [
        'name',
        'last_name',
        'type_document',
        'number_document',
        'date_of_birth',
        'email',
        'cellphone',
        'gender_id'

    ];
    public function attentions()
    {
        return $this->belongsToMany(Attention::class, 'attention_patients')
            ->withTimestamps(); // Guarda fechas en la tabla pivote
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
}
