<?php

namespace App\Policies;

use App\Course;
use App\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        if (auth()->guard('admin')->check())
            return true;
    }

    public function create($user, Course $course)
    {
        if (auth()->guard('student')->check())
        {
            if (!($course->payments()->where('student_id', $user->id)->first()))
                return true;
            else return $this->deny('You have already paid for the course!');
        }
    }

    public function update($user, Payment $payment)
    {
        if (auth()->guard('student')->check())
        {
            if (!$payment->is_edited)
                return true;
            else return $this->deny('You can edit payment information only once.');
        }
    }
}
