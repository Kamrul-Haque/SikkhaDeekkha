<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Student::find(Auth::user()->id);
        return view('Student.dashboard', compact('student'));
    }
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

    public function create()
    {
        return view('Student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|confirmed|min:8',
            'study' => 'required',
            'institution' => 'required',
            'phone' => 'nullable|digits:10|unique:students,phone',
        ]);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->study_level = $request->study;
        $student->institution = $request->institution;
        $student->specialization = $request->specialization;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->address = $request->interests;
        $student->save();

        return redirect()->route('admin.student.index')->with('toast_success','Created Successfully');
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
        $student->address = $request->interests;
        $student->save();

        return back()->with('toast_info','Updated Successfully');
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

        return redirect()->route('admin.student.index')->with('toast_error','Record Deleted');
    }

    public function uploadPhotoForm(Student $student)
    {
        $student = Student::find($student->id);
        return view('Student.upload-photo', compact('student'));
    }

    public function uploadPhoto(Request $request, Student $student)
    {
        $request->validate([
            'image'=>'required|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $student = Student::find($student->id);
        $oldPhoto = $student->getOriginal('profile_photo_path');

        if ($request->file('image'))
        {
            if (File::exists($oldPhoto))
            {
                File::delete($oldPhoto);
            }

            $path = $request->file('image')->store('ProfilePhotos');
            $student->profile_photo_path = 'storage/'.$path;
        }
        $student->save();

        return redirect()->route('student.profile')->with('toast_info', 'Successfully Uploaded');
    }

    public function studentLogout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
}
