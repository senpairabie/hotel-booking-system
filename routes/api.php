<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RoomsController;
use App\Http\Controllers\Api\ReservationsController;
use App\Http\Controllers\API\PassportAuthController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [PassportAuthController::class, 'getDetails']);

    Route::resource('users', UsersController::class);
    Route::resource('rooms', RoomsController::class);
    Route::resource('reservations', ReservationsController::class);

});

