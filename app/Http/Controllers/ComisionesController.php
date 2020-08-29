<?php

namespace App\Http\Controllers;

use App\Comisiones;
use App\Fit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComisionesController extends Controller
{
    public function setRegistrarComision(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $IdAlumno = $request->id_user;

        $IdTesis = Fit::select('id')->where('id_alumno',$IdAlumno)->get();
        $comision = new Comisiones();
        $comision->id_tesis = $IdTesis[0]->id;
        $comision->id_profesor1 = $request->Profesor1;
        $comision->id_profesor2 = $request->Profesor2;
        $comision->p_externo = $request->NombrePEx;
        $comision->correo_p_externo = $request->EmailPEx;
        $comision->institucion_p_externo = $request->InstitucionPEx;
        $comision->save();

        return $comision;
    }
    public function getListarMisComisiones(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $IdProfesor  = Auth::id();

        $MisComisiones = DB::table('comisiones')
                        ->join('fit', 'fit.id', '=', 'comisiones.id_tesis')
                        ->join('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                        ->join('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                        ->join('users as profesor_1','profesor_1.id_user','=', 'comisiones.id_profesor1')
                        ->leftjoin('users as profesor_2','profesor_2.id_user','=', 'comisiones.id_profesor2')
                        ->select('comisiones.id','comisiones.id_profesor1', 'comisiones.id_profesor2', 'comisiones.p_externo', 'fit.id_profesorguia as profe_guia',
                        'alumno.nombres as Anombres', 'profesor_guia.nombres as Pnombres', 'profesor_1.nombres as P1nombres','profesor_2.nombres as P2nombres','fit.id as id_fit')
                        ->where('fit.id_profesorguia', '=', $IdProfesor)
                        ->get();
        return $MisComisiones;
    }
    public function getListarComisiones(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $IdProfesor  = Auth::id();

        $Comisiones = DB::table('comisiones')
                    ->join('fit', 'fit.id', '=', 'comisiones.id_tesis')
                    ->join('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                    ->join('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                    ->join('users as profesor_1','profesor_1.id_user','=', 'comisiones.id_profesor1')
                    ->leftjoin('users as profesor_2','profesor_2.id_user','=', 'comisiones.id_profesor2')
                    ->select('comisiones.id','comisiones.id_profesor1', 'comisiones.id_profesor2', 'comisiones.p_externo', 'fit.id_profesorguia as profe_guia',
                    'alumno.nombres as Anombres', 'profesor_guia.nombres as Pnombres', 'profesor_1.nombres as P1nombres','profesor_2.nombres as P2nombres','fit.id as id_fit')
                    ->where('comisiones.id_profesor1', '=', $IdProfesor)
                    ->orWhere('comisiones.id_profesor2', '=', $IdProfesor)
                    ->get();

        return $Comisiones;
    }

}
