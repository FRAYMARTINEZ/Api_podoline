<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Attention;
use App\Models\AttentionPatient;
use App\Models\Image;
use App\Repositories\Contracts\AttentionRepositoryInterface;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttentionRepository implements AttentionRepositoryInterface
{
    use ImageTrait;
    public function all()
    {
        return Attention::with('images')->paginate(15); 
    }

    public function find(int $id)
    {
        $attention = Attention::with(['images', 'patients'])->findOrFail($id);

        if (!$attention) {
            throw new NotFoundException("El Id ingresado no conside, con ninguna atención");
        }
        return $attention;
    }
    public function store(Request $request)
    {
        // Obtener solo los datos necesarios
        $data = $request->only([
            'patient_id',
            'appointment_date', // Fecha de atención
            'shoe_size', // Talla de zapato
            'footstep_type_left', // Tipo pisada Izq
            'footstep_type_right', // Tipo pisada Der
            'foot_type_left', // Tipo Pie Izq
            'foot_type_right', // Tipo Pie Der
            'heel_type_left', // Tipo Talón Izq
            'heel_type_right', // Tipo Talón Der
            'observations' // Observaciones
        ]);

        $images = $request->only([
            'back_standing_up_image',
            'back_45_image',
            'back_toes_up_image',
            'from_chaplin_image',
            'from_chaplin_toes_up_image',
            'with_insoles_image',
        ]);

        try {
            // Iniciar la transacción
            DB::beginTransaction();

            // Guardar la atención
            $attention = Attention::create($data);

            // Guardar imágenes
            foreach (array_keys($images) as $key) {
                if ($request->hasFile($key)) {
                    $imageInfo = $this->saveWebpImage(
                        $request->file($key),
                        "attentions/$attention->id/$key", // Directorio
                        80, // Calidad
                        800 // Ancho máximo
                    );

                    // Guardar información en la BD
                    $image = new Image($imageInfo);
                    $attention->images()->save($image); // Relación 'images' en el modelo Attention
                }
            }

            AttentionPatient::create([
                'attention_id' => $attention->id,
                'patient_id' => $data['patient_id'],
            ]);

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Atención creada correctamente.']);
        } catch (\Exception $e) {
            // Si hay un error, deshacer cambios
            DB::rollBack();

            return response()->json(['error' => 'Error al guardar la atención: ' . $e->getMessage()]);
        }
    }

    public function update(int $id, Request $request)
    {
        $data = $request->only([
            'appointment_date',
            'shoe_size',
            'footstep_type_left',
            'footstep_type_right',
            'foot_type_left',
            'foot_type_right',
            'heel_type_left',
            'heel_type_right',
            'observations'
        ]);

        $imageKeys = [
            'back_standing_up_image',
            'back_45_image',
            'back_toes_up_image',
            'from_chaplin_image',
            'from_chaplin_toes_up_image',
            'with_insoles_image',
        ];

        try {
            DB::beginTransaction();
            $attention = Attention::with('images')->find($id);
            // Actualiza los campos del modelo
            $attention->update($data);

            foreach ($imageKeys as $key) {

                if ($request->hasFile($key)) {

                    foreach ($attention->images as $image) {

                        if (Str::contains($image->path, $key)) {
                            if (Storage::exists('public/' . $image->path)) {
                                Storage::delete('public/' . $image->path);
                            }
                            $image->delete();
                        }
                    }

                    $imageInfo = $this->saveWebpImage(
                        $request->file($key),
                        "attentions/$attention->id/$key", // carpeta destino
                        80, // calidad
                        800 // ancho
                    );

                    $attention->images()->create($imageInfo);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Atención actualizada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar la atención: ' . $e->getMessage()]);
        }
    }

    public function delete(int $id)
    {
        return Attention::destroy($id);
    }
}
