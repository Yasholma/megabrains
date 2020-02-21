<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($questionId)
 */
class Question extends Model
{
    protected $fillable = [
        'test_id',
        'question',
        'question_image'
    ];

    public function test()
    {
        return $this->hasMany(CourseTest::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOptions::class);
    }
}
