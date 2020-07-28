<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscuelasController extends Controller
{
    public function getListarEscuelas(Request $request){
        if(!$request->ajax()) return redirect('/');

        $nIdEscuela     = $request->nIdEscuela;
        $cNombre   =   $request->cNombre;
        
        $nIdEscuela = ($nIdEscuela == NULL) ? ($nIdEscuela = 0) : $nIdEscuela;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;

        $rpta = DB::select('call sp_Escuelas_getListarEscuelas (?, ?)',
                                                                [
                                                                    $nIdEscuela,
                                                                    $cNombre
                                                                ]);
        return $rpta;
    }
    public function setRegistrarEscuelas(Request $request){
        if(!$request->ajax()) return redirect('/');

        $cNombre   =   $request->cNombre;

        
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;

        DB::select('call sp_Escuelas_setRegistrarEscuelas (?)',
                                                                [
                                                                    $cNombre
                                                                ]);
    }
    public function setEditarEscuelas(Request $request){

        if(!$request->ajax()) return redirect('/');

        $nIdEscuela =   $request->nIdEscuela; 
        $cNombre    =   $request->cNombre;
      
        $nIdEscuela = ($nIdEscuela == NULL) ? ($nIdEscuela = 0) : $nIdEscuela;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;

        DB::select('call sp_Escuelas_setEditarEscuelas (?, ?)',
                                                                [
                                                                    $nIdEscuela,
                                                                    $cNombre
                                                                ]);

    }
    
}
