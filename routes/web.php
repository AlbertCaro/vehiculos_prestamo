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

Route::get('/', function () {

    return view('index');
});

Route::resource('categoria','CategoryController');
Route::resource('contacto','ContactController');
Route::resource('dependencia','DependenceController');
Route::resource('conductor','DriverController');
Route::resource('tipo_evento','EventTypeController');
Route::resource('licencia','LicenceController');
Route::resource('solicitud','SolicitudController');
Route::resource('usuario','UserController');
Route::resource('vehiculo','VehicleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
