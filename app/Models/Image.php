<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'original_name',
        'filename',
        'path',
        'full_url',
        'mime_type',
        'size',
        'width',
        'height',
        'model_type',
        'model_id',
    ];

    // Relación polimórfica para conectar la imagen a cualquier modelo
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
    
}