<?php


Route::get('/', ['as' => 'index', function () {
    return view('index');
}]);

Route::resource('categoria', 'CategoryController');
Route::resource('contacto', 'ContactController');
Route::resource('dependencia', 'DependenceController');
Route::resource('conductor', 'DriverController');
Route::resource('tipo_evento', 'EventTypeController');
Route::resource('licencia', 'LicenceController');
Route::resource('solicitud', 'SolicitudController');
Route::resource('usuario', 'UserController');
Route::get('jefes',['as'=>'jefes.index','uses'=>'UserController@muestra_jefes']);
Route::get('solicitantes',['as'=>'solicitantes.index','uses'=>'UserController@muestra_solicitantes']);
Route::resource('vehiculo', 'VehicleController');
Route::resource('role', 'RoleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
