<?php

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

// Authentication routes
Auth::routes(['register' => false]);

// Main Applicationb route
Route::get('/',function () { return redirect('/app'); });
Route::get('/app{any}', 'AppController@index')->where('any', '.*');

// Users routes
Route::get('/users/me', 'UserController@me');
Route::resource('users', 'UserController');