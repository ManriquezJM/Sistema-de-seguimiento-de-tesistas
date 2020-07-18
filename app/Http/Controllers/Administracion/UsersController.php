<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getListarUsuarios(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $nIdUsuario   =   $request->nIdUsuario;
        $cNombre      =   $request->cNombre;
        $cApellido    =   $request->cApellido;
        $cCorreo      =   $request->cCorreo;
        $cEstado      =   $request->cEstado;
        $cEscuela     =   $request->cEscuela;
        
        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $cNombre    = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cApellido  = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cCorreo    = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cEstado    = ($cEstado == NULL) ? ($cEstado = '') : $cEstado;
        $cEscuela   = ($cEscuela == NULL) ? ($cEscuela = 0) : $cEscuela;

        $rpta = DB::select('call sp_Usuario_getListarUsuarios (?, ?, ?, ?, ?, ?)',
                                                                [
                                                                    $nIdUsuario,
                                                                    $cNombre,
                                                                    $cApellido,
                                                                    $cCorreo,
                                                                    $cEstado,
                                                                    $cEscuela
                                                                ]);
        return $rpta;
    }
    
    public function setRegistrarUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');

        $cNombre = $request->cNombre;
        $cApellido = $request->cApellido;
        $cCorreo = $request->cCorreo;
        $cContrasena = Hash::make($request->cContrasena);
        $cEscuela = $request->cEscuela;

        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cApellido = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $cEscuela = ($cEscuela == NULL) ? ($cEscuela = '') : $cEscuela;

        $rpta = DB::select('call sp_Usuario_setRegistrarUsuario (?, ?, ?, ?, ?)',
                                                                [
                                                                    $cNombre,
                                                                    $cApellido,
                                                                    $cCorreo,
                                                                    $cContrasena,
                                                                    $cEscuela
                                                                ]);
    }
    //     EDITAR USUARIOS
    public function setEditarUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');

        $nIdUsuario = $request->nIdUsuario;
        $cNombre = $request->cNombre;
        $cApellido = $request->cApellido;
        $cCorreo = $request->cCorreo;
        $cContrasena = $request->cContrasena;
        if($cContrasena != NULL){
            $cContrasena = Hash::make($cContrasena);
        }
        $cEscuela = $request->cEscuela;

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cApellido = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $cEscuela = ($cEscuela == NULL) ? ($cEscuela = '') : $cEscuela;

        $rpta = DB::select('call sp_Usuario_setEditarUsuario (?, ?, ?, ?, ?, ?)',
                                                                [
                                                                    $nIdUsuario,
                                                                    $cNombre,
                                                                    $cApellido,
                                                                    $cCorreo,
                                                                    $cContrasena,
                                                                    $cEscuela
                                                                ]);
    }



}
