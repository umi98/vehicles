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
    'prefix' => 'auth'
], function(){
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('api.login');
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('api.logout');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh')->name('api.refresh');
        Route::get('data', 'App\Http\Controllers\AuthController@data')->name('api.data');
    });
});

Route::group([
    'prefix' => 'vehicles',
], function(){
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::group([
            'prefix' => 'motor'
        ], function(){
            Route::get('/', 'App\Http\Controllers\MotorController@getMotor')->name('motor.show');
            Route::post('/store', 'App\Http\Controllers\MotorController@addMotor')->name('motor.store');
            Route::post('/update/{id}', 'App\Http\Controllers\MotorController@update')->name('motor.update');
            Route::get('/{id}', 'App\Http\Controllers\MotorController@getById')->name('motor.detail');
            Route::delete('/delete/{id}', 'App\Http\Controllers\MotorController@delete')->name('motor.delete');
        });
        Route::group([
            'prefix' => 'car'
        ], function(){
            Route::get('/', 'App\Http\Controllers\CarController@getCar')->name('car.show');
            Route::post('/store', 'App\Http\Controllers\CarController@addCar')->name('car.store');
            Route::post('/update/{id}', 'App\Http\Controllers\CarController@update')->name('car.update');
            Route::get('/{id}', 'App\Http\Controllers\CarController@getById')->name('car.detail');
            Route::delete('/delete/{id}', 'App\Http\Controllers\CarController@delete')->name('car.delete');
        });
        Route::get('/', 'App\Http\Controllers\VehicleController@showAll')->name('vehicle.show');
        Route::delete('/delete/{id}', 'App\Http\Controllers\VehicleController@delete')->name('vehicle.delete');
        Route::get('/{id}', 'App\Http\Controllers\VehicleController@getById')->name('vehicle.detail');        
    });
});

Route::group([
    'prefix' => 'selling',
], function(){
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::get('/', 'App\Http\Controllers\SellingController@showAll')->name('selling.show');
        Route::get('/motor', 'App\Http\Controllers\SellingController@getByMotor')->name('selling.motor');
        Route::get('/car', 'App\Http\Controllers\SellingController@getByCar')->name('selling.car');
        Route::get('/available','App\Http\Controllers\SellingController@getStock')->name('selling.available');
        Route::post('/store', 'App\Http\Controllers\SellingController@store')->name('selling.store');
        Route::post('/edit/{id}', 'App\Http\Controllers\SellingController@update')->name('selling.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\SellingController@delete')->name('selling.delete');
        Route::get('/{id}', 'App\Http\Controllers\SellingController@getById')->name('selling.detail');
    });
});