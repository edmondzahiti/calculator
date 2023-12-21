<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculatorController;
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


Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::post('/calculate', [CalculatorController::class, 'calculate']);
    Route::get('/history', [CalculatorController::class, 'history']);
});

Route::post('/login', [AuthController::class, 'login']);

