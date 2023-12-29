<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('api')->group(function () {
    Route::get('cordova', [ApiController::class, 'index']);
    Route::post('cordova', [ApiController::class, 'store']);
    Route::put('cordova/{id}', [ApiController::class, 'update']);
    Route::delete('cordova/{id}', [ApiController::class, 'destroy']);
});

