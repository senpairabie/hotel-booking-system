<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [RoomsController::class, 'index']);

Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'authenticate']);
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/front.index', function () {
    return view('front.index');
})->middleware('auth');

Route::resource('users', UsersController::class);
Route::resource('rooms', RoomsController::class);
Route::resource('reservations', ReservationsController::class);
