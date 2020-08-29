<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avances extends Model
{
    protected $table = 'avancestesis';

    protected $fillable = [
        'id', 'descripcion', 'id_archivo', 'id_tesis','created_at'
    ];
}
