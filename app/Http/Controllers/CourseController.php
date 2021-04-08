<?php

namespace App\Http\Controllers;

use App\Course;
use App\Institution;
use App\Instructor;
use App\Rating;
use App\Subject;
use Carbon\Carbon;
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
        $this->authorizeForUser(auth()->user(),'create');

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
        $this->authorizeForUser(auth()->user(),'create');

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

        $course->instructors()->syncWithoutDetaching(auth()->user()->id);
        $course->save();

        return redirect()->route('course.show', $course)->with('toast_success','Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
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
        $this->authorizeForUser(auth()->user(),'modify', $course);

        $duration = explode(" ",$course->duration);
        $subjects = Subject::all();
        return view('Course.edit', compact('course','subjects','duration'));
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
        $this->authorizeForUser(auth()->user(),'modify', $course);

        $request->validate([
            'title'=>'required|string|min:5|unique:courses,title,'.$course->id,
            'subtitle'=>'required|max:150',
            'level'=>'required',
            'difficulty'=>'required',
            'duration'=>'required|max:2',
            'duration_unit'=>'required',
            'subject'=>'required',
            'topic'=>'required',
            'date_starting'=>'required',
            'description'=>'required|string|min:150',
            'syllabus'=>'required|string|min:200',
            'prerequisites'=>'required|string|min:150',
            'expected_outcome'=>'required|string|min:60',
            'marks_required'=>'required|digits_between:1,3|gt:40|lte:100',
            'fee'=>'nullable|gt:0|lte:99999.99',
            'image'=>'nullable|file|mimes:jpeg,jpg,png|max:2024'
        ]);

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
        $course->save();

        return redirect()->route('course.show', $course)->with('toast_info','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'modify', $course);

        $image = $course->getOriginal('image_path');

        if (File::exists($image)) {
            File::delete($image);
        }

        $course->delete();

        return redirect()->route('course.index')->with('toast_error', 'Course Deleted!');
    }

    public function addInstructorForm(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'modify', $course);

        if(Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            return view('Course.add-instructor', compact('course'));
        }
        else
        {
            return back()->with('toast_warning', 'Not authorized to access the page');
        }
    }

    public function addInstructor(Request $request, Course $course)
    {
        $this->authorizeForUser(auth()->user(),'modify', $course);

        $request->validate([
            'uuid' => 'required|min:36|min:36'
        ]);

        $instructor = Instructor::where('UUID', (string)$request->uuid)->get()->first();

        if ($instructor) {
            $course->instructors()->syncWithoutDetaching($instructor->id);

            return redirect()->route('course.show',$course)->with('toast_info', 'Instructor Added!');
        }
        else
        {
            return back()->with('toast_error', 'Incorrect Unique ID');
        }
    }

    public function leaveCourse(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'leaveCourse', $course);

        $instructors = $course->instructors->count();

        if ($instructors > 1)
        {
            $course->instructors()->detach(Auth::user()->id);
            return redirect()->route('course.index')->with('toast_error','You Left the Course');
        }
        else
        {
            return redirect()->route('course.show', $course)->with('toast_warning','You are the only instructor. You can not leave the course!');
        }
    }

    public function enroll(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'enroll', $course);

        if ($course->wishlists()->where('student_id',Auth::user()->id)->first())
        {
            $course->wishlists()->where('student_id',Auth::user()->id)->first()->delete();
        }

        $course->students()->syncWithoutDetaching(Auth::user()->id);

        return redirect()->route('module.index', $course)->with('toast_success', 'Enrollment Successful!');
    }

    public function unenroll(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'access', $course);

        $course->students()->detach(Auth::user()->id);

        return redirect()->route('course.index', $course)->with('toast_info', 'Un-Enrolled from the Course');
    }

    public function imageUploadForm(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'modify', $course);

        return view('Course.upload-image', compact('course'));
    }

    public function imageUpload(Request $request, Course $course)
    {
        $this->authorizeForUser(auth()->user(),'modify', $course);

        $request->validate([
            'image'=>'required|file|mimes:jpeg,jpg,png|max:2024'
        ]);

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

        return redirect()->route('course.show', $course)->with('toast_info','Successfully Uploaded!');
    }

    public function assignInstitutionForm(Course $course)
    {
        $this->authorize('assignInstitution');

        $institutions = Institution::all();
        return view('Course.assign-institution', compact('institutions','course'));
    }

    public function assignInstitution(Request $request, Course $course)
    {
        $this->authorize('assignInstitution');

        $course->institution_id = $request->institution;
        $course->save();

        return redirect()->route('course.show', $course)->with('toast_info','Assigned Successfully!');
    }

    public function ratingForm(Course $course)
    {
        $this->authorizeForUser(auth()->user(),'access', $course);

        return view('Course.rating',compact('course'));
    }

    public function rating(Request $request, Course $course)
    {
        $this->authorizeForUser(auth()->user(),'access', $course);

        $request->validate([
           'rating'=>'required',
           'review'=>'nullable|string|min:20',
        ]);

        $rating = new Rating;
        $rating->course_id = $course->id;
        $rating->student_id = Auth::user()->id;
        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->date = Carbon::today()->toDateString();
        $rating->save();

        return redirect()->route('course.show', $course)->with('toast_success','Rated Successfully!');
    }

    public function editRatingForm(Course $course, Rating $rating)
    {
        $this->authorizeForUser(auth()->user(),'access', $course);

        $rating = Rating::find($rating->id);
        return view('Course.edit-rating',compact('course','rating'));
    }

    public function editRating(Request $request, Course $course, Rating $rating)
    {
        $this->authorizeForUser(auth()->user(),'access', $course);

        $request->validate([
            'rating'=>'required',
            'review'=>'nullable|string|min:20',
        ]);

        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->date = Carbon::today()->toDateString();
        $rating->save();

        return redirect()->route('course.show', $course)->with('toast_info','Rating Updated');
    }
}
