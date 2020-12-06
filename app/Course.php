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

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('total_marks_obtained', 'has_completed');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function contents()
    {
        return $this->hasManyThrough(Content::class, Module::class);
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
        return $this->instructors->contains($id);
    }

    public function hasStudent($id)
    {
        return $this->students->contains($id);
    }
}
