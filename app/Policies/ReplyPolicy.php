<?php

namespace App\Policies;

use App\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function modify($user, Reply $reply)
    {
        if ($reply->instructor_id)
        {
            return $reply->instructor->is($user);
        }
        elseif ($reply->student_id)
        {
            return $reply->student->is($user);
        }
        else
        {
            return auth()->guard('admin')->check();
        }
    }
}
