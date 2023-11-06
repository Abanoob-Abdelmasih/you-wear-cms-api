<?php

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

$data = [
    '1' => "test2", "testmore"
];

Route::prefix('/size')->name('size.')->group(function () use ($data) {
    Route::get('test', function () use ($data) {
        return response()->json($data);
    });

    Route::post('create', [SizeController::class, 'create']);
    Route::get('all', [SizeController::class, 'index']);
});
