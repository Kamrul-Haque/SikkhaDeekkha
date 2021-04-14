<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecievedPayment extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
