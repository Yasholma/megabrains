<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGeneralTestResult extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'test_id',
        'result'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


}
