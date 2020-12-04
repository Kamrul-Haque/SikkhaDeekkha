@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron{
            width: 100%;
            height: 200px;
            background-color: ghostwhite;
            filter: drop-shadow(0px 2px 2px darkgray);
            background-image: linear-gradient(to left, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 100%), url("{{ asset('images/books-1281581_640.jpg') }}");
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
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
            left: 0;
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
                            <img src="{{ ($course->image_path) ?  $course->image_path : asset('images/No_Image_Available.jpg') }}" class="rounded float-left mb-4 course-image" alt="">
                            <p title="rating"><span data-feather="star" class="pr-2" title="rating"></span> 8.6/10</p>
                            <p title="reviewers"><span data-feather="trending-up" class="pr-2" title="reviewers"></span> 2000</p>
                            <p title="enrolled"><span data-feather="users" class="pr-2" title="enrolled"></span> 1000</p>
                            <p title="completed"><span data-feather="check-circle" class="pr-2" title="completed"></span> 5500</p>
                        </div>
                        <div class="col-md-7">
                            @guest
                            <a href="{{ route('guest.course.show', $course) }}" class="course-title">
                                <h2>{{ $course->title }}</h2>
                            </a>
                            @else
                            <a href="{{ route('course.show', $course) }}" class="course-title">
                                <h2>{{ $course->title }}</h2>
                            </a>
                            @endguest
                            <hr>
                            <h3>{{ $course->subject->subject_name }}</h3>
                            <h5>{{ $course->topic }}</h5>
                            <h6 class="mt-3">Offered by <strong>@foreach($course->instructors as $instructor){{ $instructor->name }} @endforeach</strong></h6>
                            <br><br>
                            <div>
                                <h5>This Course is Certified by <strong>Institution</strong></h5>
                                <div>
                                    <img src="{{ asset('icons/noun_university_213486.svg') }}" class="logo" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p><span data-feather="book" class="pr-1" title="level"></span> {{ $course->level }}</p>
                            <p><span data-feather="bar-chart" class="pr-1" title="difficulty"></span> {{ $course->difficulty }}</p>
                            <p><span data-feather="clock" class="pr-1" title="duration"></span> {{ $course->duration }}</p>
                            <p><span data-feather="calendar" class="pr-1" title="starts from"></span> {{ $course->date_starting }}</p>
                            <p><span data-feather="tag" class="pr-1 @if(!($course->fee)) disabled @endif" title="fee"></span> {{ ($course->fee) ? $course->fee." ".$course->currency : "Free"}}</p>
                            <p><span data-feather="award" class="pr-1 @if(!($course->has_certificate)) disabled @endif" title="certificate"></span> {{ ($course->has_certificate) ? "Offers Certificate" : "No Certificate"}}</p>
                            <form action="{{ route('student.course.enroll', $course) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>Enroll</strong></button>
                            </form>
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
