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

/*********      RUTAS MODULO ADMINISTRACION DE USUARIOS           *********/
Route::get('/administracion/usuario/getListarUsuarios', 'Administracion\UsersController@getListarUsuarios');
Route::post('/administracion/usuario/setRegistrarUsuario', 'Administracion\UsersController@setRegistrarUsuario');
Route::post('/administracion/usuario/setEditarUsuario', 'Administracion\UsersController@setEditarUsuario');
Route::post('/administracion/usuario/setCambiarEstadoUsuario', 'Administracion\UsersController@setCambiarEstadoUsuario');


/*********    RUTAS MODULO DE ADMINISTRACION DE ROLES      **********/
Route::get('/administracion/roles/getListarRoles', 'Administracion\RolesController@getListarRoles');
Route::get('/administracion/roles/getListarPermisosByRol', 'Administracion\RolesController@getListarPermisosByRol');
Route::post('/administracion/roles/setRegistrarRolPermisos', 'Administracion\RolesController@setRegistrarRolPermisos');


/*********    RUTAS MODULO DE ADMINISTRACION DE ARCHIVOS     **********/
Route::post('archivo/setRegistrarArchivo', 'FilesController@setRegistrarArchivo');



Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath');
    //->where('optional', '.*');