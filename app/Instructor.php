<?php

namespace App;

use App\Notifications\InstructorResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'instructor';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'is_verified' ,'email_verified_at', 'remember_token',
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

    //returns an accessible http url for the asset from the storage path stored in database
    public function getProfilePhotoPathAttribute($value)
    {
        if ($value)
        {
            return asset($value);
        }
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new InstructorResetPasswordNotification($token));
    }
}
