<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
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

Route::prefix('/product')->name('product.')->group(function () {
    Route::post('create', [ProductController::class, 'create']);
    Route::get('all', [ProductController::class, 'index']);
    Route::post('{id}/delete', [ProductController::class, 'destroy']);
    Route::post('{id}/update', [ProductController::class, 'update']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::get('/test-piv', [SizeController::class, 'many2ManyExamples']);
Route::post('/test-image', [ProductController::class, 'addProduct']);
