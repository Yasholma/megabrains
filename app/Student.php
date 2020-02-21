<?php

namespace App;

use App\Notifications\Student\StudentResetPassword;
use App\Notifications\Student\StudentVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPUnit\Framework\Constraint\Count;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new StudentVerifyEmail);
    }

    public function profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function enroll()
    {
        return $this->hasMany(CourseEnroll::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lecture::class, 'lesson_student');
    }


}
