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

Route::get('/', 'AuthController@index');

Route::post('login', 'AuthController@login');

Route::get('logout', 'AuthController@logout');

Route::controller('admin', 'AdminController');
Route::controller('tasks', 'TaskController');
Route::controller('user', 'UserController');
