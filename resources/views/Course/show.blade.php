@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron{
            width: 100%;
            background-color: ghostwhite;
            filter: drop-shadow(0px 1px 1px darkgray);
            padding-bottom: 20px;
            background-image: linear-gradient(to left, rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%), url("{{ $course->image_path }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .display-4{
            text-shadow: 1px 1px deepskyblue!important;
        }
        .dropdown-button{
            border: 0;
            background: transparent;
            color: black;
        }
        .dropdown-button:focus{
            outline: none;
            border: 0;
            color: dodgerblue;
        }
        .course-title{
            color: dodgerblue;
            font-weight: bolder;
        }
        .btn-enroll{
            border-radius: 0;
            font-size: 30px;
        }
        .logo{
            display: block;
            max-height: 75px;
        }
        .card{
            filter: drop-shadow(0px 1px 1px darkgray);
        }
        .headings{
            font-family: Calibri;
        }
        .contents{
            font-family: "Calibri Light";
        }
        .disabled {
            filter: invert(75%);
        }
        .feather{
            height: 20px;
            padding-right: 5px;
            width: auto;
        }
        button::-moz-focus-inner{
            border: 0!important;
        }
        .wishlist-button{
            outline: none;
            background: transparent;
            border: none;
            padding-left: 0;
        }
        .wishlist-button:hover{
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pl-0 pr-0 pb-4">
        <section>
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="display-4 course-title">{{ $course->title }}</h3>
                        </div>
                        <div class="col-md-1">
                            @guest
                            @else
                                @if(Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id) || $course->hasStudent(Auth::user()->id))
                                    <div class="dropdown">
                                        <button class="dropdown-button float-right pt-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span data-feather="settings"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('module.index', $course) }}" class="dropdown-item">Course Modules</a>
                                            @if(Auth::guard('student')->check())
                                                @if(!$course->ratings()->where('student_id',Auth::user()->id)->first())
                                                <a href="{{ route('student.course.rating', $course) }}" class="dropdown-item">Rate/Review this Course</a>
                                                @else
                                                <a href="{{ route('student.course.rating.edit',['course'=>$course,'rating'=>$course->ratings()->where('student_id',Auth::user()->id)->first()]) }}" class="dropdown-item">Edit Rating/Review</a>
                                                @endif
                                            @endif
                                            @if(Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
                                                <a href="{{ route('course.edit', $course) }}" class="dropdown-item" title="edit">Edit</a>
                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">Delete</button>
                                                <a href="{{ route('course.add.instructor', $course) }}" class="dropdown-item">Add Instructor</a>
                                                <a href="{{ route('course.image.form', $course) }}" class="dropdown-item">Upload/Change Image</a>
                                                @if(!Auth::guard('admin')->check())
                                                <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#leave">Leave Course</button>
                                                @endif
                                                @if(Auth::guard('admin')->check() && !($course->institution_id))
                                                    <a href="{{ route('admin.course.assign.institution', $course) }}" class="dropdown-item">Assign Institution</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endguest
                        </div>
                    </div>
                    <h4>{{ $course->subtitle }}</h4>
                    <p class="font-weight-bolder pt-1"><span data-feather="star" class="pr-2" title="rating"></span><strong>{{ number_format($course->ratings()->avg('rating'), 2, '.', ',') }}/10</strong> on <strong>{{ $course->ratings()->count() }}</strong> ratings</p>
                    <div class="row">
                        <div class="col-md-3 pt-5">
                            @guest
                                <form action="{{ route('student.course.enroll', $course) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                                </form>
                            @else
                                @if($course->hasStudent(Auth::user()->id))
                                    <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1" data-toggle="modal" data-target="#unEnroll"><strong>UN-ENROLL</strong></button>
                                @elseif(Auth::guard('admin')->check() || Auth::guard('instructor')->check())
                                    <button type="button" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1" disabled><strong>ENROLL</strong></button>
                                @else
                                    <form action="{{ route('student.course.enroll', $course) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                                    </form>
                                @endif
                            @endguest
                            <p class="font-weight-bolder"><strong>{{ $course->students()->count() }}</strong> students currently enrolled</p>
                            @if(Auth::guard('student')->check() && !($course->hasStudent(Auth::user()->id)))
                                @if(!($course->wishlists()->where('student_id', Auth::user()->id)->first()))
                                    <form action="{{ route('student.wishlist', $course) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-danger wishlist-button"><span data-feather="bookmark" class="pr-2"></span>wishlist for later</button>
                                    </form>
                                @else
                                    <form action="{{ route('student.wishlist.remove', $course->wishlists()->where('student_id', Auth::user()->id)->first()) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-danger wishlist-button">remove from wishlist</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-5 pt-5">

                        </div>
                        <div class="col-md-4 pt-5 text-right">
                            @if($course->institution)
                            <h5>This Course is Certified by<br><strong>{{ $course->institution->name }}</strong></h5>
                            <div class="d-flex justify-content-end">
                                <img src="{{ $course->institution->logo_path }}" class="logo" alt="">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="pb-2 headings">DESCRIPTION</h2>
                        <div>
                            <h5 class="contents">{!! $course->description !!}</h5>
                        </div>
                        <br>
                        <h2 class="pb-2 headings">SYLLABUS</h2>
                        <div>
                            <h5 class="contents">{!! $course->syllabus !!}</h5>
                        </div>
                        <br>
                        <h2 class="pb-2 headings">PREREQUISITES</h2>
                        <div>
                            <h5 class="contents">{!! $course->prerequisites !!}</h5>
                        </div>
                        <br>
                        <h2 class="pb-2 headings">EXPECTED OUTCOME</h2>
                        <div>
                            <h5 class="contents">{!! $course->expected_outcome !!}</h5>
                        </div>
                        <br>
                        <h2 class="pb-2 headings">INSTRUCTORS</h2>
                        @foreach($course->instructors as $instructor)
                        <div class="row">
                            <div class="col-md-1 text-right">
                                <img src="{{ ($instructor->profile_photo_path) ? $instructor->profile_photo_path : asset('images/No_Image_Available.jpg') }}" alt="" class="rounded-circle" width="25px" height="25px">
                            </div>
                            <div class="col-md-5">
                                <h5><strong>{{ $instructor->name }}</strong></h5>
                                <p>{{ $instructor->designation }}, {{ $instructor->institution }}<br>{{ $instructor->about }}</p>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <h2 class="pb-2 headings">Reviews</h2>
                        @foreach($course->ratings as $rating)
                            <div class="row">
                                <div class="col-md-1 text-right">
                                    <img src="{{ ($rating->student->profile_photo_path) ? $rating->student->profile_photo_path : asset('images/No_Image_Available.jpg') }}" alt="" class="rounded-circle" width="25px" height="25px">
                                </div>
                                <div class="col-md-5">
                                    <h5><strong>{{ $rating->student->name }}</strong></h5>
                                    <small class="text-muted">{{ $rating->date }}</small>
                                    <p>{{ $rating->review }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4><span data-feather="book-open" title="level" style="height: 23px; width: auto"></span>SUBJECT:</h4>
                                <h5>{{ $course->subject->subject_name }}</h5>
                                <br>
                                <h4><span data-feather="pie-chart" title="level" style="height: 23px; width: auto"></span>TOPIC:</h4>
                                <h5>{{ $course->topic }}</h5>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h5><span data-feather="book" title="level"></span>LEVEL: {{ $course->level }}</h5>
                                <br>
                                <h5><span data-feather="bar-chart" title="difficulty"></span>DIFFICULTY: {{ $course->difficulty }}</h5>
                                <br>
                                <h5><span data-feather="clock" title="duration"></span>DURATION: {{ $course->duration }}</h5>
                                <br>
                                <h5><span data-feather="calendar" title="starts from"></span>STARTS: {{ $course->date_starting }}</h5>
                                <br>
                                <h5><span data-feather="tag" class="@if(!($course->fee)) disabled @endif" title="fee"></span>FEE: {{ ($course->fee) ? $course->fee." ".$course->currency : "Free"}}</h5>
                                <br>
                                <h5><span data-feather="award" class="@if(!($course->has_certificate)) disabled @endif" title="certificate"></span>{{ ($course->has_certificate) ? "Offers Certificate" : "No Certificate"}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @component('components.modal')
            @slot('id') delete @endslot
            @slot('title') Delete Confirmation @endslot
            @slot('type') danger @endslot
            @slot('action') action="{{ route('course.destroy', $course) }}" @endslot
            @slot('method') DELETE @endslot
            Do you really want to delete the Course? All Contents will be deleted as well!
        @endcomponent

        @component('components.modal')
            @slot('id') unEnroll @endslot
            @slot('title') Un-Enrollment Confirmation @endslot
            @slot('type') danger @endslot
            @slot('action') action="{{ route('student.course.unenroll', $course) }}" @endslot
            Do you really want to Un-Enroll the Course? Your progress will be deleted!
        @endcomponent

        @component('components.modal')
            @slot('id') leave @endslot
            @slot('title') Confirmation @endslot
            @slot('type') danger @endslot
            @slot('action') action="{{ route('course.instructor.leave', $course) }}" @endslot
            Do you really want to leave the Course? Your uploaded contents will still be available!
        @endcomponent
    </div>
@endsection
