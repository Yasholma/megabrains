<?php

namespace App;

use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $fillable = [
        'admin_id',
        'picture',
        'gender',
        'phone',
        'address',
        'facebook',
        'twitter',
        'linkedin'
    ];



}
