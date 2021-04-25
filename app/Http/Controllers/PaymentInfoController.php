<?php

namespace App\Http\Controllers;

use App\Course;
use App\PaymentInfo;
use Illuminate\Http\Request;

class PaymentInfoController extends Controller
{
    public function index(Course $course)
    {
        $paymentInfos = PaymentInfo::paginate(10);
        return view('PaymentInfo.index', compact('paymentInfos','course'));
    }

    public function create(Course $course)
    {
        return view('PaymentInfo.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'service'=>'required',
            'acc'=>'required|digits:10',
            'type'=>'required',
        ]);

        $paymentInfo = new PaymentInfo();
        $paymentInfo->course_id = $course->id;
        $paymentInfo->method = $request->service;
        $paymentInfo->account_no = $request->acc;
        $paymentInfo->account_type = $request->type;
        $paymentInfo->save();

        return redirect()->route('payment-info.index',$course)->with('toast_success','Created Successfully');
    }

    public function edit(Course $course, PaymentInfo $paymentInfo)
    {
        return view('PaymentInfo.edit',compact('paymentInfo','course'));
    }

    public function update(Request $request, Course $course, PaymentInfo $paymentInfo)
    {
        $request->validate([
            'service'=>'required',
            'acc'=>'required|digits:10',
            'type'=>'required',
        ]);

        $paymentInfo->method = $request->service;
        $paymentInfo->account_no = $request->acc;
        $paymentInfo->account_type = $request->type;
        $paymentInfo->save();

        return redirect()->route('payment-info.index',$course)->with('toast_info','Successfully Updated');
    }

    public function destroy(Course $course, PaymentInfo $paymentInfo)
    {
        $paymentInfo->delete();

        return redirect()->route('payment-info.index',$course)->with('toast_error','Record Deleted');
    }
}
