<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'lecture',
        'lectureVid'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'lesson_student')->withTimestamps();
    }
}
