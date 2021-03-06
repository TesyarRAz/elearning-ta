<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login', 'UserController@showLogin')->name('login');
Route::post('login', 'UserController@login')->name('postLogin');

Route::get('register', 'UserController@showRegister')->name('register');
Route::post('register', 'UserController@register')->name('postRegister');

Route::get('verify/{user:username}', 'UserController@verify')->name('verify');

Route::post('logout', 'UserController@logout')->name('logout');

Route::middleware(['auth', 'verified:login'])->group(function() {
	Route::name('home')->get('/', 'HomeController@index');
	
	Route::prefix('guru')->name('guru.')->namespace('Guru')->group(function() {
		Route::name('index')->get('/', 'HomeController@index');
		Route::name('profile')->get('/profile', 'HomeController@profile');

		Route::resource('modul', 'ModulController');
		Route::post('modul/data', 'ModulController@data')->name('modul.data');
		Route::get('modul/{modul}/export', 'ModulController@export')->name('modul.export');

		Route::prefix('modul/{modul}')->group(function() {

			Route::resource('materi', 'MateriController');
			Route::post('materi/data', 'MateriController@data')->name('materi.data');

			Route::resource('tes', 'TesController')->parameter('tes', 'tes');
			Route::post('tes/data', 'TesController@data')->name('tes.data');

			Route::resource('quiz', 'QuizController');
			Route::post('quiz/data', 'QuizController@data')->name('quiz.data');
		});

		Route::resource('banksoal', 'BankSoalController')->parameter('banksoal', 'bankSoal');
		Route::post('banksoal/data', 'BankSoalController@data')->name('banksoal.data');

		Route::prefix('banksoal/{bankSoal}')->group(function() {
			Route::resource('soal', 'SoalController');
			Route::post('soal/data', 'SoalController@data')->name('soal.data');
		});

		Route::prefix('nilai')->name('nilai.')->group(function() {
			Route::name('tes')->get('tes', 'NilaiController@tes');
			Route::name('quiz')->get('quiz', 'NilaiController@quiz');
			Route::name('quiz.show')->get('quiz/{siswa}', 'NilaiController@showQuiz');
			Route::name('quiz.store')->post('quiz/{siswa}', 'NilaiController@postQuiz');
		});
	});

	// Route::namespace('Siswa')->get('siswa/{any}', 'HomeController@index')->where('any', '.*');

	Route::prefix('siswa')->name('siswa.')->namespace('Siswa')->group(function() {
		Route::name('index')->get('/', 'HomeController@index');
		Route::name('profile')->get('/profile', 'HomeController@profile');

		Route::name('materi.index')->get('/materi/{modul}', 'MateriController@index');
		Route::name('materi.show')->get('/materi/{modul}/learn/{materi}', 'MateriController@show');
		Route::name('materi.mark')->get('/materi/mark/{materi}', 'MateriController@mark');
		Route::name('materi.unmark')->get('/materi/unmark/{materi}', 'MateriController@unmark');

		Route::name('modul.index')->get('/modul/follow', 'ModulController@index');
		Route::name('modul.follow')->get('/modul/follow/{modul}', 'ModulController@follow');
		Route::name('modul.unfollow')->get('/modul/unfolow/{modul}', 'ModulController@unfollow');

		Route::name('tes.index')->get('/tes/{modul}', 'TesController@index');
		Route::name('tes.show')->get('/tes/join/{tes}', 'TesController@show');

		Route::name('tes.start')->get('/tes/start/{tes}', 'TesController@store');
		Route::name('tes.edit')->get('/tes/work/{tes}/{siswa_tes}', 'TesController@edit');
		Route::name('tes.update')->post('/tes/update/{tes}/{siswa_tes}', 'TesController@update');
		Route::name('tes.selesai')->get('/tes/selesai/{tes}/{siswa_tes}', 'TesController@selesai');

		Route::name('quiz.index')->get('/quiz/{modul}', 'QuizController@index');
		Route::name('quiz.show')->get('/quiz/{modul}/{quiz}', 'QuizController@show');
		Route::name('quiz.update')->post('/quiz/{modul}/{quiz}', 'QuizController@update');

		Route::name('nilai.index')->get('/nilai/', 'NilaiController@index');
	});

	Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {
		Route::name('index')->get('/', 'HomeController@index');
		Route::name('profile')->get('/profile', 'HomeController@profile');

		Route::resource('pelajaran', 'PelajaranController');
		Route::post('pelajaran/data', 'PelajaranController@data')->name('pelajaran.data');
	});

	Route::name('post.upload')->post('/upload/image', 'HomeController@upload');
});