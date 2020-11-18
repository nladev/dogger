<?php

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

Route::group([
    'prefix' => 'dogger/api',
    'middleware' => 'api',
    'namespace' => 'Cracki\Dogger\Http\Controllers'
], function () {
    Route::get('/get-all', 'ApiController@getLogs');
    Route::delete('/delete-all', 'ApiController@clearLogs');
});
