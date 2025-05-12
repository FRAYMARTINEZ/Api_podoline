<?php

namespace App\Models;

use App\Models\Scopes\CreatedByScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        'gender_id',
        'office_id',

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
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::addGlobalScope(new CreatedByScope);
    }
}