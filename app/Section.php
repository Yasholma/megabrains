<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'section',
        'sectionDesc'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class)->oldest();
    }

}
