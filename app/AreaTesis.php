<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaTesis extends Model
{
    protected $table = 'areatesis';

    protected $fillable = [
        'id', 'nombre', 'id_escuela',
    ];
}
