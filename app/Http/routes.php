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

// Route::get('/', function () 
// {
//     return view('welcome');
// });

Route::get('/', "PagesController@redirect");

// Route::get('admin', "PagesController@kriteria");
Route::get('logout', "PagesController@logout");
Route::get('login', "PagesController@login");

// Route::get('users', "PagesController@index");
Route::get('users', "PagesController@kriteriaUser");


post('admin', 'PagesController@submit');
// post('kriteria', 'PagesController@kriteria');
Route::get('admin', 'PagesController@kriteria');

Route::post('postValue', 'PagesController@postValue');
Route::get('postValue', 'PagesController@postValue');

post('questionnaire', "PagesController@questionnaire");
post('/', "PagesController@redirect");
// Route::get('welcome', 'PagesController@goHasil');
// Route::get('welcome', function(){
// 	return view('layoutHasil');
// });

// Route::get('layoutHasil', '')


// post('login', "PagesController@login");

// Route::controller([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);


// Route::get('/', "PagesController@index");