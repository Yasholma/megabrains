<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivationalQuote extends Model
{
    protected $fillable = [
        'quotes',
        'motivations_id'
    ];

    public function motivation()
    {
        return $this->belongsTo(Motivations::class);
    }
}
