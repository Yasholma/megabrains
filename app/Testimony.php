<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'student_id',
        'testimony'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
}
