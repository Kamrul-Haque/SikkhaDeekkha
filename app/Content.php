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

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
