<?php


Route::group(['middleware' => ['web','auth']], function () {
	Route::get('register', 'UserController@getRegister');
	Route::post('register', 'UserController@postRegister');
	Route::get('/', function () {
	    return view('welcome');
	});
	Route::get('/home', 'HomeController@index');

});

Route::group(['middleware' => 'web'], function () {
    
    //Route::auth();
	//Route::get('login', 'Auth\AuthController@showLoginForm');
	//Route::post('login', 'Auth\AuthController@login');
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'Auth\AuthController@logout');

	// Password Reset Routes...
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');
    
});
