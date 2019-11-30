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

// Sessions Page
Route::get('/session', 'HomeController@session')->name('session');
Route::post('/session', 'HomeController@session_delete');

// Movies Page
Route::get('/movies', 'MovieController@view')->name('movies');

// Add Movies
Route::get('/movies/add', 'MovieController@add')->name('addMovie');

// Movie Detail Page
Route::get('/movies/{id}', 'MovieController@detail');

// Movie Edit Page
Route::get('/movies/edit/{id}', 'MovieController@edit');

// Change Password
Route::get('/changePassword', 'Auth\ChangePasswordController@show')->name('cPassword');
Route::post('/changePassword', 'Auth\ChangePasswordController@change');