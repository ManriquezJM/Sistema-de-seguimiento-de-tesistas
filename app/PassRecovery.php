<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassRecovery extends Model
{
    protected $table = 'password_resets';
    public $timestamps = false;
}
