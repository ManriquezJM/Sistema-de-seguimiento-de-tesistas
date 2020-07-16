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
        
        $cNombre = $request->cNombre;
        $cApellido = $request->cApellido;
        $cCorreo = $request->cCorreo;
        $cEstado = $request->cEstado;
        
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cApellido = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cEstado = ($cEstado == NULL) ? ($cEstado = '') : $cEstado;

        $rpta = DB::select('call sp_Usuario_getListarUsuarios (?, ?, ?, ?)',
                                                                [
                                                                    $cNombre,
                                                                    $cApellido,
                                                                    $cCorreo,
                                                                    $cEstado
                                                                ]);
        return $rpta;
    }
    /*
    public function getListarEscuelas(Request $request){
        if(!$request->ajax()) return redirect('/');

        $cId = $request->cId;
        $cEscuela = $request->cEscuela;
        $escuelas = DB::table('escuelas')->get([$cId,
                                            $cEscuela]);
        return $escuelas;
    }*/

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
}
