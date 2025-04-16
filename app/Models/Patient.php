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
