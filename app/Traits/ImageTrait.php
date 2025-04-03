<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

trait ImageTrait
{
    /**
     * Guarda una imagen como WebP y devuelve la ruta
     */
    public function saveWebpImage(
        UploadedFile $image, 
        string $directory = 'images', 
        int $quality = 80, 
        ?int $width = 1200, 
        ?int $height = null
    ): array {
        try {
            // Validar que sea una imagen
            if (!$image->isValid() || !in_array($image->getMimeType(), [
                'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp'
            ])) {
                throw new Exception('Archivo no válido o no es una imagen soportada');
            }

            // Crear un nombre único para la imagen
            $filename = Str::uuid() . '.webp';
            
            // Asegurar que el directorio existe
            $path = $directory . '/' . date('Y/m/d');
            Storage::makeDirectory('public/' . $path);
            
            // Crear el ImageManager (usando GD por defecto)
            $manager = new ImageManager(new Driver());
            
            // Leer la imagen
            $img = $manager->read($image->getRealPath());
            
            // Redimensionar manteniendo la proporción
            if ($width || $height) {
                $img = $img->resize($width, $height);
            }
            
            // Convertir a WebP
            $encodedImage = $img->toWebp($quality);
            
            // Guardar en el storage
            $fullPath = $path . '/' . $filename;
            Storage::put('public/' . $fullPath, $encodedImage->toString());
            
            // Preparar información para guardar en la base de datos
            $imageInfo = [
                'original_name' => $image->getClientOriginalName(),
                'filename' => $filename,
                'path' => $fullPath,
                'full_url' => Storage::url($fullPath),
                'mime_type' => 'image/webp',
                'size' => Storage::size('public/' . $fullPath),
                'width' => $img->width(),
                'height' => $img->height(),
            ];
            
            return $imageInfo;
            
        } catch (Exception $e) {
            // Log del error
            \Log::error('Error al guardar imagen: ' . $e->getMessage());
            throw $e;
        }
    }
}