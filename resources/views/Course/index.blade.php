@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron{
            width: 100%;
            background-color: aqua;
            filter: drop-shadow(0px 1px 1px darkgray);
        }
        .card{
            filter: drop-shadow(0px 1px 1px darkgray);
        }
        .card:hover{
            filter: drop-shadow(1px 3px 3px darkgray);
        }
        hr{
            width: 100%;
        }
        .disabled{
            filter: invert(75%);
        }
        .btn-block{
            border-radius: 0;
        }
        .btn-block:hover{
            filter: drop-shadow(0 3px 3px darkgray);
        }
        .logo{
            display: block;
            max-height: 75px;
            filter: invert(70%);
        }
        .course-image{
            width: 250px;
            height: auto;
            max-height: 130px;
        }
        a.course-title{
            font-family: Helvetica;
        }
        a.course-title:hover,a.course-title:focus{
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pl-0 pr-0">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">Courses</h4>
            </div>
        </div>
        <div class="container">
            @forelse($courses as $course)
            <div class="card d-flex flex-column">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="@if($course->course_image) {{ $course->course_image }} @else {{ asset('images/No_Image_Available.jpg') }} @endif" class="rounded float-left mb-4 course-image" alt="">
                            <p title="rating"><span data-feather="star" class="pr-2" title="rating"></span> 8.6/10</p>
                            <p title="reviewers"><span data-feather="trending-up" class="pr-2" title="reviewers"></span> 2000</p>
                            <p title="enrolled"><span data-feather="users" class="pr-2" title="enrolled"></span> 1000</p>
                            <p title="completed"><span data-feather="check-circle" class="pr-2" title="completed"></span> 5500</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('admin.course.show', $course) }}" class="course-title">
                                <h2>{{ $course->title }}</h2>
                            </a>
                            <hr>
                            <h3>{{ $course->category->category_name }}</h3>
                            <h5>{{ $course->topic }}</h5>
                            <h6 class="mt-3">Offered by <strong>Instructors name</strong></h6>
                            <br><br>
                            <div>
                                <h5>This Course is Certified by <strong>Institution</strong></h5>
                                <div class="text-left">
                                    <img src="{{ asset('icons/noun_university_213486.svg') }}" class="logo" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p><span data-feather="book" class="pr-1" title="level"></span> {{ $course->level }}</p>
                            <p><span data-feather="bar-chart" class="pr-1" title="difficulty"></span> {{ $course->difficulty }}</p>
                            <p><span data-feather="clock" class="pr-1" title="duration"></span> {{ $course->duration }}</p>
                            <p><span data-feather="calendar" class="pr-1" title="starts from"></span> {{ $course->date_starting }}</p>
                            <p><span data-feather="tag" class="pr-1 @if(!($course->fee)) disabled @endif" title="fee"></span> {{ ($course->fee) ? $course->fee : "Free"}}</p>
                            <p><span data-feather="award" class="pr-1 @if(!($course->has_certificate)) disabled @endif" title="certificate"></span> {{ ($course->has_certificate) ? "Offers Certificate" : "No Certificate"}}</p>
                            <button class="btn btn-block btn-primary mt-1 mb-1">Enroll</button>
                            <a href="#" class="text-danger"><span data-feather="bookmark" class="pr-2"></span>wishlist for later</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @empty
                <h4 class="display-4 text-center p-5">NO RECORDS FOUND</h4>
            @endforelse
        </div>
        <div class="col-sm-4 d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
