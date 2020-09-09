<?php

namespace App\Http\Controllers;
use App\NotasPendientes;
use App\Fit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotasPendientesController extends Controller
{
    public function setRegistrarNotaP(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idAlumno = Auth::id();
        
        $NotaP                      = new NotasPendientes();
        $NotaP->fecha_propuesta     = $request->fecha_propuesta;
        $NotaP->fecha_presentacion  = Carbon::now();
        $NotaP->save();

        return $NotaP;
    }
    public function setAsignarNotaP(Request $request){
        if(!$request->ajax()) return redirect('/');

        $id_notapendiente = $request->id_notapendiente;

        $idAlumno   = Auth::id();
        $idTesis    = Fit::select('id')->where('id_alumno',$idAlumno)->get();
        $tesis      = DB::table('fit')
                            ->where('id', $idTesis[0]->id)
                            ->update(['id_notapendiente' => $id_notapendiente]);
        return $tesis;
    }
    public function getMiNotaP(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idAlumno = Auth::id();

        $NotaP    = DB::table('notaspendientes')
                        ->join('fit', 'fit.id_notapendiente', '=', 'notaspendientes.id')
                        ->join('users', 'users.id_user', '=', 'fit.id_alumno')
                        ->select('notaspendientes.id','fecha_presentacion', 'fecha_propuesta', 'fecha_prorroga', 'notaspendientes.estado',DB::raw("CONCAT(users.nombres,' ',users.apellidos) as full_name"))
                        ->where('fit.id_alumno', '=', $idAlumno)
                        ->get();
        return $NotaP;
    }
    public function getListarNotasPendientes(Request $request){
        if(!$request->ajax()) return redirect('/');

        $IdProfesor       = Auth::id();
        $nIdNotaP       = $request->nIdNotaP;
        $estado         = $request->estado;
        $dFechaInicio   = $request->dFechaInicio;
        $dFechaFin      = $request->dFechaFin;

        $nIdNotaP       = ($nIdNotaP == NULL) ? ($nIdNotaP = 0) : $nIdNotaP;
        $NotasP = DB::table('fit')
                        ->leftjoin('notaspendientes', 'notaspendientes.id', '=','fit.id_notapendiente')
                        ->join('users', 'users.id_user', '=', 'fit.id_alumno')
                        ->Where('notaspendientes.estado', '=', $estado)
                        ->OrWhere('notaspendientes.id', '=', $nIdNotaP)
                        ->OrWhere('fit.id_profesorguia', '=', $IdProfesor)
                        ->OrWhere('notaspendientes.id', '=', 0)
                        ->orWhereBetween('notaspendientes.fecha_propuesta', [$dFechaInicio, $dFechaFin])
                        ->select('notaspendientes.id','fecha_presentacion', 'fecha_propuesta', 'fecha_prorroga', 'notaspendientes.estado',DB::raw("CONCAT(users.nombres,' ',users.apellidos) as full_name"))
                        ->get();
        return $NotasP;
    }  
    public function getListarNotasPendientesByAlumno(Request $request){
        if(!$request->ajax()) return redirect('/');

        $IdProfesor       = Auth::id();
        $nIdNotaP       = $request->nIdNotaP;
        $estado         = $request->estado;
        $dFechaInicio   = $request->dFechaInicio;
        $dFechaFin      = $request->dFechaFin;

        $nIdNotaP       = ($nIdNotaP == NULL) ? ($nIdNotaP = 0) : $nIdNotaP;
        $NotasP = DB::table('fit')
                        ->leftjoin('notaspendientes', 'notaspendientes.id', '=','fit.id_notapendiente')
                        ->Where('notaspendientes.estado', '=', $estado)
                        ->OrWhere('notaspendientes.id', '=', $nIdNotaP)
                        ->OrWhere('fit.id_profesorguia', '=', $IdProfesor)
                        ->OrWhere('notaspendientes.id', '=', 0)
                        ->orWhereBetween('notaspendientes.fecha_propuesta', [$dFechaInicio, $dFechaFin])
                        ->select('notaspendientes.id','fecha_presentacion', 'fecha_propuesta', 'fecha_prorroga', 'notaspendientes.estado')
                        ->get();
        return $NotasP;
    }  
    public function setEditarNotaP(Request $request){   
        if(!$request->ajax()) return redirect('/');

        $id                 = $request->nIdNotaP;
        $fecha_propuesta    = $request->fecha_propuesta;

        NotasPendientes::find($id)->update(['fecha_propuesta'=>$fecha_propuesta]);
    }
    public function setIngresarProrroga(Request $request){
        if(!$request->ajax()) return redirect('/');

        $id             = $request->nIdNotaP;
        $fecha_prorroga = $request->fecha_prorroga;

        NotasPendientes::find($id)->update(['fecha_prorroga'=>$fecha_prorroga]);
    }      
}           
