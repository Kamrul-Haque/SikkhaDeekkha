<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $students = Student::paginate(3);
        return view('Student.index', compact('students'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('Student.create');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        $valid = $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:students',
           'password' => 'required|confirmed|min:8',
           'study' => 'required',
           'institution' => 'required',
           'phone' => 'digits:10|unique:students|required',
        ]);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->study_level = $request->study;
        $student->faculty = $request->faculty;
        $student->institution = $request->institution;
        $student->specialization = $request->specialization;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect('/student');
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    /*public function show(Student $student)
    {

    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Student $student)
    {
        $student = Student::find($student->id);
        return view('Student.edit',compact('student'));
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, Student $student)
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
        $student->faculty = $request->faculty;
        $student->institution = $request->institution;
        $student->specialization = $request->specialization;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect('/student');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Student $student)
    {
        $student = Student::find($student->id);
        $student->delete();

        return redirect('/student');
    }*/

    public function studentLogout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
}
