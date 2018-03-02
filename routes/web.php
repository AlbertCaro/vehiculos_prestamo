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

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/historial', ['as'=>'historical', function (){
    return view('historical');
}]);

Route::get('/nueva_solicitud', ['as'=>'new_request',function (){
    return view('new_request');
}]);

Route::get('/gestionar_eventos', ['as'=>'manage_events',function (){
    return view('manage_events');
}]);

Route::get('/gestionar_jefes', ['as'=>'manage_bosses',function (){
    return view('manage_bosses');
}]);

Route::get('/gestionar_solicitantes', ['as'=>'manage_applicants',function (){
    return view('manage_applicants');
}]);

Route::get('/gestionar_solicitudes', ['as'=>'manage_requests',function (){
    return view('manage_requests');
}]);

Route::get('/gestionar_vehiculos', ['as'=>'manage_vehicles',function (){
    return view('manage_vehicles');
}]);

Route::get('/gestionar_usuarios', ['as'=>'manage_users',function (){
    return view('manage_users');
}]);

//Rutas de para agregar

Route::get('/agregar_conductores', ['as'=>'add_conductor',function (){
    return view('add_conductor');
}]);

Route::get('/agregar_eventos', ['as'=>'add_events',function (){
    return view('add_events');
}]);

Route::get('/agregar_jefes', ['as'=>'add_bosses',function (){
    return view('add_bosses');
}]);

Route::get('/agregar_solicitantes', ['as'=>'add_applicants',function (){
    return view('add_applicants');
}]);

Route::get('/agregar_vehiculos', ['as'=>'add_vehicles',function (){
    return view('add_vehicles');
}]);

Route::get('/agregar_usuario', ['as'=>'add_users',function (){
    return view('add_users');
}]);