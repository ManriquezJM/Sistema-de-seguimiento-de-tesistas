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

        $rut                = ($rut == NULL) ?          ($rut = '')         : $rut;
        $idescuela          = ($idescuela == NULL) ?    ($idescuela = '')   : $idescuela;
        $estado_notap       = ($estado_notap == NULL) ? ($estado_notap = ''): $estado_notap;
        $idprofesor         = ($idprofesor == NULL) ?   ($idprofesor = '')  : $idprofesor;
        $estado             = ($estado == NULL) ?       ($estado = '')      : $estado;
        $dFechaInicio       = ($dFechaInicio == NULL) ? ($dFechaInicio = '2000-01-01'): $dFechaInicio;
        $dFechaFin          = ($dFechaFin == NULL) ?    ($dFechaFin = '2100-01-01')   : $dFechaFin;

        $reportdata = Fit::select('fit.id','nombre_int1', 'rut_int1', 'email_int1', 'ingreso_int1', 'bitacoras.fecha as fecha_bitacora',
                                    'bitacoras.comentario as comentario_bitacora','telefono_int1','fit.nombre_int2','fit.rut_int2',  DB::raw("CONCAT(profesor_guia.nombres,' ',profesor_guia.apellidos) as nombre_pt"),
                                    'objetivo', 'contribucion', 'fit.tipo as tipo_trabajo','titulo', 'avancestesis.created_at as fecha_avance',
                                    'vinculaciones.nombre AS namevinculacion', 'fit.estado','escuelas.nombre as escuela_nom','fit.created_at as fecha_inscripcion','alumno.id_user as IDalumno',
                                    'notaspendientes.fecha_propuesta as fecha_notap','notaspendientes.fecha_prorroga as prorroga_notap', 'notaspendientes.estado as estado_notap','fit.fecha_ultimoramo')
                            ->leftjoin('bitacoras', function ($query) {
                                $query->on('bitacoras.id_tesis','=', 'fit.id')
                                ->WhereRaw('bitacoras.id IN (select MAX(a2.id) from bitacoras as a2 join fit as u2 on u2.id = a2.id_tesis group by u2.id)');
                            })
                            ->leftjoin('avancestesis', function ($query) {
                                $query->on('avancestesis.id_tesis','=', 'fit.id')
                                ->WhereRaw('avancestesis.id IN (select MAX(a2.id) from avancestesis as a2 join fit as u2 on u2.id = a2.id_tesis group by u2.id)');
                            })
                            ->leftjoin('vinculaciones', 'vinculaciones.id', '=','fit.id_vinculacion')
                            ->leftjoin('notaspendientes', 'notaspendientes.id_tesis', '=', 'fit.id')
                            ->leftjoin('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                            ->leftjoin('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                            ->leftjoin('escuelas', 'escuelas.id','=','alumno.id_escuela')

                            ->where([[(function($query) use ($estado_notap){
                                    $query
                                        ->orwhere('notaspendientes.estado', 'like', "%$estado_notap%")
                                        ->orwhere('notaspendientes.estado','=', null)  ;   
                            })]])
                            
                            //
                            ->Where('fit.rut_int1', 'like', "%$rut%")
                            ->Where('alumno.id_escuela', 'like', "%$idescuela%")
                            ->Where('profesor_guia.id_user', 'like', "%$idprofesor%")
                            ->Where('fit.estado', 'like', "$estado%")

                            ->WhereBetween('fit.fecha_ultimoramo', [$dFechaInicio, $dFechaFin])
                            ->get();
        return $reportdata;
    }
    public function getListarTesisHome(Request $request){
        if(!$request->ajax()) return redirect('/');

        $titulo             = $request->cTitulo;
        $idescuela          = $request->nIdEscuela;
        $idprofesor         = $request->nIdProfesor;
        

        $titulo             = ($titulo == NULL) ?          ($titulo = '')         : $titulo;
        $idescuela          = ($idescuela == NULL) ?    ($idescuela = '')   : $idescuela;
        $idprofesor         = ($idprofesor == NULL) ?   ($idprofesor = '')  : $idprofesor;
        
        $reportdata = Fit::select('fit.id', DB::raw("CONCAT(profesor_guia.nombres,' ',profesor_guia.apellidos) as nombre_pt"),
                                      'fit.tipo as tipo_trabajo','titulo','pdftesis.path'
                                    ,'escuelas.nombre as escuela_nom',
                                )
                            ->join('pdftesis', 'pdftesis.id', '=', 'fit.id_pdftesis')
                            ->leftjoin('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                            ->leftjoin('escuelas', 'escuelas.id','=','profesor_guia.id_escuela')
                            ->Where('fit.titulo', 'like', "%$titulo%")
                            ->Where('profesor_guia.id_escuela', 'like', "%$idescuela%")
                            ->Where('profesor_guia.id_user', 'like', "%$idprofesor%")

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
                            ])
                            ->orwhere([
                                ['roles.name', '=', 'Director'],
                            ])
                            ->orwhere([
                                ['roles.name', '=', 'Coordinador'],
                            ])
                            ->get();
            return $profesores;
        }else{
            $profesores = DB::table('users')
                            ->join('users_roles', 'users_roles.id_user', '=', 'users.id_user')
                            ->join('roles', 'roles.id', '=', 'users_roles.id_roles')
                            ->select('users.id_user', DB::raw("CONCAT(users.nombres,' ',users.apellidos) as fullname"))
                            ->where([
                                ['roles.name', '=', 'Profesor'],
                                ['users.id_escuela', '=', $escuela],
                            ])
                            ->orwhere([
                                ['roles.name', '=', 'Director'],
                                ['users.id_escuela', '=', $escuela],
                            ])
                            ->orwhere([
                                ['roles.name', '=', 'Coordinador'],
                                ['users.id_escuela', '=', $escuela],
                            ])
                            ->get();
            return $profesores;
        }
    }
}
