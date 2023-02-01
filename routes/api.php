<?php

use App\Http\Controllers\EquipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/equipment/{equipment}', [EquipmentController::class, 'getEquipmentById']);

Route::get('/equipment', [EquipmentController::class, 'getEquipmentPage']);

Route::post('/equipment', [EquipmentController::class, 'createEquipments']);

Route::get('/equipment-type', [EquipmentTypeController::class, 'getEquipmentTypePage']);

Route::delete('/equipment/{equipment}', [EquipmentController::class, 'deleteEquipment']);

Route::put('/equipment/{equipment}', [EquipmentController::class, 'editEquipment']);
