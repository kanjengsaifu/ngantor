<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth
Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/logout', 'LogoutController@index');
	Route::get('/home', 'HomeController@index');


	//Pegawai
	Route::group(['prefix' => 'pegawai'], function () {
		Route::match(['get', 'post'], '/', 'Pegawai\PegawaiController@index');
		Route::get('form/{id?}', 'Pegawai\PegawaiController@form')->where('id', '[0-9]+');
		Route::post('save', 'Pegawai\PegawaiController@save');
		Route::get('delete/{id}', 'Pegawai\PegawaiController@delete')->where('id', '[0-9]+');
	});


	//Surat
	Route::group(['prefix' => 'surat'], function () {

		//Inbox
		Route::group(['prefix' => 'inbox'], function () {
			Route::match(['get', 'post'], '/', 'Surat\InboxController@index');
			Route::get('form/{id?}', 'Surat\InboxController@form')->where('id', '[0-9]+');
			Route::post('save', 'Surat\InboxController@save');
		});

	});


	//Me
	Route::group(['prefix' => 'me'], function () {
		Route::get('pwd', 'Me\ChPwdController@index');
		Route::post('pwd', 'Me\ChPwdController@save');
	});

});
