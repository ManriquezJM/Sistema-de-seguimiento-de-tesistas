<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotasPendientes extends Model
{
    protected $table = 'notaspendientes';

    protected $fillable = [
        'id', 'fecha_presentacion', 'fecha_propuesta', 'fecha_autorizada', 'fecha_prorroga', 'estado'
    ];
}
