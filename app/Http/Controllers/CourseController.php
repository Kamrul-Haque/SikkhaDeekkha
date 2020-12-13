<?php

namespace App\Http\Controllers;

use App\Course;
use App\Instructor;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('title')->paginate('10');
        return view('Course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('Course.create',compact('subjects'));
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
           'title'=>'required|string|min:5|unique:courses',
           'subtitle'=>'required|max:150',
           'level'=>'required',
           'difficulty'=>'required',
           'duration'=>'required|max:2',
           'duration_unit'=>'required',
           'subject'=>'required',
           'topic'=>'required',
           'date_starting'=>'required|after:today',
           'description'=>'required|string|min:150',
           'syllabus'=>'required|string|min:200',
           'prerequisites'=>'required|string|min:150',
           'expected_outcome'=>'required|string|min:60',
           'marks_required'=>'required|digits_between:1,3|gt:40|lte:100',
           'fee'=>'nullable|gt:0|lte:99999.99',
           'image'=>'nullable|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $course = new Course;
        $course->title = $request->title;
        $course->subtitle = $request->subtitle;
        $course->level = $request->level;
        $course->difficulty = $request->difficulty;
        $course->duration = $request->duration.' '.$request->duration_unit;
        $course->subject_id = $request->subject;
        $course->topic = $request->topic;
        $course->date_starting = $request->date_starting;
        $course->description = $request->description;
        $course->syllabus = $request->syllabus;
        $course->prerequisites = $request->prerequisites;
        $course->expected_outcome = $request->expected_outcome;
        $course->completion_marks = $request->marks_required;
        $course->fee = $request->fee;
        $course->currency = $request->currency;
        $course->has_certificate = $request->has('certificate');
        $course->is_paid = $request->has('paid');

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('CourseImage');
            $course->image_path = 'storage/'.$path;
        }

        $course->save();

        if (Auth::guard('instructor')->check())
        {
            $course->instructors()->syncWithoutDetaching(Auth::user()->id);
        }

        return redirect()->route('course.index')->with('toast_success','Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course = Course::find($course->id);
        return view('Course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if(Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            $course = Course::find($course->id);
            $duration = explode(" ",$course->duration);
            $subjects = Subject::all();
            return view('Course.edit', compact('course','subjects','duration'));
        }
        else
        {
            return back()->with('toast_warning', 'Not authorized to access the page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'=>'required|string|min:5|unique:courses,title,'.$course->id,
            'subtitle'=>'required|max:150',
            'level'=>'required',
            'difficulty'=>'required',
            'duration'=>'required|max:2',
            'duration_unit'=>'required',
            'subject'=>'required',
            'topic'=>'required',
            'date_starting'=>'required|after:today',
            'description'=>'required|string|min:150',
            'syllabus'=>'required|string|min:200',
            'prerequisites'=>'required|string|min:150',
            'expected_outcome'=>'required|string|min:60',
            'marks_required'=>'required|digits_between:1,3|gt:40|lte:100',
            'fee'=>'nullable|gt:0|lte:99999.99',
            'image'=>'nullable|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $course = Course::find($course->id);
        $course->title = $request->title;
        $course->subtitle = $request->subtitle;
        $course->level = $request->level;
        $course->difficulty = $request->difficulty;
        $course->duration = $request->duration.' '.$request->duration_unit;
        $course->subject_id = $request->subject;
        $course->topic = $request->topic;
        $course->date_starting = $request->date_starting;
        $course->description = $request->description;
        $course->syllabus = $request->syllabus;
        $course->prerequisites = $request->prerequisites;
        $course->expected_outcome = $request->expected_outcome;
        $course->completion_marks = $request->marks_required;
        $course->fee = $request->fee;
        $course->currency = $request->currency;
        $course->has_certificate = $request->has('certificate');
        $course->is_paid = $request->has('paid');
        $oldImage = $course->getOriginal('image_path');

        if($request->hasFile('image'))
        {
            if (File::exists($oldImage))
            {
                File::delete($oldImage);
            }
            $path = $request->file('image')->store('CourseImage');
            $course->image_path = 'storage/'.$path;
        }

        $course->save();

        return redirect()->route('course.index')->with('toast_info','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course = Course::find($course->id);
        $image = $course->getOriginal('image_path');

        if (File::exists($image)) {
            File::delete($image);
        }

        $course->delete();

        return redirect()->route('course.index')->with('toast_error', 'Course Deleted!');
    }

    public function addInstructorForm(Course $course)
    {
        if(Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            $course = Course::find($course->id);
            return view('Course.add-instructor', compact('course'));
        }
        else
        {
            return back()->with('toast_warning', 'Not authorized to access the page');
        }
    }

    public function addInstructor(Request $request, Course $course)
    {
        $request->validate([
            'uuid' => 'required|min:36|min:36'
        ]);

        $instructor = Instructor::where('UUID', (string)$request->uuid)->get()->first();

        if ($instructor) {
            $course = Course::find($course->id);
            $course->instructors()->syncWithoutDetaching($instructor->id);

            return redirect()->route('course.index')->with('toast_info', 'Instructor Added!');
        }
        else
        {
            return back()->with('toast_error', 'Incorrect Unique ID');
        }
    }

    public function leaveCourse(Course $course)
    {
        if (Auth::guard('instructor')->check() && $course->hasInstructor(Auth::user()->id))
        {
            $course = Course::find($course->id);
            $instructors = $course->instructors->count();

            if ($instructors > 1)
            {
                $course->instructors()->detach(Auth::user()->id);
                return redirect()->route('course.show', $course)->with('toast_error','You Left the Course');
            }
            else
            {
                return redirect()->route('course.show', $course)->with('toast_warning','You are the only instructor. You can not leave the course!');
            }
        }
        else
        {
            return back()->with('toast_warning', 'Not authorized to access');
        }
    }

    public function enroll(Course $course)
    {
        $course = Course::find($course->id);
        $course->students()->syncWithoutDetaching(Auth::user()->id);

        return redirect()->route('module.index', $course)->with('toast_success', 'Enrollment Successful!');
    }

    public function unenroll(Course $course)
    {
        $course = Course::find($course->id);
        $course->students()->detach(Auth::user()->id);

        return redirect()->route('course.index', $course)->with('toast_info', 'Un-Enrolled from the Course');
    }

    public function imageUploadForm(Course $course)
    {
        $course = Course::find($course->id);
        return view('Course.upload-image', compact('course'));
    }

    public function imageUpload(Request $request, Course $course)
    {
        $request->validate([
            'image'=>'required|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $course = Course::find($course->id);
        $oldImage = $course->getOriginal('image_path');

        if($request->hasFile('image'))
        {
            if (File::exists($oldImage))
            {
                File::delete($oldImage);
            }
            $path = $request->file('image')->store('CourseImage');
            $course->image_path = 'storage/'.$path;
        }

        $course->save();

        return redirect()->route('course.index')->with('toast_info','Successfully Uploaded!');
    }
}
