<?php 

namespace App\Routes;

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Routes\Route;

Route::get('/', 'HomeController@index');

Route::get('/logs', 'AuthController@showlogs');

Route::get('/user', 'UserController@index');
Route::get('/user/show', 'UserController@show');
Route::post('/user/store', 'UserController@store');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::dispatch();
