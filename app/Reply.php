<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
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

    public function thread()
    {
        return $this->belongsTo(Thread::class);
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
