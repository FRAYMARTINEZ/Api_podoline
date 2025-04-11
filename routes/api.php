<?php

use App\Http\Controllers\AttentionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultingOfficeController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\PatientController;
//use App\Http\Controllers\UserContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\CitiesController;
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
    $router->post('/register', [AuthController::class, 'register'])->middleware(['auth:sanctum', 'role:Administrador'])->name('register');
    $router->post('/login', [AuthController::class, 'login'])->name('login');
    $router->post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    $router->post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum')->name('refresh');
    $router->get('/getUserCurrent', [AuthController::class, 'getUserCurrent'])->middleware('auth:sanctum')->name('getUserCurrent');
});

Route::group([
    'prefix' => 'users'
], function ($router) {
    $router->get('/', [UserController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('users.index');
    $router->put('/{id}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('users.update');
    $router->delete('/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('users.destroy');
    $router->get('/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('users.show');
    $router->put('/restore/{id}', [UserController::class, 'restore'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('users.restore');
});

//el api
Route::group([
    'prefix' => 'patients'
], function ($router) {
    $router->get('/', [PatientController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('patients.index');
    $router->get('/{id}', [PatientController::class, 'show'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('patients.show');
    $router->post('/', [PatientController::class, 'store'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('patients.store');
    $router->put('/{id}', [PatientController::class, 'update'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('patients.update');
    $router->delete('/{id}', [PatientController::class, 'destroy'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('patients.destroy');
    $router->get('/{search}/{type?}', [PatientController::class, 'searchPatientAttention'])->middleware(['auth:sanctum'])->name('patients.searchPatientAttention');
    $router->put('/restore/{id}', [PatientController::class, 'restore'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('patients.restore');
});

Route::group([
    'prefix' => 'consulting-offices'
], function ($router) {
    $router->get('/', [ConsultingOfficeController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('consulting-offices.index');
    $router->get('/{id}', [ConsultingOfficeController::class, 'show'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('consulting-offices.show');
    $router->post('/', [ConsultingOfficeController::class, 'store'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('consulting-offices.store');
    $router->put('/{id}', [ConsultingOfficeController::class, 'update'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('consulting-offices.update');
    $router->delete('/{id}', [ConsultingOfficeController::class, 'destroy'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('consulting-offices.destroy');
    $router->put('/restore/{id}', [ConsultingOfficeController::class, 'restore'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('consulting-offices.restore');
});

Route::group([
    'prefix' => 'territories'
], function ($router) {
    $router->get('/countries', [CountryController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('countries.index');
    $router->get('/departments', [DepartmentsController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('departments.index');
    $router->get('/cities', [CitiesController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('cities.index');
});

Route::group([
    'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'data-defaults'
], function ($router) {
    $router->get('/', [DefaultController::class, 'dataDefault'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('data-defaults.dataDefault');
    $router->get('/{id}/cities', [DefaultController::class, 'findCity'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('data-defaults.findCity');
});


Route::group([
    'middleware' => ['api', 'handle_exceptions'],
    'prefix' => 'attentions'
], function ($router) {
    $router->get('/', [AttentionController::class, 'index'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('attentions.index');
    $router->get('/{id}', [AttentionController::class, 'show'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('attentions.show');
    $router->post('/', [AttentionController::class, 'store'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1|Profesional2'])->name('attentions.store');
    $router->put('/{id}', [AttentionController::class, 'update'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('attentions.update');
    $router->delete('/{id}', [AttentionController::class, 'destroy'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('attentions.destroy');
    $router->put('/restore/{id}', [ConsultingOfficeController::class, 'restore'])->middleware(['auth:sanctum', 'role:Administrador|Profesional1'])->name('attentions.restore');
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