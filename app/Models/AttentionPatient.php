<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttentionPatient extends Model
{
    use SoftDeletes;
    protected $table = 'attention_patients';

    protected $fillable = ['patient_id', 'attention_id'];
}
