<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
      'certificate_id',
      'student_name',
      'student_image',
      'course_name',
      'grade'
    ];
}
