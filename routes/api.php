<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/metric_param', 'ProvidedMetricController@addRemoveParam');
Route::get('/fetch_metrics', 'MetricsController@fetchMetrics');
Route::middleware('auth:api')->get('/add_metrics', 'MetricsController@addMetrics');
