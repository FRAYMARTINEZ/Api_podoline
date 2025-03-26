<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use L5Swagger\Http\Controllers\SwaggerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'auth'
], function ($router) {
    $router->post('/register', [AuthController::class, 'register'])->name('register');
    $router->post('/login', [AuthController::class, 'login'])->name('login');
    $router->post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    $router->post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    $router->get('/getUserCurrent', [AuthController::class, 'getUserCurrent'])->middleware('auth:api')->name('getUserCurrent');
});



/*
Ejemplo de como validar rutas con rol o permiso

Route::group(['middleware' => ['api', 'role:admin']], function ($router) {
    $router->get('/getUserCurrent', [AuthController::class, 'getUserCurrent'])->middleware('auth:api')->name('getUserCurrentP');
    // Other routes only accessible by admins
});

Route::group(['middleware' => ['api', 'permission:view articles']], function ($router) {
    $router->get('/getUserCurrent', [AuthController::class, 'getUserCurrent'])->middleware('auth:api')->name('getUserCurrent');
    // Other routes only accessible by admins
});

*/
