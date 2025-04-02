<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * @OA\Post(
     *     path="/auth/register",
     *     summary="Registrar un nuevo usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario registrado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-04T15:04:05Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-04T15:04:05Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos de entrada no válidos"
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());

        return response()->json($user, 201);
    }
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Iniciar sesión de usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales no válidas"
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {

        $token = $this->authService->login($request->validated(), $request->ip(), $request->device_name);

        return response()->json($token);
    }
    /**
     * @OA\Get(
     *     path="/auth/getUserCurrent",
     *     summary="Obtener el usuario autenticado actual",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Datos del usuario autenticado",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */


    public function getUserCurrent(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $user = $this->authService->getUserCurrent();

        return response()->json($user);
    }
    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="Cerrar sesión del usuario autenticado",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Cierre de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Desautenticación con éxito")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'Desautenticación con éxito']);
    }
    /**
     *
     * @OA\Post(
     *     path="/auth/refresh",
     *     summary="Cerrar sesión del usuario autenticado",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Respuesta exitosa con el token de acceso",
     *         @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="access_token", type="string", description="Token de acceso JWT"),
     *            @OA\Property(property="token_type", type="string", description="Tipo de token, generalmente 'bearer'"),
     *            @OA\Property(property="expires_in", type="integer", description="Tiempo de expiración del token en segundos")
     *          )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     *   )
     */
    public function refresh(Request $request): JsonResponse
    {
        $token = $this->authService->refresh($request);
        return $token;
    }
}
