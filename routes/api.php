<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(MovieController::class)->prefix('/movies')->group(function () {
    Route::get('index','index');
    Route::post('store','store');
    Route::get('/movie/{id}', 'show');
    Route::post('/movie/delete/{id}', 'destroy');
    Route::post('/movie/update/{id}', 'update');
});


Route::controller(SerieController::class)->prefix('/series')->group(function() {
    Route::get('index', 'index');
    Route::post('store', 'store');
    Route::get('/{id}', 'show');
    Route::post('/delete/{id}', 'destroy');
    Route::post('/update/{id}', 'update');
});
