<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Course $course)
    {
        $payments = Payment::latest()->paginate(10);
        return view('Payment.index', compact('payments','course'));
    }

    public function create(Course $course)
    {
        return view('Payment.create', compact('course'));
    }

    public function store(Course $course, Request $request)
    {
        $request->validate([
           'acc'=>'required|integer',
           'trxid'=>'required|string|unique:payment,transaction_id',
           'amount'=>'required|numeric|gt:0',
        ]);

        $payment = new Payment();
        $payment->course_id = $course->id;
        $payment->student_id = auth()->user()->id;
        $payment->account_no = $request->acc;
        $payment->transaction_id = $request->trxid;
        $payment->amount = $request->amount;
        $payment->reference = $request->reference;
        $payment->save();

        return redirect()->route('student.home')->with('toast_success','Payment saved successfully!');
    }

    public function edit(Course $course, Payment $payment)
    {
        return view('Payment.edit', compact('course','payment'));
    }

    public function update(Request $request, Payment $payment, Course $course)
    {
        $request->validate([
            'acc'=>'required|integer',
            'trxid'=>'required|string|unique:payment,transaction_id'.$payment->id,
            'amount'=>'required|numeric|gt:0',
        ]);

        $payment->account_no = $request->acc;
        $payment->transaction_id = $request->trxid;
        $payment->amount = $request->amount;
        $payment->reference = $request->reference;
        $payment->save();

        return redirect()->route('student.home')->with('toast_info','Payment information updated!');
    }

    public function destroy(Course $course, Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payment.index')->with('toast_error','Payment information deleted!');
    }

    public function verify(Course $course, Payment $payment)
    {
        $payment->is_verified = true;
        $payment->save();

        return redirect()->route('payment.index')->with('toast_info','Payment Verified!');
    }
}
