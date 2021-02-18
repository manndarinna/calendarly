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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/korisnici', 'PageController@korisnici')->middleware('auth');
Route::get('/casovi', 'PageController@casovi')->middleware('auth');
Route::get('/konsultacije', 'PageController@konsultacije')->middleware('auth');

Route::get('/korisnik/{korisnik}', 'UserController@show')->middleware('auth');
Route::get('/cas/{cas}', 'PrivatanCasController@show')->middleware('auth');

// Route::resource('/korisnik', 'UserController', ['except' => ['create', 'store', 'destroy', 'edit', 'update']])->middleware('auth');
// Route::resource('/privatan-cas', 'PrivatanCasController', ['except' => ['create', 'edit']])->middleware('auth');
// Route::resource('/konsultacija', 'KonsultacijaController', ['except' => ['create', 'edit']])->middleware('auth');
