<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpo extends Model
{
    protected $fillable = [
        'mission',
        'philosophy',
        'objective'
    ];
}
