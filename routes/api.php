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
    Route::delete('/delete/{id}', 'App\Http\Controllers\VehicleController@delete');
    Route::get('/{id}', 'App\Http\Controllers\VehicleController@getById');
});

Route::group([
    'prefix' => 'selling',
], function(){
    Route::get('/', 'App\Http\Controllers\SellingController@showAll');
    Route::get('/motor', 'App\Http\Controllers\SellingController@getByMotor');
    Route::get('/car', 'App\Http\Controllers\SellingController@getByCar');
    Route::get('/available','App\Http\Controllers\SellingController@getStock');
    Route::post('/store', 'App\Http\Controllers\SellingController@store');
    Route::post('/edit/{id}', 'App\Http\Controllers\SellingController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\SellingController@delete');
    Route::get('/{id}', 'App\Http\Controllers\SellingController@getById');
});