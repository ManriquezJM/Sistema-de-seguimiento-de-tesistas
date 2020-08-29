<?php

namespace App\Http\Controllers;

use App\PdfFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    public function setRegistrarArchivo(Request $request){

        $file = $request->file;
        $bandera = Str::random(10);
        $filename = $file->getClientOriginalName();
        $fileserver = $bandera .'_'. $filename;

        Storage::putFileAs('public/users', $file, $fileserver);

        $rpta = DB::select('call sp_Usuario_setRegistrarArchivo (?, ?)',
                                                                [
                                                                    asset('storage/users/'.$fileserver),
                                                                    $filename                                               
                                                                ]);
        return $rpta;
    }
    public function setRegistrarArchivoPDF(Request $request){

        $file = $request->file;
        $bandera = Str::random(10);
        $filename = $file->getClientOriginalName();
        $fileserver = $bandera .'_'. $filename;

        Storage::putFileAs('public/users', $file, $fileserver);

        /*$rpta = DB::select('call sp_Usuario_setRegistrarArchivo (?, ?)',
                                                                [
                                                                    asset('storage/users/'.$fileserver),
                                                                    $filename                                               
                                                                ]);  */
        $rpta = new PdfFile;
        $rpta->path = asset('storage/users/'.$fileserver);
        $rpta->filename = $filename;
        $rpta->save(); 
        //$nIdFile = $rpta->id;                                                               
        return $rpta;
    }
}
