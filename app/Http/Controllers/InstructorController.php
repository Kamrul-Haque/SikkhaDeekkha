<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::orderBy('name')->paginate(10);
        return view('instructor.index',compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required',
           'email'=>'required|email|unique:instructors',
           'password'=>'required|min:8|confirmed',
           'password_confirmation'=>'required',
           'designation'=>'required',
           'department'=>'required',
           'institution'=>'required',
           'phone'=>'required|digits:10|unique:instructors',
        ]);

        $instructor = new Instructor;
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->password = Hash::make($request->password);
        $instructor->designation = $request->designation;
        $instructor->department = $request->department;
        $instructor->institution = $request->institution;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->is_verified = false;
        $instructor->save();

        return redirect('/instructor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        $instructor = Instructor::find($instructor->id);
        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:instructors,email,'.$instructor->id,
            'designation'=>'required',
            'department'=>'required',
            'institution'=>'required',
            'phone'=>'required|digits:10|unique:instructors,phone,'.$instructor->id,
        ]);

        $instructor = Instructor::find($instructor->id);
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->designation = $request->designation;
        $instructor->department = $request->department;
        $instructor->institution = $request->institution;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->save();

        return redirect('/instructor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor = Instructor::find($instructor->id);
        $instructor->delete();

        return redirect('/instructor');
    }

    public function instructorLogout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }
}
