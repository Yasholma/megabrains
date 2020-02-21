<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourseDiscussion extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'comment',
        'parent_id'
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function replies()
    {
        return $this->hasMany(StudentCourseDiscussion::class, 'parent_id')->oldest();
    }
}
