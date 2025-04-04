<?php

namespace App\Http\Controllers;

use App\Models\Attention;
use App\Http\Requests\StoreAttentionRequest;
use App\Http\Requests\UpdateAttentionRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Services\AttentionService;
use Illuminate\Http\Request;

class AttentionController extends Controller
{

    protected $serviceAttention;

    public function __construct(AttentionService $serviceAttention)
    {
        $this->serviceAttention = $serviceAttention;
    }

    /**
     * @OA\Get(
     *     path="/attentions",
     *     tags={"Atención"},
     *     summary="Listar todas las atenciones",
     *     @OA\Response(
     *         response=200,
     *         description="Listado exitoso"
     *     )
     * )
     */
    public function index(Request $request)
    {
        return $this->serviceAttention->all($request);
    }

    /**
     * @OA\Post(
     *     path="/attentions",
     *     tags={"Atención"},
     *     summary="Crear una atención",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id","appointment_date","shoe_size","footstep_type_left","footstep_type_right","foot_type_left","foot_type_right","heel_type_left","heel_type_right"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="appointment_date", type="string", format="date", example="2025-04-04"),
     *             @OA\Property(property="shoe_size", type="number", format="float", example=42),
     *             @OA\Property(property="footstep_type_left", type="string", example="Pronador"),
     *             @OA\Property(property="footstep_type_right", type="string", example="Supinador"),
     *             @OA\Property(property="foot_type_left", type="string", example="Plano"),
     *             @OA\Property(property="foot_type_right", type="string", example="Normal"),
     *             @OA\Property(property="heel_type_left", type="string", example="Neutro"),
     *             @OA\Property(property="heel_type_right", type="string", example="Pronador"),
     *             @OA\Property(property="observations", type="string", example="Paciente presenta leve desviación..."),
     *             @OA\Property(property="back_standing_up_image", type="string", format="binary"),
     *             @OA\Property(property="back_45_image", type="string", format="binary"),
     *             @OA\Property(property="back_toes_up_image", type="string", format="binary"),
     *             @OA\Property(property="from_chaplin_image", type="string", format="binary"),
     *             @OA\Property(property="from_chaplin_toes_up_image", type="string", format="binary"),
     *             @OA\Property(property="with_insoles_image", type="string", format="binary"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Atención creada exitosamente"
     *     )
     * )
     */
    public function store(StoreAttentionRequest $request)
    {
        $request->validated(); // Validar los datos de la solicitud
        return $this->serviceAttention->store($request);
    }

    /**
     * @OA\Get(
     *     path="/attentions/{id}",
     *     tags={"Atención"},
     *     summary="Obtener una atención específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la atención",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalle de la atención"
     *     )
     * )
     */
    public function show(int $id)
    {
        return $this->serviceAttention->find($id);
    }

    /**
     * @OA\Post(
     *     path="/attentions/{id}",
     *     tags={"Atención"},
     *     summary="Actualizar una atención",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la atención a actualizar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="appointment_date", type="string", format="date", example="2025-04-04"),
     *             @OA\Property(property="shoe_size", type="number", format="float", example=42),
     *             @OA\Property(property="footstep_type_left", type="string", example="Pronador"),
     *             @OA\Property(property="footstep_type_right", type="string", example="Supinador"),
     *             @OA\Property(property="foot_type_left", type="string", example="Plano"),
     *             @OA\Property(property="foot_type_right", type="string", example="Normal"),
     *             @OA\Property(property="heel_type_left", type="string", example="Neutro"),
     *             @OA\Property(property="heel_type_right", type="string", example="Pronador"),
     *             @OA\Property(property="observations", type="string", example="Paciente presenta leve desviación..."),
     *             @OA\Property(property="back_standing_up_image", type="string", format="binary"),
     *             @OA\Property(property="back_45_image", type="string", format="binary"),
     *             @OA\Property(property="back_toes_up_image", type="string", format="binary"),
     *             @OA\Property(property="from_chaplin_image", type="string", format="binary"),
     *             @OA\Property(property="from_chaplin_toes_up_image", type="string", format="binary"),
     *             @OA\Property(property="with_insoles_image", type="string", format="binary"),
     *             @OA\Property(property="_method", type="string", example="PUT"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Atención actualizada correctamente"
     *     )
     * )
     */
    public function update(StoreAttentionRequest $request, int $id)
    {
        $request->validated(); // Validar los datos de la solicitud
        return $this->serviceAttention->update($id, $request);
    }

    /**
     * @OA\Delete(
     *     path="/attentions/{id}",
     *     tags={"Atención"},
     *     summary="Eliminar una atención",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la atención a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Eliminación exitosa"
     *     )
     * )
     */
    public function destroy(int $id)
    {
        return $this->serviceAttention->delete($id);
    }
}
