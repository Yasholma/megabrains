<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralQuestionOptions extends Model
{
    protected $fillable = [
        'general_question_id',
        'option_text',
        'correct'
    ];

    public function student_answer()
    {
        return $this->belongsTo('App\StudentTestAnswer', 'answer', 'id');
    }
}
