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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('navigation', 'NavigationController@index');

    // for getList
    Route::get('perusahaan/getList', 'PerusahaanController@getList');
    Route::get('site/getList', 'SiteController@getList');
    Route::get('sensor/getList', 'SensorController@getList');
    Route::get('user/getList', 'UserController@getList');

    Route::resource('perusahaan', 'PerusahaanController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('site', 'SiteController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('sensor', 'SensorController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('sensorLog', 'SensorLogController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('user', 'UserController')->only(['index', 'store', 'show', 'update', 'destroy']);
});
