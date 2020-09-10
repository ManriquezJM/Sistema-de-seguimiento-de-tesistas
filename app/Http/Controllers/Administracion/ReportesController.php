<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fit;
use Illuminate\Support\Facades\DB;
use App\Exports\TesisExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function getListarTesisReporte(Request $request){
        if(!$request->ajax()) return redirect('/');

        $rut                = $request->nRut;
        $idescuela          = $request->nIdEscuela;
        $estado_notap       = $request->cEstadoNotap;
        $idprofesor         = $request->nIdProfesor;
        $estado             = $request->cEstadoTesis;
        $dFechaInicio       = $request->dFechaInicio;
        $dFechaFin          = $request->dFechaFin;

        $rut     = ($rut == NULL) ? ($rut = 'n') : $rut;
        //$idescuela       = ($idescuela == NULL) ? ($idescuela = 0) : $idescuela;
        //$estado_notap       = ($estado_notap == NULL) ? ($estado_notap = 0) : $estado_notap;
        //$idprofesor       = ($idprofesor == NULL) ? ($idprofesor = 0) : $idprofesor;
        //$estado       = ($estado == NULL) ? ($estado = 0) : $estado;

        //$UltimaBitacora = Bitacoras::
        $reportdata = Fit::select('fit.id','nombre_int1', 'rut_int1', 'email_int1', 'ingreso_int1', 'bitacoras.fecha as fecha_bitacora',
                                    'bitacoras.comentario as comentario_bitacora','telefono_int1','fit.nombre_int2','fit.rut_int2', 'profesor_guia.nombres as nombre_pt', 
                                    'objetivo', 'contribucion', 'carrera', 'fit.tipo as tipo_trabajo','titulo', 'avancestesis.created_at as fecha_avance',
                                    'vinculaciones.nombre AS namevinculacion', 'fit.estado','escuelas.nombre as escuela_nom','fit.created_at as fecha_inscripcion',
                                    /*'notaspendientes.fecha_propuesta as fecha_notap','notaspendientes.fecha_prorroga as prorroga_notap', 'notaspendientes.estado as estado_notap',*/ 'fit.fecha_ultimoramo')
                            ->leftjoin('vinculaciones', 'vinculaciones.id', '=','fit.id_vinculacion')
                            ->leftjoin('bitacoras', function ($query) {
                                $query->on('bitacoras.id_tesis','=', 'fit.id')
                                ->WhereRaw('bitacoras.id IN (select MAX(a2.id) from bitacoras as a2 join fit as u2 on u2.id = a2.id_tesis group by u2.id)');
                            })
                            ->leftjoin('avancestesis', function ($query) {
                                $query->on('avancestesis.id_tesis','=', 'fit.id')
                                ->WhereRaw('avancestesis.id IN (select MAX(a2.id) from avancestesis as a2 join fit as u2 on u2.id = a2.id_tesis group by u2.id)');
                            })
                            //->leftjoin('notaspendientes', 'notaspendientes.id', '=', 'fit.id_notapendiente')
                            ->leftjoin('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                            ->leftjoin('escuelas', 'escuelas.id','=','profesor_guia.id_escuela')
                            ->leftjoin('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                            /*->Orwhere([['fit.rut_int1', 'like', "%$rut%"],['notaspendientes.estado', '=', $estado_notap],
                                    ['notaspendientes.estado', '=', null],['profesor_guia.id_escuela', '=', $idescuela],
                                    ['profesor_guia.id_escuela', '=', null],['profesor_guia.id_user', '=', $idprofesor],
                                    ['profesor_guia.id_user', '=', null],['fit.estado', '=', $estado],
                                    ['fit.estado', '=', null]])*/
                            ->OrWhere('fit.rut_int1', 'like', "%$rut%")
                            //->Orwhere('notaspendientes.estado', '=', $estado_notap)
                            ->orWhere('profesor_guia.id_escuela', '=', $idescuela)
                            ->orWhere('profesor_guia.id_user', '=', $idprofesor)
                            ->orWhere('fit.estado', '=', $estado)
                            ->orWhereBetween('fit.fecha_ultimoramo', [$dFechaInicio, $dFechaFin])
                            ->get();
        return $reportdata;
    }
    public function export(Request $request){
        if(!$request->ajax()) return redirect('/');

        $listTesis = json_decode($request->listTesis);
        return (new TesisExport)->getTesis($listTesis)->download('invoices.xlsx');
        //return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function getListarProfesorByEscuela(Request $request){
        if(!$request->ajax()) return redirect('/');
        
        $escuela     = $request->nIdEscuela;

        $escuela     = ($escuela == NULL) ? ($escuela = '') : $escuela;

        if($escuela == ''){
            $profesores = DB::table('users')
                            ->join('users_roles', 'users_roles.id_user', '=', 'users.id_user')
                            ->join('roles', 'roles.id', '=', 'users_roles.id_roles')
                            ->select('users.id_user', DB::raw("CONCAT(users.nombres,' ',users.apellidos) as fullname"))
                            ->where([
                                ['roles.name', '=', 'Profesor'],
                            ])->get();
            return $profesores;
        }else{
            $profesores = DB::table('users')
                            ->join('users_roles', 'users_roles.id_user', '=', 'users.id_user')
                            ->join('roles', 'roles.id', '=', 'users_roles.id_roles')
                            ->select('users.id_user', DB::raw("CONCAT(users.nombres,' ',users.apellidos) as fullname"))
                            ->where([
                                ['roles.name', '=', 'Profesor'],
                                ['users.id_escuela', '=', $escuela],
                            ])->get();
            return $profesores;
        }
    }
}
