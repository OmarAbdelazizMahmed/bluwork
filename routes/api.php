<?php

use App\Http\Controllers\MinimumStepsController;
use App\Http\Controllers\NumberCountController;
use App\Http\Controllers\StringIndexController;
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


Route::get('/number-count', NumberCountController::class . '@count');

Route::get('/string-index',  StringIndexController::class . '@stringIndex');

Route::get('/minimum-steps',  MinimumStepsController::class . '@minimumSteps');

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', UserController::class . '@register');
    Route::post('/login', UserController::class . '@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/', UserController::class . '@index');
        Route::get('/{user}', UserController::class . '@show');
        Route::put('/{user}', UserController::class . '@update');
        Route::delete('/{user}', UserController::class . '@destroy');
    });
});

