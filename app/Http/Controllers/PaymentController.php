<?php

namespace App\Http\Controllers;

use App\Course;
use App\Notifications\PaymentConfirmed;
use App\Notifications\PaymentReceived;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('Payment.index', compact('payments'));
    }

    public function create(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'create', [Payment::class, $course]);

        return view('Payment.create', compact('course'));
    }

    public function store(Course $course, Request $request)
    {
        $this->authorizeForUser(auth()->user(),'create', [Payment::class, $course]);

        $request->validate([
           'type'=>'required',
           'acc'=>'required|digits:11',
           'trxid'=>'required|string|unique:payments,transaction_id',
           'amount'=>'required|numeric|in:'.$course->fee
        ]);

        $payment = new Payment();
        $payment->course_id = $course->id;
        $payment->method = $request->type;
        $payment->student_id = auth()->user()->id;
        $payment->account_no = $request->acc;
        $payment->transaction_id = $request->trxid;
        $payment->amount = $request->amount;
        $payment->reference = $request->reference;
        $payment->save();

        $payment->student->notify(new PaymentReceived($payment));

        return redirect()->route('student.home')->with('toast_success','Payment saved successfully!');
    }

    public function edit(Course $course, Payment $payment)
    {
        $this->authorizeForUser(auth()->user(),'update', $payment);

        return view('Payment.edit', compact('course','payment'));
    }

    public function update(Request $request, Course $course, Payment $payment)
    {
        $this->authorizeForUser(auth()->user(),'update', $payment);

        $request->validate([
            'acc'=>'required|digits:11',
            'trxid'=>'required|string|unique:payments,transaction_id,'.$payment->id,
        ]);

        $payment->account_no = $request->acc;
        $payment->transaction_id = $request->trxid;
        $payment->reference = $request->reference;
        $payment->is_edited = true;
        $payment->save();

        return redirect()->route('student.home')->with('toast_info','Payment information updated!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payment.index')->with('toast_error','Payment information deleted!');
    }

    public function verify(Course $course, Payment $payment)
    {
        $payment->is_verified = true;
        $payment->needs_verification = false;
        $payment->save();

        if ($course->wishlists()->where('student_id',$payment->student->id)->first())
        {
            $course->wishlists()->where('student_id',$payment->student->id)->first()->delete();
        }
        $course->students()->syncWithoutDetaching($payment->student->id);

        $payment->student->notify(new PaymentConfirmed($payment));

        return redirect()->route('admin.payment.index')->with('toast_info','Payment Verified!');
    }
}
