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
    Route::get('/', 'App\Http\Controllers\VehicleController@showAll');
    Route::get('/motor/', 'App\Http\Controllers\MotorController@getAll');
    // Route::post('/store', 'App\Http\Controllers\VehicleController@store');
    Route::post('/motor/store', 'App\Http\Controllers\MotorController@addMotor');
    Route::post('/update/{id}', 'App\Http\Controllers\VehicleController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\VehicleController@delete');
    Route::get('/{id}', 'App\Http\Controllers\VehicleController@getById');
});
