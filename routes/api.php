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
    return response()->json([
        'test' => "tes"
    ]);
});
Route::middleware('auth:api')->get('/korisnik/get', 'UserController@get');

Route::middleware('auth:api')->get('/privatan-cas/get', 'PrivatanCasController@get');
Route::middleware('auth:api')->post('/privatan-cas/post', 'PrivatanCasController@store');
Route::middleware('auth:api')->put('/privatan-cas/put/{test}', 'PrivatanCasController@update');

Route::middleware('auth:api')->get('/konsultacija/get', 'KonsultacijaController@get');
Route::middleware('auth:api')->put('/konsultacija/put/{konsultacija}', 'KonsultacijaController@update');
