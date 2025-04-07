<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener todos los usuarios",
     *     @OA\Response(response=200, description="Lista de usuarios")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->authService->all());
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener un usuario por ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Paciente encontrado"),
     *     @OA\Response(response=404, description="Paciente no encontrado")
     * )
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->authService->find($id);
        return $user ? response()->json($user) : response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Actualizar un usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John"),
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="office_id", type="number", example=1),
     *             @OA\Property(property="role", type="string", example="Seleccionar uno de estos: Administrador, Profesional1, Profesional2"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123")
     *     )),
     *     @OA\Response(response=200, description="Usuario actualizado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function update(RegisterRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $patient = $this->authService->update($id, $data);
        return $patient ? response()->json($patient) : response()->json(['error' => 'Usuario no encontrado'], 404);
    }


    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     summary="Eliminar un usuario",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Usuario eliminado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->authService->delete($id)
            ? response()->json(['message' => 'Usuario eliminado'])
            : response()->json(['error' => 'Usuario no encontrado'], 404);
    }


    /**
     * @OA\Put(
     *     path="/users/restore/{id}",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     summary="Activar un usuario",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Usuario activo"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function restore(int $id): JsonResponse
    {
        return $this->authService->restore($id)
            ? response()->json(['message' => 'Usuario activado'])
            : response()->json(['error' => 'Usuario no encontrado'], 404);
    }
}
