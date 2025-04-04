<?php

use App\Http\Controllers\AttentionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultingOfficeController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\PatientController;
use App\Models\Attention;
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
    $router->post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    $router->post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum')->name('refresh');
    $router->get('/getUserCurrent', [AuthController::class, 'getUserCurrent'])->middleware('auth:sanctum')->name('getUserCurrent');
});

Route::group([
    // 'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'patients'
], function ($router) {
    $router->get('/', [PatientController::class, 'index'])->name('patients.index');
    $router->get('/{id}', [PatientController::class, 'show'])->name('patients.show');
    $router->post('/', [PatientController::class, 'store'])->name('patients.store');
    $router->put('/{id}', [PatientController::class, 'update'])->name('patients.update');
    $router->delete('/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
});

Route::group([
    // 'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'consulting-offices'
], function ($router) {
    $router->get('/', [ConsultingOfficeController::class, 'index'])->name('consulting-offices.index');
    $router->get('/{id}', [ConsultingOfficeController::class, 'show'])->name('consulting-offices.show');
    $router->post('/', [ConsultingOfficeController::class, 'store'])->name('consulting-offices.store');
    $router->put('/{id}', [ConsultingOfficeController::class, 'update'])->name('consulting-offices.update');
    $router->delete('/{id}', [ConsultingOfficeController::class, 'destroy'])->name('consulting-offices.destroy');
});

Route::group([
    'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'data-defaults'
], function ($router) {
    $router->get('/', [DefaultController::class, 'dataDefault'])->name('data-defaults.dataDefault');
    $router->get('/{id}/cities', [DefaultController::class, 'findCity'])->name('data-defaults.findCity');
});


Route::group([
    'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'attentions'
], function ($router) {
    $router->get('/', [AttentionController::class, 'index'])->name('attentions.index');
    $router->get('/{id}', [AttentionController::class, 'show'])->name('attentions.show');
    $router->post('/', [AttentionController::class, 'store'])->name('attentions.store');
    $router->put('/{id}', [AttentionController::class, 'update'])->name('attentions.update');
    $router->delete('/{id}', [AttentionController::class, 'destroy'])->name('attentions.destroy');
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
