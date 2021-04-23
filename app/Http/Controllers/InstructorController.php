<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Notifications\AccountVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    public function dashboard()
    {
        $instructor = Instructor::find(Auth::user()->id);
        return view('Instructor.dashboard', compact('instructor'));
    }
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
           'about'=>'required|string|min:5',
        ]);

        $instructor = new Instructor;
        $instructor->UUID = str::uuid()->toString();
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->password = Hash::make($request->password);
        $instructor->designation = $request->designation;
        $instructor->department = $request->department;
        $instructor->institution = $request->institution;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->about = $request->about;
        $instructor->is_verified = false;
        $instructor->save();

        return redirect()->route('admin.instructor.index')->with('toast_success','Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        $instructor = Instructor::find($instructor->id);
        return view('Instructor.show', compact('instructor'));
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
        $instructor->about = $request->about;
        $instructor->save();

        return redirect('/')->with('toast_info','Updated Successfully');
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

        return redirect('instructor')->with('toast_error','Record Deleted');
    }

    public function instructorLogout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }

    public function uploadPhotoForm(Instructor $instructor)
    {
        $instructor = Instructor::find($instructor->id);
        return view('Instructor.upload-photo', compact('instructor'));
    }

    public function uploadPhoto(Request $request, Instructor $instructor)
    {
        $request->validate([
            'image'=>'required|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $instructor = Instructor::find($instructor->id);
        $oldPhoto = $instructor->getOriginal('profile_photo_path');

        if ($request->file('image'))
        {
            if (File::exists($oldPhoto))
            {
                File::delete($oldPhoto);
            }

            $path = $request->file('image')->store('ProfilePhotos');
            $instructor->profile_photo_path = 'storage/'.$path;
        }
        $instructor->save();

        return redirect()->route('instructor.profile')->with('toast_info', 'Successfully Uploaded');
    }

    public function verify(Instructor $instructor)
    {
        $instructor->is_verified = true;
        $instructor->save();

        $instructor->notify(new AccountVerified());

        return redirect()->route('admin.instructor.index')->with('toast_info', 'Instructor Account Verified');
    }
}
