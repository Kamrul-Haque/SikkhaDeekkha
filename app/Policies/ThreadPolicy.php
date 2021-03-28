<?php

namespace App\Policies;

use App\Thread;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function modify($user, Thread $thread)
    {
        if ($thread->instructor_id)
        {
            return $thread->instructor->is($user);
        }
        elseif ($thread->student_id)
        {
            return $thread->student->is($user);
        }
        else
        {
            return auth()->guard('admin')->check();
        }
    }
}
