<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'resource_name',
        'course_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
