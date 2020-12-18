<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //check if the question has multiple correct answers
    public function hasMultipleAnswers()
    {
        $count = 0;
        foreach ($this->answers as $answer)
        {
            if ($answer->is_correct)
            {
                $count++;
            }
        }
        if ($count > 1)
        {
            return true;
        }
        else
            return false;
    }
}
