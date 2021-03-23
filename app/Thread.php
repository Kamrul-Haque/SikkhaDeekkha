<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

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
