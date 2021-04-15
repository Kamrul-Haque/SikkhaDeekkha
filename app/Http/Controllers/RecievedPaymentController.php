<?php

namespace App\Http\Controllers;

use App\RecievedPayment;
use Illuminate\Http\Request;

class RecievedPaymentController extends Controller
{
    public function index(Course $course)
    {
        $recievedPayments = RecievedPayment::latest()->paginate(10);
        return view('Recieved-Payment.index', compact('recievedPayments', 'course'));
    }

    public function create(Course $course)
    {
        return view('Recieved-Payment.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'acc'=>'required|integer',
            'trxid'=>'required|string|unique:recieved_payments,transaction_id',
            'amount'=>'required|numeric|gt:0',
            'date'=>'required|before_or_equal:today'
        ]);

        $recievedPayment = new RecievedPayment();
        $recievedPayment->course_id = $course->id;
        $recievedPayment->account_no = $request->acc;
        $recievedPayment->transaction_id = $request->trxid;
        $recievedPayment->amount = $request->amount;
        $recievedPayment->date = $request->date;
        $recievedPayment->save();

        return redirect()->route('module.index',['course'=>$course, 'module'=>$course->module])->with('toast_success','Payment saved successfully!');
    }

    public function edit(Course $course, RecievedPayment $recievedPayment)
    {
        return view('Recieved-Payment.edit', compact('course','recievedPayment'));
    }

    public function update(Request $request, Course $course, RecievedPayment $recievedPayment)
    {
        $request->validate([
            'acc'=>'required|integer',
            'trxid'=>'required|string|unique:recieved_payments,transaction_id',
            'amount'=>'required|numeric|gt:0',
            'date'=>'required|before_or_equal:today'
        ]);

        $recievedPayment->account_no = $request->acc;
        $recievedPayment->transaction_id = $request->trxid;
        $recievedPayment->amount = $request->amount;
        $recievedPayment->date = $request->date;
        $recievedPayment->save();

        return redirect()->route('module.index',['course'=>$course, 'module'=>$course->module])->with('toast_success','Payment saved successfully!');
    }

    public function destroy(Course $course, RecievedPayment $recievedPayment)
    {
        $recievedPayment->destroy();

        return redirect()->route('module.index',['course'=>$course, 'module'=>$course->module])->with('toast_error','Payment Deleted');
    }
}
