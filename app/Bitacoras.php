<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacoras extends Model
{
    protected $table = 'bitacoras';

    protected $fillable = [
        'id', 'comentario','acuerdo', 'fecha'
    ];
}
