<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('Student.index', compact('students'));
    }

    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $student = Student::find($student->id);
        return view('Student.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $valid = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'study' => 'required',
            'institution' => 'required',
            'phone' => 'required|digits:10|unique:students,phone,'.$student->id,
        ]);

        $student = Student::find($student->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->study_level = $request->study;
        $student->institution = $request->institution;
        $student->specialization = $request->specialization;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect()->route('admin.student.index')->with('toast_info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student = Student::find($student->id);
        $student->delete();

        return redirect('/student');
    }

    public function studentLogout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
}
