<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VinculacionController extends Controller
{
    public function getListarVinculacion(Request $request){

        if(!$request->ajax()) return redirect('/');

        $nIdVinculacion     =   $request->nIdVinculacion;
        $cNombre            =   $request->cNombre;
        $cTipos             =   $request->cTipos;
        $cDescripcion       =   $request->cDescripcion;
        
        $nIdVinculacion     = ($nIdVinculacion == NULL) ? ($nIdVinculacion = 0) : $nIdVinculacion;
        $cNombre            = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cTipos             = ($cTipos == NULL) ? ($cTipos = '') : $cTipos;
        $cDescripcion       = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $rpta = DB::select('call sp_Vinculacion_getListarVinculacion (?, ?, ?, ?)',
                                                                [
                                                                    $nIdVinculacion,
                                                                    $cNombre,
                                                                    $cTipos,
                                                                    $cDescripcion
                                                                ]);
        return $rpta;
    }
    public function setRegistrarVinculacion(Request $request){

        if(!$request->ajax()) return redirect('/');

        $cNombre           =   $request->cNombre;
        $cTipo             =   $request->cTipo;
        $cDescripcion      =   $request->cDescripcion;
        
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cTipo    = ($cTipo == NULL) ? ($cTipo = '') : $cTipo;
        $cDescripcion    = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        DB::select('call sp_Vinculacion_setRegistrarVinculacion (?, ?, ?)',
                                                                [
                                                                    $cNombre,
                                                                    $cTipo,
                                                                    $cDescripcion
                                                                ]);
    }
    public function setEditarVinculacion(Request $request){

        if(!$request->ajax()) return redirect('/');

        $nIdVinculacion =   $request->nIdVinculacion; 
        $cNombre    =   $request->cNombre;
        $cTipo      =   $request->cTipo;
        $cDescripcion      =   $request->cDescripcion;
        
        $nIdVinculacion = ($nIdVinculacion == NULL) ? ($nIdVinculacion = 0) : $nIdVinculacion;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cTipo    = ($cTipo == NULL) ? ($cTipo = '') : $cTipo;
        $cDescripcion    = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        DB::select('call sp_Vinculacion_setEditarVinculacion (?, ?, ?, ?)',
                                                                [
                                                                    $nIdVinculacion,
                                                                    $cNombre,
                                                                    $cTipo,
                                                                    $cDescripcion
                                                                ]);
    }
}
