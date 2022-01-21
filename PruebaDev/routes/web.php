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
    return view('welcome');
});

Auth::routes();

Route::get('/proceso/{rfc}', 'CustomerController@index')->name('home');
Route::post('/salvar-registro', 'CustomerController@salvarRegistro');

// formulario de datos de cliente
Route::get('/cliente/datos/{rfc}', 'CustomerController@getDatosCliente');
