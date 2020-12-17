<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];

    //returns an accessible http url for the asset from the storage path stored in database
    public function getFilePathAttribute($value)
    {
        if ($value)
        {
            return asset($value);
        }
    }

    //parses the stored url to get only the video key needed for embedded player
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
