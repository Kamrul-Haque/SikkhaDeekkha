<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedPayment extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
