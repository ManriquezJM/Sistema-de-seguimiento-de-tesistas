<?php

namespace App\Http\Controllers;

use App\Avances;
use App\Fit;
use App\Mail\MailAvances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AvancesController extends Controller
{
    public function getListarAvances(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idUser    = Auth::id();
        $nIdAvance = $request->nIdAvance;
        
        $idUser    = ($idUser == NULL) ? ($idUser = 0) : $idUser;
        $nIdAvance = ($nIdAvance == NULL) ? ($nIdAvance = 0) : $nIdAvance;

        $avances = DB::table('avancestesis')
                        ->join('fit', 'fit.id', '=', 'avancestesis.id_tesis')
                        ->join('pdftesis', 'pdftesis.id', '=', 'avancestesis.id_archivo')
                        ->select('avancestesis.id','avancestesis.created_at', 'avancestesis.descripcion', 'pdftesis.path')
                        ->Where('avancestesis.id', '=', $nIdAvance)
                        ->OrWhere('avancestesis.id', '=', 0)
                        ->Orwhere('fit.id_alumno', '=', $idUser)
                        ->orderBy('avancestesis.id', 'desc')
                        ->get();
        return $avances;
    }
    public function getListarAvancesByAlumno(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idAlumno = $request->id_user;

        $avances  = DB::table('avancestesis')
                        ->join('fit', 'fit.id', '=', 'avancestesis.id_tesis')
                        ->join('pdftesis', 'pdftesis.id', '=', 'avancestesis.id_archivo')
                        ->select('avancestesis.id','avancestesis.created_at', 'avancestesis.descripcion', 'pdftesis.path')
                        ->where('fit.id_alumno', '=', $idAlumno)
                        ->orderBy('avancestesis.id', 'desc')
                        ->get();
        return $avances;
    }
    public function getListarAlumnosByprofesor(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idUser     = Auth::id();
        $nIdAvance  = $request->nIdAvance;
        
        $idUser     = ($idUser == NULL) ? ($idUser = 0) : $idUser;
        $nIdAvance  = ($nIdAvance == NULL) ? ($nIdAvance = 0) : $nIdAvance;

        $alumnos    = DB::table('fit')
                            ->join('users', 'users.id_user', '=', 'fit.id_alumno')
                            ->select('users.id_user',DB::raw("CONCAT(users.nombres,' ',users.apellidos) as nombres"))
                            ->Where('fit.id_profesorguia', '=', $idUser)
                            ->orderBy('users.id_user', 'desc')
                            ->get();
        return $alumnos;
    }
    public function getSeleccionarAvance(Request $request){
        if(!$request->ajax()) return redirect('/');

        $nIdAvance = $request->nIdAvance;
        
        $nIdAvance = ($nIdAvance == NULL) ? ($nIdAvance = 0) : $nIdAvance;

        $avances = DB::table('avancestesis')
                        ->join('fit', 'fit.id', '=', 'avancestesis.id_tesis')
                        ->join('pdftesis', 'pdftesis.id', '=', 'avancestesis.id_archivo')
                        ->select('avancestesis.id','avancestesis.created_at', 'avancestesis.descripcion', 'pdftesis.path')
                        ->Where('avancestesis.id', '=', $nIdAvance)
                        ->orderBy('avancestesis.id', 'desc')
                        ->get();
        return $avances;
    }
    public function setRegistrarAvance(Request $request){
        if(!$request->ajax()) return redirect('/');
        
        $idUser     = Auth::user()->id_user;
        $idTesis    = Fit::select('id')->where('id_alumno',$idUser)->get();

        $DatosEmail = DB::table('fit')
                            ->join('users as profesor_guia', 'profesor_guia.id_user', '=', 'fit.id_profesorguia')
                            ->join('users as alumno', 'alumno.id_user', '=', 'fit.id_alumno')
                            ->where('fit.id', '=', $idTesis[0]->id)
                            ->select('profesor_guia.email as email_pg','fit.titulo', DB::raw("CONCAT(alumno.nombres,' ',alumno.apellidos) as full_name"))
                            ->get();

        $DatosEmail[0]->fecha = Carbon::now();

        Mail::to($DatosEmail[0]->email_pg)->queue(new MailAvances($DatosEmail[0]));
   
        $rpta               = new Avances();
        $rpta->descripcion  = $request->descripcion;
        $rpta->id_archivo   = $request->id_archivo;
        $rpta->id_tesis     = $idTesis[0]->id;
        $rpta->save(); 
        
        return $rpta;
    }
    public function setRegistrarFinalPdf(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idUser     = Auth::user()->id_user;
        $idTesis    = Fit::select('id')->where('id_alumno',$idUser)->get();

        $IdArchivo = $request->id_archivo;
        Fit::find($idTesis[0]->id)->update(['id_pdftesis'=>$IdArchivo]);
        //NotasPendientes::find($id)->update(['fecha_propuesta'=>$fecha_propuesta]);
    }
    public function setEditarAvance(Request $request){
        if(!$request->ajax()) return redirect('/');
        
        $id             = $request->id;
        $descripcion    = $request->descripcion;
        $id_archivo     = $request->id_archivo;
        $fecha          = Carbon::now();

        //$id_archivo     = ($id_archivo == 0) ? ($id_archivo = 0) : $id_archivo;

        if($id_archivo == 0){
            Avances::find($id)->update(['descripcion'=>$descripcion, 'created_at' =>$fecha]);
            
        }else{
            Avances::find($id)->update(['descripcion'=>$descripcion, 'created_at' =>$fecha, 'id_archivo' =>$id_archivo]);
        }
    }
    public function getEstadoTesis(Request $request){
        if(!$request->ajax()) return redirect('/');

        $idUser     = Auth::user()->id_user;
        $estado    = Fit::select('estado')->where('id_alumno',$idUser)->get();

        return $estado;
    }
}
