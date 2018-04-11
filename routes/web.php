<?php


Route::get('/', ['as' => 'index', function () {
    return view('index');
}]);


Route::get('terminos_condiciones', ['as' => 'terminos', function () {
    return view('terms_and_Conditions');
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
Route::get('solicitantes',['as'=>'solicitantes.index','uses'=>'UserController@muestraSolicitantes']);
Route::resource('vehiculo', 'VehicleController');
Route::resource('role', 'RoleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('select_event_type', ['as' => 'select_event', function () {
    $list = DB::table('event_types')
        ->where('categories_id','=',request()->category)
        ->get()->pluck('nombre','id');
    return view('select_event_types', compact('list'));
}]);
