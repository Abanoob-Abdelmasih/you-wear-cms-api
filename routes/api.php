<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/size')->name('size.')->group(function () {
    Route::post('create', [SizeController::class, 'create']);
    Route::get('all', [SizeController::class, 'index']);
    Route::post('{id}/delete', [SizeController::class, 'destroy']);
    Route::post('{id}/update', [SizeController::class, 'update']);
    Route::get('/{id}', [SizeController::class, 'show']);
});

Route::prefix('/color')->name('color.')->group(function () {
    Route::post('create', [ColorController::class, 'create']);
    Route::get('all', [ColorController::class, 'index']);
    Route::post('{id}/delete', [ColorController::class, 'destroy']);
    Route::post('{id}/update', [ColorController::class, 'update']);
    Route::get('/{id}', [ColorController::class, 'show']);
});

Route::get('/test-piv', [SizeController::class,'temp']);
