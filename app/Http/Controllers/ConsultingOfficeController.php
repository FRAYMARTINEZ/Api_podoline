<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultingOfficeRequest;
use App\Http\Requests\UpdateConsultingOfficeRequest;
use App\Services\ConsultingOfficeService;

class ConsultingOfficeController extends Controller
{
    protected $service;

    public function __construct(ConsultingOfficeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/consulting-offices",
     *     summary="List all consulting offices",
     *     tags={"Consultorios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Success"),
     * )
     */
    public function index()
    {
        return $this->service->all();
    }

    /**
     * @OA\Post(
     *     path="/consulting-offices",
     *     summary="Create a consulting office",
     *     tags={"Consultorios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         type="object",
     *         required={"name","city_id", "country_id", "department_id", "address"},
     *         @OA\Property(property="name", type="string", example="Consultorio"),
     *         @OA\Property(property="city_id", type="integer", example=1),
     *         @OA\Property(property="country_id", type="integer", example=2),
     *         @OA\Property(property="department_id", type="integer", example=3),
     *         @OA\Property(property="address", type="string", example="123 Main Street, City, Country")
     *     )
     * ),
     *     @OA\Response(response=201, description="Created"),
     * )
     */
    public function store(StoreConsultingOfficeRequest $request)
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    /**
     * @OA\Get(
     *     path="/consulting-offices/{id}",
     *     summary="Get a consulting office",
     *     tags={"Consultorios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Success"),
     * )
     */
    public function show($id)
    {
        return response()->json($this->service->find($id));
    }

    /**
     * @OA\Put(
     *     path="/consulting-offices/{id}",
     *     summary="Update a consulting office",
     *     tags={"Consultorios"},
     *     security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         type="object",
     *         required={"name","city_id", "country_id", "department_id", "address"},
     *         @OA\Property(property="name", type="string", example="Consultorio XYZ"),
     *         @OA\Property(property="city_id", type="integer", example=1),
     *         @OA\Property(property="country_id", type="integer", example=2),
     *         @OA\Property(property="department_id", type="integer", example=3),
     *         @OA\Property(property="address", type="string", example="123 Main Street, City, Country")
     *     )
     * ),
     *     @OA\Response(response=200, description="Updated"),
     * )
     */
    public function update(UpdateConsultingOfficeRequest $request, $id)
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    /**
     * @OA\Delete(
     *     path="/consulting-offices/{id}",
     *     summary="Delete a consulting office",
     *     tags={"Consultorios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     * )
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
