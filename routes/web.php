<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AsteroidController;

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

Route::get('/', [AsteroidController::class, 'index']);
Route::post('/get-asteroid-details', [AsteroidController::class, 'getAsteroidDetails']);
