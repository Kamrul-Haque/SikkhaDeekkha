<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
/*
    //returns the date in custom format
    public function getCreatedAtAttribute($value)
    {
        $value = $this->created_at->toDateString();

        $carbon = new Carbon($value);
        return $carbon->format('d/m/Y');
    }*/

    public function discussionPanel()
    {
        return $this->belongsTo(DiscussionPanel::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function solution()
    {
        return $this->hasOneThrough(Solution::class, Reply::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
