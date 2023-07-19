<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TravelCompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TravelTripController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Route for update profile, get user data, and logout
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::get('/me', [UserController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // Route for show list of trip with travel company data
    Route::get('/travels', [TravelTripController::class, 'index']);
    Route::post('/travels/filter/', [TravelTripController::class, 'filter']);

    // Route for show list of travel company data
    Route::get('/travels-company', [TravelCompanyController::class, 'index']);
});
