<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
{
    protected $fillable = [
      'question_id',
      'option_text',
        'correct'
    ];

    public function student_answer()
    {
        return $this->belongsTo('App\StudentTestAnswer', 'answer', 'id');
    }
}
