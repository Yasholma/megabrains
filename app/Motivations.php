<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivations extends Model
{

    protected $fillable = [
        'video',
        'active'
    ];

    public function quotes()
    {
        return $this->hasMany(MotivationalQuote::class);
    }
}
