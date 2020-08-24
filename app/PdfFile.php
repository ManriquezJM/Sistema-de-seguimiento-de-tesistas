<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfFile extends Model
{
    protected $table = 'pdftesis';

    protected $fillable = [
        'id', 'path', 'filename',
    ];
}
