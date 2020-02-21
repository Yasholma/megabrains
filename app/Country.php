<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function student()
    {
        return $this->belongsToMany(Student::class);
    }
}
