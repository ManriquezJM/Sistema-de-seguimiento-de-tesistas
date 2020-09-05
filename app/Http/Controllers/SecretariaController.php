<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function getListarAlumnos(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idUser     = Auth::id();
        $IdEscuela  = User::select('id_escuela')->where('id_user', $idUser)->get();

        $rut        = $request->nRut;
        $nombre     = $request->cNombre;
        $estado     = $request->cEstado_tesis;

        $rut        = ($rut == NULL) ? ($rut = '') : $rut;
        $nombre     = ($nombre == NULL) ? ($nombre = '') : $nombre;
        $estado     = ($estado == NULL) ? ($estado = '') : $estado;

        $alumnos = DB::table('users')
                        ->join('fit', 'fit.id_alumno', '=', 'users.id_user')
                        ->select('fit.estado as estado_tesis', 'fit.id as id_tesis',DB::raw("CONCAT(users.nombres,' ',users.apellidos) as full_name"))
                        ->where([['users.id_escuela', '=', $IdEscuela[0]->id_escuela],[DB::raw("CONCAT(users.nombres,' ',users.apellidos)"), 'like', "%{$nombre}%"]])
                        ->get();
        return $alumnos;
    }
    public function setGenerarMemoRevision(Request $request){

        $id = $request->nIdTesis;
        $logo = public_path('img/logo_ucm_marca.png');

        $datosmemo = DB::table('fit')
                        ->leftjoin('vinculaciones', 'vinculaciones.id', '=','fit.id_vinculacion')
                        ->leftjoin('comisiones', 'comisiones.id_tesis', '=','fit.id')
                        ->join('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                        ->join('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                        ->join('users as profesor_1','profesor_1.id_user','=', 'comisiones.id_profesor1')
                        ->leftjoin('users as profesor_2','profesor_2.id_user','=', 'comisiones.id_profesor2')
                        ->select('comisiones.id','comisiones.id_profesor1', 'comisiones.id_profesor2', 'comisiones.p_externo', 'fit.id_profesorguia as profe_guia',
                                'alumno.nombres as Anombres', 'profesor_guia.nombres as Pnombres', 'profesor_1.nombres as P1nombres','profesor_2.nombres as P2nombres','fit.id as id_fit','fit.titulo')
                        ->where('fit.id', '=', $id)
                        ->get();
                    //return $datosmemo;
        $pdf = PDF::loadView('reportes.tesis.pdf.memorevision',[
           'datosmemo' => $datosmemo,
           'logo' => $logo,
        ]);
       
        return $pdf->download('invoice.pdf');
    }
}
