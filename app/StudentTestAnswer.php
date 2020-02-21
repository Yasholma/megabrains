<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'test_id',
        'question_id',
        'answer'
    ];

    public function correct_answer()
    {
        return $this->hasOne('App\QuestionOptions');
    }

}
