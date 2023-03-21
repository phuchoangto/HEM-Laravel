<?php

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

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/events', [App\Http\Controllers\Api\EventController::class, 'getAll']);
    Route::get('/events/{id}', [App\Http\Controllers\Api\EventController::class, 'get']);
    Route::post('/events/{id}/check-in', [App\Http\Controllers\Api\EventController::class, 'checkIn']);
});