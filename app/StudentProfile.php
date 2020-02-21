<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'student_id',
        'picture',
        'gender',
        'phone',
        'address',
//        'country',
//        'state',
//        'city',
//        'postal_code'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
