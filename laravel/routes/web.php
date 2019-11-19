<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// FrontPage (without login)
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Auth::routes();

// HomePage (after login)
Route::get('/home', 'HomeController@index')->name('home');

// Movie Pages
Route::get('/movies', 'MovieController@view')->name('movies');
