<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralQuestion extends Model
{
    protected $fillable = [
        'general_test_id',
        'question',
        'question_image'
    ];

    public function test()
    {
        return $this->hasMany(GeneralTest::class);
    }

    public function options()
    {
        return $this->hasMany(GeneralQuestionOptions::class);
    }
}
