<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTest extends Model
{

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }


}
