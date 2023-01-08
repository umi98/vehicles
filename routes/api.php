<?php

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

Route::group([
    'prefix' => 'vehicles',
], function(){
    Route::group([
        'prefix' => 'motor'
    ], function(){
        Route::get('/', 'App\Http\Controllers\MotorController@getMotor');
        Route::post('/store', 'App\Http\Controllers\MotorController@addMotor');
        Route::post('/update/{id}', 'App\Http\Controllers\MotorController@update');
        Route::get('/{id}', 'App\Http\Controllers\MotorController@getById');
        Route::delete('/delete/{id}', 'App\Http\Controllers\MotorController@delete');
    });
    Route::group([
        'prefix' => 'car'
    ], function(){
        Route::get('/', 'App\Http\Controllers\CarController@getCar');
        Route::post('/store', 'App\Http\Controllers\CarController@addCar');
        Route::post('/update/{id}', 'App\Http\Controllers\CarController@update');
        Route::get('/{id}', 'App\Http\Controllers\CarController@getById');
        Route::delete('/delete/{id}', 'App\Http\Controllers\CarController@delete');
    });
    Route::get('/', 'App\Http\Controllers\VehicleController@showAll');
    Route::post('/update/{id}', 'App\Http\Controllers\VehicleController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\VehicleController@delete');
    Route::get('/{id}', 'App\Http\Controllers\VehicleController@getById');
});
