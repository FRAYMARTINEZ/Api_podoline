<?php

namespace App\Models;

use App\Models\Scopes\CreatedByScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AttentionPatient extends Model
{
    use SoftDeletes;
    protected $table = 'attention_patients';

    protected $fillable = ['patient_id', 'attention_id'];

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
