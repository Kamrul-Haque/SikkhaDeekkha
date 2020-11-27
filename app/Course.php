<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class);
    }

    public function getImagePathAttribute($value)
    {
        if ($value)
        {
            return asset($value);
        }
    }

    public function getDateStartingAttribute($value)
    {
        $carbon = new Carbon($value);
        return $carbon->format('d/m/Y');
    }

    public function hasInstructor($id)
    {
        foreach ($this->instructors as $instructor)
        {
            if ($instructor->id == $id)
            {
                return true;
            }
        }
        return false;
    }
}
