<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGeneralTestAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'general_test_id',
        'question_id',
        'answer'
    ];

    public function correct_answer()
    {
        return $this->hasOne('App\GeneralQuestionOptions');
    }

}
