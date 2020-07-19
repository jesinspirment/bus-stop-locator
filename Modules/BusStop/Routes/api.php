<?php

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

// Route to get nearest bus stops based on current user coordinates
Route::middleware('auth:api')
    ->get('/bus-stop/nearest', 'NearestLocator\NearestStopsAction')
    ->name('nearest-bus-stops');

Route::middleware('auth:api')
    ->post('/bus-stop/{busStopId}/add-bus', 'Bus\AddBus')
    ->name('add-bus');