<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralTest extends Model
{
    protected $fillable = [
        'tutor_id',
        'course_id',
        'test_desc',
        'time'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function g_questions()
    {
        return $this->hasMany(GeneralQuestionOptions::class);
    }
}
