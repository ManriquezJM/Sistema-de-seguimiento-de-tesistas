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

        $tipo = $request->cTipo;
        $vinculacion = $request->cVinculacion;
        $estado = $request->cEstadoTesis;
        $dFechaInicio = $request->dFechaInicio;
        $dFechaFin = $request->dFechaFin;
        //$created_at = $request->dfecharango;

        $reportdata = DB::table('fit')
                        ->leftjoin('vinculaciones', 'vinculaciones.id', '=','fit.id_vinculacion')
                        ->join('users', 'users.id_user', '=','fit.id_profesorguia')
                        ->select('fit.id','nombre_int1', 'rut_int1', 'email_int1', 'ingreso_int1', 'telefono_int1', 'users.nombres', 'users.apellidos',
                                 'objetivo', 'contribucion', 'carrera', 'fit.tipo','titulo', 'vinculaciones.nombre AS namevinculacion', 'estado', 'fit.created_at' )
                        ->where('fit.tipo', '=', $tipo)
                        ->orWhere('vinculaciones.tipo', '=', $vinculacion)
                        ->orWhere('fit.estado', '=', $estado)
                        ->orWhereBetween('fit.created_at', [$dFechaInicio, $dFechaFin])
                        ->get();
        return $reportdata;
    }
    public function export(Request $request){

        if(!$request->ajax()) return redirect('/');

        $listTesis = json_decode($request->listTesis);
        return (new TesisExport)->getTesis($listTesis)->download('invoices.xlsx');

        //return Excel::download(new UsersExport, 'users.xlsx');
    }
}

