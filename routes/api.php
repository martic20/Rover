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

Route::group(['prefix'=>'rover', 'namespace' => 'Src\BoundedContext\Mars\Infrastructure\Controllers'], function()
{
    Route::get('init', InitRoverController::class);
    Route::get('get', GetRoverController::class);
    Route::get('move', MoveRoverController::class);
});