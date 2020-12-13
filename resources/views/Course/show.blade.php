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
            filter: invert(70%);
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
                            @if((Auth::guard('admin')->check()) || (Auth::guard('instructor')->check() && $course->hasInstructor(Auth::user()->id)))
                            <div class="dropdown">
                                <button class="dropdown-button float-right pt-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather="settings"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('module.index', $course) }}" class="dropdown-item">Course Modules</a>
                                    <a href="{{ route('course.edit', $course) }}" class="dropdown-item" title="edit">Edit</a>
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">Delete</button>
                                    <a href="{{ route('course.add.instructor', $course) }}" class="dropdown-item">Add Instructor</a>
                                    <a href="{{ route('course.image.form', $course) }}" class="dropdown-item">Upload/Change Image</a>
                                    <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#leave">Leave Course</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h4>{{ $course->subtitle }}</h4>
                    <p class="font-weight-bolder pt-1"><span data-feather="star" class="pr-2" title="rating"></span><strong>8.6/10</strong> on <strong>2000</strong> ratings</p>
                    <div class="row">
                        <div class="col-md-3 pt-5">
                            @if(Auth::guard('student')->check() && $course->hasStudent(Auth::user()->id))
                                <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1" data-toggle="modal" data-target="#unEnroll"><strong>UN-ENROLL</strong></button>
                            @elseif(Auth::guard('student')->check())
                                <form action="{{ route('student.course.enroll', $course) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                                </form>
                            @else
                                <button type="button" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                            @endif
                            <p class="font-weight-bolder"><strong>5000</strong> students currently enrolled</p>
                            <a href="#" class="text-danger pt-0" style="font-size: medium"><span data-feather="bookmark" class="pr-2"></span>wishlist for later</a>
                        </div>
                        <div class="col-md-5 pt-5">

                        </div>
                        <div class="col-md-4 pt-5 text-right">
                            <h5>This Course is Offered/Certified by <strong>Institution Name</strong></h5>
                            <div class="d-flex justify-content-end">
                                <img src="{{ asset('icons/noun_university_213486.svg') }}" class="logo" alt="">
                            </div>
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
