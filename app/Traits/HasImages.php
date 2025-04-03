<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages
{
    /**
     * Obtener todas las imágenes asociadas al modelo
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'model');
    }

    /**
     * Obtener la imagen destacada (la primera)
     */
    public function featuredImage()
    {
        return $this->images()->first();
    }

    /**
     * Obtener la URL de la imagen destacada o una imagen por defecto
     */
    public function getImageUrlAttribute()
    {
        $image = $this->featuredImage();
        return $image ? $image->full_url : '/img/default.webp';
    }
}
