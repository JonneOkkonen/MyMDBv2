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

Route::get('movies', 'ApiController@all');
Route::get('movie/{id}', 'ApiController@single');
Route::get('movies/update/{id}', 'ApiController@update');
Route::get('movies/delete/{id}', 'ApiController@delete');
Route::get('movies/count', 'ApiController@count');
Route::get('movies/add', 'ApiController@add');

Route::get('test', 'ApiController@test');