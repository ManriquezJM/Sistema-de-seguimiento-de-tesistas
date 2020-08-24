<?php

namespace App\Http\Controllers;

use App\Avances;
use App\Fit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvancesController extends Controller
{
    public function getListarAvances(Request $request){
        
        if(!$request->ajax()) return redirect('/');

        $idUser  = Auth::id();
        $nIdAvance = $request->nIdAvance;
        
        $idUser = ($idUser == NULL) ? ($idUser = 0) : $idUser;
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

        $avances = DB::table('avancestesis')
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

        $idUser  = Auth::id();
        $nIdAvance = $request->nIdAvance;
        
        $idUser = ($idUser == NULL) ? ($idUser = 0) : $idUser;
        $nIdAvance = ($nIdAvance == NULL) ? ($nIdAvance = 0) : $nIdAvance;
        

        $alumnos = DB::table('fit')
                            ->join('users', 'users.id_user', '=', 'fit.id_alumno')
                            ->select('users.id_user','users.nombres', 'users.apellidos')
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
        
        $idUser = Auth::user()->id_user;
        $idTesis = Fit::select('id')->where('id_alumno',$idUser)->get();
   
        $rpta = new Avances();
        $rpta->descripcion = $request->descripcion;
        $rpta->id_archivo = $request->id_archivo;
        $rpta->id_tesis = $idTesis[0]->id;
        $rpta->save(); 
        
        return $rpta;
    }
    public function setEditarAvance(Request $request){

        if(!$request->ajax()) return redirect('/');
        
        $id =   $request->id;
        Avances::find($id)->update($request->all());

    }
}
