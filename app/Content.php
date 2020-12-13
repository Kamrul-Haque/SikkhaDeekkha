<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

    public function getFilePathAttribute($value)
    {
        if ($value)
        {
            return asset($value);
        }
    }

    public function getVideoLinkAttribute($value)
    {
        if(strlen($value) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $value;
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
