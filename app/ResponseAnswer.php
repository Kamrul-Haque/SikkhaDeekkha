<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseAnswer extends Model
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

    public function responses()
    {
        return $this->belongsTo(Response::class);
    }
}
