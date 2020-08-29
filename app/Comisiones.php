<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    protected $table = 'comisiones';

    protected $fillable = [
        'id','id_tesis', 'id_profesor1','id_profesor2', 'p_externo', 'correo_p_externo', 'institucion_p_externo'
    ];
}
