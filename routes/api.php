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


Route::middleware('auth:api')->get('/korisnik/get', 'UserController@get');
Route::middleware('auth:api')->get('/korisnik/search', 'UserController@search');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/privatan-cas/get', 'PrivatanCasController@get');
    Route::post('/privatan-cas/post', 'PrivatanCasController@store');
    Route::put('/privatan-cas/put/{cas}', 'PrivatanCasController@update');
    Route::delete('/privatan-cas/delete/{cas}', 'PrivatanCasController@destroy');
});

Route::middleware('auth:api')->get('/rezervacije/casovi', 'RezervacijeController@rezervisaniCasovi');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/konsultacija/get', 'KonsultacijaController@get');
    Route::put('/konsultacija/put/{konsultacija}', 'KonsultacijaController@update');
    Route::post('/konsultacija/post', 'KonsultacijaController@store');
    Route::delete('/konsultacija/delete/{konsultacija}', 'KonsultacijaController@destroy');
});
