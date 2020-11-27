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
//     return view('mainmenu');
// });

Route::group(['middleware' => 'auth'], function () {

    Route::get('/index', 'DriverController@index')->name('index');
    Route::get('/logout', 'DriverController@logout');

});

Route::get('/login', 'DriverController@login')->name('login');
Route::post('/loginPost', 'DriverController@loginPost');

Route::get('/register', 'DriverController@register')->name('register');
Route::post('/registerPost', 'DriverController@registerPost');

Route::get('/editktp/{id}', 'DriverController@editktp');
Route::post('/editktp/update','DriverController@updatektp');

Route::get('/editsim/{id}', 'DriverController@editsim');
Route::post('/editsim/update','DriverController@updatesim');

Route::get('/editstnk/{id}', 'DriverController@editstnk');
Route::post('/editstnk/update','DriverController@updatestnk');

Route::get('/editskck/{id}', 'DriverController@editskck');
Route::post('/editskck/update','DriverController@updateskck');

Route::get('/editsuratkesehatan/{id}', 'DriverController@editsuratkesehatan');
Route::post('/editsuratkesehatan/update','DriverController@updatesuratkesehatan');
