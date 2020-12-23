<?php

namespace App\Http\Controllers;

use App\Course;
use App\Institution;
use App\Instructor;
use App\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $institutions = Institution::all();
        $students = Student::all();
        $courses = Course::all();
        $instructors = Instructor::all();
        return view('welcome',compact('institutions','students','courses','instructors'));
    }
}
