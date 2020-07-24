<?php

use Illuminate\Support\Facades\Route;


/*********      RUTAS MODULO DE AUTENTICACION           *********/
Route::post('/authenticate/login', 'Auth\LoginController@login');

/*********      RUTAS MODULO ADMINISTRACION DE USUARIOS           *********/
Route::get('/administracion/usuario/getListarUsuarios', 'Administracion\UsersController@getListarUsuarios');
Route::post('/administracion/usuario/setRegistrarUsuario', 'Administracion\UsersController@setRegistrarUsuario');
Route::post('/administracion/usuario/setEditarUsuario', 'Administracion\UsersController@setEditarUsuario');
Route::post('/administracion/usuario/setCambiarEstadoUsuario', 'Administracion\UsersController@setCambiarEstadoUsuario');
Route::post('/administracion/usuario/setEditarRolByUsuario', 'Administracion\UsersController@setEditarRolByUsuario');
Route::get('/administracion/usuario/getRolByUsuario', 'Administracion\UsersController@getRolByUsuario');
Route::get('/administracion/usuario/getListarPermisosByRolAsignado', 'Administracion\UsersController@getListarPermisosByRolAsignado');
Route::get('/administracion/usuario/getListarPermisosByUsuario', 'Administracion\UsersController@getListarPermisosByUsuario');
Route::post('/administracion/usuario/setRegistrarPermisosByUsuario', 'Administracion\UsersController@setRegistrarPermisosByUsuario');

/*********    RUTAS MODULO DE ADMINISTRACION DE ROLES      **********/
Route::get('/administracion/roles/getListarRoles', 'Administracion\RolesController@getListarRoles');
Route::get('/administracion/roles/getListarPermisosByRol', 'Administracion\RolesController@getListarPermisosByRol');
Route::post('/administracion/roles/setRegistrarRolPermisos', 'Administracion\RolesController@setRegistrarRolPermisos');
Route::post('/administracion/roles/setEditarRolPermisos', 'Administracion\RolesController@setEditarRolPermisos');

/*********    RUTAS MODULO DE ADMINISTRACION DE PERMISOS     **********/
Route::get('/administracion/permisos/getListarPermisos', 'Administracion\PermissionController@getListarPermisos');
Route::post('/administracion/permisos/setRegistrarPermisos', 'Administracion\PermissionController@setRegistrarPermisos');
Route::post('/administracion/permisos/setEditarPermisos', 'Administracion\PermissionController@setEditarPermisos');

/*********    RUTAS MODULO DE ADMINISTRACION DE ARCHIVOS     **********/
Route::post('archivo/setRegistrarArchivo', 'FilesController@setRegistrarArchivo');



Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath');
    //->where('optional', '.*');