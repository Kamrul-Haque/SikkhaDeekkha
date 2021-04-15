<?php

namespace App;

use App\Notifications\StudentResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'email_verified_at', 'remember_token',
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
        return $this->belongsToMany(Course::class)->withPivot('total_marks_obtained', 'has_completed');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPasswordNotification($token));
    }
}
