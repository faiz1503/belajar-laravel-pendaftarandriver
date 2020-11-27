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

Route::get('/login', 'DriverController@login')->name('login_driver');
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


Route::get('/menu', function() {
    return view('menu');
});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/index_food', 'FoodController@show')->name('index_food');
    Route::get('/logout_food', 'FoodController@logout_food');

});

Route::get('/daftar_food', 'FoodController@index')->name('daftar_food');
Route::post('/foodPost', 'FoodController@store');

Route::get('/login_food', 'FoodController@login')->name('login_food');
Route::post('/loginPost', 'FoodController@loginPost');

Route::get('/editsuratperusahaan/{id}', 'FoodController@editsuratperusahaan');
Route::post('/editsuratperusahaan/update','FoodController@updatesuratperusahaan');

Route::get('/editsuratdirektur/{id}', 'FoodController@editsuratdirektur');
Route::post('/editsuratdirektur/update','FoodController@updatesuratdirektur');

Route::get('/editsuratpenanggungjawab/{id}', 'FoodController@editsuratpenanggungjawab');
Route::post('/editsuratpenanggungjawab/update','FoodController@updatesuratpenanggungjawab');

Route::get('/editsuratpembayaran/{id}', 'FoodController@editsuratpembayaran');
Route::post('/editsuratpembayaran/update','FoodController@updatesuratpembayaran');

