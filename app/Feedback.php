<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'student_id',
        'feedback'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
