<?php

namespace App\Policies;

use App\Course;
use App\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function create($user)
    {
        if (auth()->guard('admin')->check())
            return true;
        else if(auth()->guard('instructor')->check())
            if ($user->is_verified)
                return true;
            else return $this->deny('Sorry! You are not verified yet.');
        else return false;
    }

    public function modify($user, Course $course)
    {
        if (auth()->guard('admin')->check())
            return true;
        else if(auth()->guard('instructor')->check())
            return $course->instructors->contains($user);
        else return false;
    }

    public function assignInstitution($user, Course $course)
    {
        if (auth()->guard('admin')->check())
        {
            if (!$course->institution)
                return true;
            else return $this->deny('Institution is already assigned.');
        }
    }

    public function leaveCourse($user, Course $course)
    {
        if(auth()->guard('instructor')->check())
            return $course->instructors->contains($user);
    }

    public function enroll($user, Course $course)
    {
        if(auth()->guard('student')->check())
        {
            if (!$course->students->contains($user))
                return true;
        }
    }

    public function access($user, Course $course)
    {
        if (auth()->guard('admin')->check())
            return true;
        else if(auth()->guard('instructor')->check())
            return $course->instructors->contains($user);
        else if(auth()->guard('student')->check())
        {
            if ($course->students->contains($user))
                return true;
            else return $this->deny('You need to Enroll first!', redirect()->route('course.show', $course));
        }
        else return false;
    }

    public function wishlist($user, Course $course)
    {
        if ($this->enroll($user, $course))
        {
            if (!($course->wishlists()->where('student_id', $user->id)->first()))
                return true;
        }
    }

    public function removeWishlist($user, Course $course)
    {
        if ($this->enroll($user, $course))
        {
            if ($course->wishlists()->where('student_id', $user->id)->first())
                return true;
        }
    }

    public function rate($user, Course $course)
    {
        if (auth()->guard('student')->check())
            return $course->students->contains($user);
    }
}
