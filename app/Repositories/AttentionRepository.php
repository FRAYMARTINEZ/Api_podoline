<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Attention;
use App\Models\Image;
use App\Repositories\Contracts\AttentionRepositoryInterface;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttentionRepository implements AttentionRepositoryInterface
{
    use ImageTrait;
    public function all()
    {
        return Attention::with('images')->get();
    }

    public function find($id)
    {
        $attention = Attention::with('images')->find($id);
        if (!$attention) {
            throw new NotFoundException("El Id ingresado no conside, con ninguna atención");
        }
        return $attention;
    }
    public function store(Request $request)
    {
        // Obtener solo los datos necesarios
        $data = $request->only([
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
                        "attentions/$key", // Directorio
                        80, // Calidad
                        800 // Ancho máximo
                    );

                    // Guardar información en la BD
                    $image = new Image($imageInfo);
                    $attention->images()->save($image); // Relación 'images' en el modelo Attention
                }
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Atención creada correctamente.']);
        } catch (\Exception $e) {
            // Si hay un error, deshacer cambios
            DB::rollBack();

            return response()->json(['error' => 'Error al guardar la atención: ' . $e->getMessage()]);
        }
    }

    public function update($id, Request $data)
    {
        $office = Attention::findOrFail($id);
        $office->update($data);
        return $office;
    }

    public function delete($id)
    {
        return Attention::destroy($id);
    }
}
