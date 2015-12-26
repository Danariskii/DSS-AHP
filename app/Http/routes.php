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
Route::get('users', "PagesController@index");
Route::get('logout', "PagesController@logout");

Route::get('login', "PagesController@login");
post('admin', 'PagesController@submit');



// post('login', "PagesController@login");

// Route::controller([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);


// Route::get('/', "PagesController@index");