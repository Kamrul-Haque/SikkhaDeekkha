<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = [];

    //returns an accessible http url for the asset from the storage path stored in database
    public function getAttachmentPathAttribute($value)
    {
        if ($value)
        {
            return asset($value);
        }
    }

    //returns the date in custom format
    public function getDeadlineAttribute($value)
    {
        $carbon = new Carbon($value);
        return $carbon->format('d/m/Y');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class,Question::class);
    }

    public function responses()
    {
        return $this->hasManyThrough(Response::class,Question::class);
    }
}
