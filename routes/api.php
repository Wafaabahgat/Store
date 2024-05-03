<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// all apis/Routes her must be apis authenticated

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::post(uri:'get-main-categories', action: 'CategoriesController@index');
});
