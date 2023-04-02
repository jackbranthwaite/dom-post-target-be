<?php

use App\Http\Controllers\DailyLettersController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Public routes

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User routes
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    // Route::patch('/user' . UserController::class, 'update');
    // Letter routes
    Route::middleware('auth:sanctum')->post('/daily-letters', [DailyLettersController::class, 'store']);
    Route::middleware('auth:sanctum')->get('/daily-letters', [DailyLettersController::class, 'show']);
});
