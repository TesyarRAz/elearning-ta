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

Route::get('/user', 'UserController@index');
Route::post('/login', 'UserController@login');

Route::apiResource('modul', 'ModulController')->only(['index', 'show']);
Route::get('/pelajaran', 'PelajaranController@index');

Route::prefix('modul/{modul}')->group(function() {
	Route::apiResource('materi', 'MateriController')->only(['index', 'show']);
	Route::apiResource('tes', 'TesController')->only(['index', 'show'])->parameter('tes', 'tes');
});

Route::middleware(['auth:api', 'can:user_siswa'])->group(function() {
	Route::get('/nilai', 'NilaiController@index');
});