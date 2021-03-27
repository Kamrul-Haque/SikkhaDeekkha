<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function createdAtTime()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->getOriginal('created_at'))->format('h:ia');
    }

    public function hasSolution()
    {
        foreach ($this->replies as $reply)
        {
            if ($reply->is_solution)
                return $reply->id;
        }

        return false;
    }

    public function discussionPanel()
    {
        return $this->belongsTo(DiscussionPanel::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
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
