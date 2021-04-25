<?php

namespace App\Http\Controllers;

use App\Course;
use App\ReceivedPayment;
use Illuminate\Http\Request;

class ReceivedPaymentController extends Controller
{
    public function index(Course $course)
    {
        $receivedPayments = ReceivedPayment::latest()->paginate(10);
        return view('Received-Payment.index', compact('receivedPayments', 'course'));
    }

    public function create(Course $course)
    {
        return view('Received-Payment.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'type'=>'required',
            'acc'=>'required|digits:10',
            'trxid'=>'required|string|unique:received_payments,transaction_id',
            'amount'=>'required|numeric|in:'.$course->fee,
            'date'=>'required|before_or_equal:today'
        ]);

        $receivedPayment = new ReceivedPayment();
        $receivedPayment->course_id = $course->id;
        $receivedPayment->method = $request->type;
        $receivedPayment->account_no = $request->acc;
        $receivedPayment->transaction_id = $request->trxid;
        $receivedPayment->amount = $request->amount;
        $receivedPayment->reference = $request->reference;
        $receivedPayment->date = $request->date;
        $receivedPayment->save();

        return redirect()->route('received-payment.index',$course)->with('toast_success','Payment saved successfully!');
    }

    public function edit(Course $course, ReceivedPayment $receivedPayment)
    {
        return view('Received-Payment.edit', compact('course','receivedPayment'));
    }

    public function update(Request $request, Course $course, ReceivedPayment $receivedPayment)
    {
        $request->validate([
            'type'=>'required',
            'acc'=>'required|digits:10',
            'trxid'=>'required|string|unique:received_payments,transaction_id,'.$receivedPayment->id,
            'amount'=>'required|numeric|in:'.$course->fee,
            'date'=>'required|before_or_equal:today'
        ]);

        $receivedPayment->account_no = $request->acc;
        $receivedPayment->method = $request->type;
        $receivedPayment->transaction_id = $request->trxid;
        $receivedPayment->amount = $request->amount;
        $receivedPayment->reference = $request->reference;
        $receivedPayment->date = $request->date;
        $receivedPayment->save();

        return redirect()->route('received-payment.index',$course)->with('toast_success','Payment saved successfully!');
    }

    public function destroy(Course $course, ReceivedPayment $receivedPayment)
    {
        $receivedPayment->delete();

        return redirect()->route('received-payment.index',$course)->with('toast_error','Payment Deleted');
    }
}
