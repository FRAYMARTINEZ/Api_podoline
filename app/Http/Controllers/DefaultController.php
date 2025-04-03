<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefaultRequest;
use App\Services\DefaultService;
use Illuminate\Http\JsonResponse;

class DefaultController extends Controller
{

    protected $defaultService;

    public function __construct(DefaultService $defaultService)
    {
        $this->defaultService = $defaultService;
    }

    /**
     * @OA\Get(
     *     path="/data-defaults",
     *     summary="Obtener datos por defecto",
     *     tags={"Default"},
     *     @OA\Response(
     *         response=200,
     *         description="Datos por defecto obtenidos exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="countries", type="array", @OA\Items(type="string")),
     *             @OA\Property(property="departments", type="array", @OA\Items(type="string")),
     *             @OA\Property(property="cities", type="array", @OA\Items(type="string"))
     *         )
     *     )
     * )
     */
    public function dataDefault(): JsonResponse
    {
        return response()->json($this->defaultService->defaultData());
    }

    /**
     * @OA\Get(
     *     path="/data-defaults/{department_id}/cities",
     *     summary="Buscar ciudades por departamento",
     *     tags={"Default"},
     *     @OA\Parameter(
     *         name="department_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del departamento"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ciudades obtenidas exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validación fallida",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="department_id", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     )
     * )
     */
    public function findCity(int $department_id): JsonResponse
    {
        return response()->json($this->defaultService->findCity($department_id));
    }
}
