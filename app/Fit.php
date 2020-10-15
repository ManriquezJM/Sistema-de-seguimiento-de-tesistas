<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fit extends Model
{
    protected $table = 'fit';

    protected $fillable = [
        'id', 'id_alumno', 'id_profesorguia','id_vinculacion','id_pdftesis','nota','estado','titulo','tipo','objetivo',
        'contribucion','carrera','nombre_int1','rut_int1','email_int1','ingreso_int1','telefono_int1','nombre_int2',
        'rut_int2','email_int2','ingreso_int2','telefono_int2','aprobado_pg','id_actadefensa','descripcion','fecha_ultimoramo'
    ];
}
