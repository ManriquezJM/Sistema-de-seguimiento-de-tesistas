<?php

namespace App\Http\Controllers;
use App\Fit;
use App\Bitacoras;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BitacorasController extends Controller
{
    public function getListarMisBitacoras(Request $request){
        if(!$request->ajax()) return redirect('/');

        $IdAlumno = Auth::id();

        $MisBitacoras = DB::table('bitacoras')
                            ->join('fit', 'fit.id', '=', 'bitacoras.id_tesis')
                            ->select('bitacoras.id','bitacoras.fecha', 'bitacoras.acuerdo', 'bitacoras.comentario')
                            ->where('fit.id_alumno', '=', $IdAlumno)
                            ->get();
        return $MisBitacoras;
    }
    public function getListarBitacorasByAlumno(Request $request){
        if(!$request->ajax()) return redirect('/');

        $IdAlumno   = $request->id_user;
        $IdBitacora = $request->nIdBitacora;
        $Bitacoras  = DB::table('bitacoras')
                        ->join('fit', 'fit.id', '=', 'bitacoras.id_tesis')
                        ->select('bitacoras.id','bitacoras.fecha', 'bitacoras.acuerdo', 'bitacoras.comentario')
                        ->where('fit.id_alumno', '=', $IdAlumno)
                        ->OrWhere('bitacoras.id', '=', $IdBitacora)
                        ->orderBy('bitacoras.id', 'desc')
                        ->get();
        return $Bitacoras;
    }

    public function setRegistrarBitacora(Request $request){
        if(!$request->ajax()) return redirect('/');

        $IdAlumno   = $request->id_user;
        $idTesis    = Fit::select('id')->where('id_alumno',$IdAlumno)->get();

        $Bitacora               = new Bitacoras();
        $Bitacora->comentario   = $request->Comentario;
        $Bitacora->acuerdo      = $request->Acuerdo;
        $Bitacora->fecha        = Carbon::now();
        $Bitacora->id_tesis     = $idTesis[0]->id;
        $Bitacora->save();

        return $Bitacora;
    }
    public function setEditarBitacora(Request $request){
        if(!$request->ajax()) return redirect('/');
        
        $id         = $request->nIdBitacora;
        $comentario = $request->comentario;
        $acuerdo    = $request->acuerdo;
        $fecha      = Carbon::now();

        Bitacoras::find($id)->update(['comentario'=>$comentario,'acuerdo'=>$acuerdo,'fecha'=>$fecha]);

        return;
    }
}
