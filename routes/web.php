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

// Route::get('/', function () {
//     return view('register');
// });

Route::get('/', 'DriverController@index');
Route::get('/login', 'DriverController@login');
Route::post('/loginPost', 'DriverController@loginPost');
Route::get('/register', 'DriverController@register')->name('register');
Route::post('/registerPost', 'DriverController@registerPost');
Route::get('/logout', 'DriverController@logout');

