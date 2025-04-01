<?php

// Controlador
namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Services\PatientService;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * @OA\Get(
     *     path="/patients",
     *     tags={"Pacientes"},
     *     summary="Obtener todos los pacientes",
     *     @OA\Response(response=200, description="Lista de pacientes")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->patientService->getAllPatients());
    }

    /**
     * @OA\Get(
     *     path="/patients/{id}",
     *     tags={"Pacientes"},
     *     summary="Obtener un paciente por ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Paciente encontrado"),
     *     @OA\Response(response=404, description="Paciente no encontrado")
     * )
     */
    public function show(int $id): JsonResponse
    {
        $patient = $this->patientService->getPatientById($id);
        return $patient ? response()->json($patient) : response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    /**
     * @OA\Post(
     *     path="/patients",
     *     tags={"Pacientes"},
     *     summary="Crear un nuevo paciente",
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         required={"name", "last_name", "type_document", "number_document", "date_of_birth", "email", "cellphone"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="last_name", type="string"),
     *         @OA\Property(property="type_document", type="string"),
     *         @OA\Property(property="number_document", type="string"),
     *         @OA\Property(property="date_of_birth", type="string", format="date"),
     *         @OA\Property(property="email", type="string", format="email"),
     *         @OA\Property(property="cellphone", type="string")
     *     )),
     *     @OA\Response(response=201, description="Paciente creado")
     * )
     */
    public function store(StorePatientRequest $request): JsonResponse
    {
        $data = $request->validated();
        $patient = $this->patientService->createPatient($data);
        return response()->json($patient, 201);
    }

    /**
     * @OA\Put(
     *     path="/patients/{id}",
     *     summary="Actualizar un paciente",
     *     tags={"Pacientes"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="last_name", type="string"),
     *         @OA\Property(property="type_document", type="string"),
     *         @OA\Property(property="number_document", type="string"),
     *         @OA\Property(property="date_of_birth", type="string", format="date"),
     *         @OA\Property(property="email", type="string", format="email"),
     *         @OA\Property(property="cellphone", type="string")
     *     )),
     *     @OA\Response(response=200, description="Paciente actualizado"),
     *     @OA\Response(response=404, description="Paciente no encontrado")
     * )
     */
    public function update(StorePatientRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $patient = $this->patientService->updatePatient($id, $data);
        return $patient ? response()->json($patient) : response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/patients/{id}",
     *     tags={"Pacientes"},
     *     summary="Eliminar un paciente",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Paciente eliminado"),
     *     @OA\Response(response=404, description="Paciente no encontrado")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->patientService->deletePatient($id)
            ? response()->json(['message' => 'Paciente eliminado'])
            : response()->json(['error' => 'Paciente no encontrado'], 404);
    }
}
