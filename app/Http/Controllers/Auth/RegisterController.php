<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\Providers\RouteServiceProvider;
use App\Student;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:instructor')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function showStudentRegisterForm()
    {
        return view('Student.create');
    }

    protected function studentCreate(Request $request)
    {
        $student = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|confirmed|min:8',
            'study' => 'required',
            'institution' => 'required',
            'specialization' => 'nullable',
            'phone' => 'nullable|digits:10|unique:students,phone',
            'address' => 'nullable',
            'interests' => 'nullable',
        ]);

        Student::create([
            'name' => $student['name'],
            'email' => $student['email'],
            'password' => Hash::make($student['password']),
            'study_level' => $student['study'],
            'institution' => $student['institution'],
            'specialization' => $student['specialization'],
            'phone' => $student['phone'],
            'address' => $student['address'],
            'interests' => $student['interests'],
        ]);

        return redirect(route('student.login.form'))->with('toast_success','Successfully Registered! Please Login...');
    }

    protected function showInstructorRegisterForm()
    {
        return view('Instructor.create');
    }

    protected function instructorCreate(Request $request)
    {
        $instructor = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:instructors,email',
            'password' => 'required|confirmed|min:8',
            'designation' => 'required',
            'department' => 'required',
            'institution' => 'required',
            'phone' => 'required|digits:10|unique:instructors,phone',
            'address' => 'required',
        ]);

        Instructor::create([
            'name' => $instructor['name'],
            'email' => $instructor['email'],
            'password' => Hash::make($instructor['password']),
            'designation' => $instructor['designation'],
            'department' => $instructor['department'],
            'institution' => $instructor['institution'],
            'phone' => $instructor['phone'],
            'address' => $instructor['address'],
        ]);

        return redirect(route('instructor.login.form'))->with('toast_success','Successfully Registered! Please Login...');
    }
}
