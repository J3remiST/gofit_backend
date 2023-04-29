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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/promos', \App\Http\Controllers\Api\PromoController::class);
Route::post('/login', 'App\Http\Controllers\API\AuthController@login');

Route::get('/instruktur', 'App\Http\Controllers\API\InstrukturController@index');
Route::get('/instruktur/{id_instruktur}', 'App\Http\Controllers\API\InstrukturController@show');
Route::post('/instruktur', 'App\Http\Controllers\API\InstrukturController@store');
Route::delete('/instruktur/{id_instruktur}', 'App\Http\Controllers\API\InstrukturController@destroy');
Route::put('/instruktur/{id_instruktur}', 'App\Http\Controllers\API\InstrukturController@update');


Route::get('/member', 'App\Http\Controllers\API\MemberController@index');
Route::get('/member/{id_member}', 'App\Http\Controllers\API\MemberController@show');
Route::post('/member', 'App\Http\Controllers\API\MemberController@store');
Route::delete('/member/{id_member}', 'App\Http\Controllers\API\MemberController@destroy');
Route::put('/member/{id_member}', 'App\Http\Controllers\API\MemberController@update');

Route::get('/jadwal_umum', 'App\Http\Controllers\API\JadwalUmumController@index');
Route::get('/jadwal_umum/{id_jadwal_umum}', 'App\Http\Controllers\API\JadwalUmumController@show');
Route::post('/jadwal_umum', 'App\Http\Controllers\API\JadwalUmumController@store');
Route::delete('/jadwal_umum/{id_jadwal_umum}', 'App\Http\Controllers\API\JadwalUmumController@destroy');
Route::put('/jadwal_umum/{id_instruktur}', 'App\Http\Controllers\API\JadwalUmumController@update');