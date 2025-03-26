<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *     openapi="3.0.0",
 *     @OA\Info(
 *         title="API de GreenCupones App y movil",
 *         version="1.0.0",
 *         description="Documentación de la API para gestionar productos y ventas"
 *     ),
 *     @OA\Server(url="http://localhost:8000/api/")
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Token de autenticación para acceder a la API"
 * )
 */
class OpenApi
{
    // Este archivo se utiliza únicamente para definir la configuración OpenAPI.
}
