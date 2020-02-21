<?php

namespace App;

use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'category_id',
        'imagePath',
        'description',
        'price',
    ];

    public function cleanString($string)
    {
        // allow only letters
        $res = preg_replace("/[^a-zA-Z0-9]/", "", $string);

        // trim what's left to 8 chars
//        $res = substr($res, 0, 8);

        // make lowercase
        $res = strtolower($res);

        // return
        return $res;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Admin::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->oldest();
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class)->oldest();
    }

    public function enroll()
    {
        return $this->belongsTo(CourseEnroll::class);
    }

    public function getRatingAttribute()
    {
        return number_format(CourseEnroll::where('course_id', $this->attributes['id'])->average('rating'));
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lecture::class, 'lesson_student');
    }

    public function tests()
    {
        return $this->hasMany(CourseTest::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function discussions()
    {
        return $this->hasMany(StudentCourseDiscussion::class)->where('parent_id', '=', null)->latest();
    }
}
