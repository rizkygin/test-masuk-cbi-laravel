<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\JabatanApiController;
use App\Http\Controllers\Api\KaryawanApiController;
use App\Http\Controllers\Api\DepartemenApiController;
use App\Http\Controllers\Api\AbsentApiController;
use App\Http\Controllers\Api\PermitApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthApiController::class , 'register']);
Route::post('/login', [AuthApiController::class , 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthApiController::class , 'logout']);
});


Route::apiResource('/employee', KaryawanApiController::class)->middleware('auth:sanctum');
Route::apiResource('/position', JabatanApiController::class)->middleware('auth:sanctum', 'admin');
Route::apiResource('/departments', DepartemenApiController::class)->middleware('auth:sanctum', 'admin');
Route::apiResource('/absent', AbsentApiController::class)->middleware('auth:sanctum');
Route::apiResource('/permit', PermitApiController::class)->middleware('auth:sanctum');