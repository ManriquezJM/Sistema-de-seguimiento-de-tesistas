<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/administracion/usuario/getListarUsuarios', 'Administracion\UsersController@getListarUsuarios');
Route::post('administracion/usuario/setRegistrarUsuario', 'Administracion\UsersController@setRegistrarUsuario');
Route::post('administracion/usuario/setEditarUsuario', 'Administracion\UsersController@setEditarUsuario');
//Route::get('/administracion/usuario/getListarEscuelas', 'Administracion\UsersController@getListarEscuelas');


Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath');
    //->where('optional', '.*');