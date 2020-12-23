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
    <div class="container-fluid pl-0 pr-0">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">Courses</h4>
            </div>
        </div>
        <div class="container">
            @forelse($wishlists as $wishlist)
                <div class="card d-flex flex-column">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ ($wishlist->course->image_path) ?  $wishlist->course->image_path : asset('images/No_Image_Available.jpg') }}" class="rounded float-left mb-4 course-image" alt="">
                                <p title="rating"><span data-feather="star" class="pr-2" title="rating"></span>{{ number_format($wishlist->course->ratings()->avg('rating'), 2, '.', ',') }}/10</p>
                                <p title="reviewers"><span data-feather="trending-up" class="pr-2" title="reviewers"></span> {{ $wishlist->course->ratings()->count() }}</p>
                                <p title="enrolled"><span data-feather="users" class="pr-2" title="enrolled"></span> {{ $wishlist->course->students()->count() }}</p>
                                <p title="completed"><span data-feather="check-circle" class="pr-2" title="completed"></span> {{ $wishlist->course->students()->where('has_completed', true)->count() }}</p>
                            </div>
                            <div class="col-md-7">
                                @guest
                                    <a href="{{ route('guest.course.show', $wishlist->course) }}" class="course-title">
                                        <h2>{{ $wishlist->course->title }}</h2>
                                    </a>
                                @else
                                    <a href="{{ route('course.show', $wishlist->course) }}" class="course-title">
                                        <h2>{{ $wishlist->course->title }}</h2>
                                    </a>
                                @endguest
                                <hr>
                                <h3>{{ $wishlist->course->subject->subject_name }}</h3>
                                <h5>{{ $wishlist->course->topic }}</h5>
                                <h6 class="mt-3">Offered by <strong>@foreach($wishlist->course->instructors as $instructor){{ $instructor->name }} @endforeach</strong></h6>
                                <br><br>
                                <div>
                                    @if($wishlist->course->institution)
                                        <h5>This Course is Certified by <strong>{{ $wishlist->course->institution->name }}</strong></h5>
                                        <div>
                                            <img src="{{ $wishlist->course->institution->logo_path }}" class="logo" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <p><span data-feather="book" class="pr-1" title="level"></span> {{ $wishlist->course->level }}</p>
                                <p><span data-feather="bar-chart" class="pr-1" title="difficulty"></span> {{ $wishlist->course->difficulty }}</p>
                                <p><span data-feather="clock" class="pr-1" title="duration"></span> {{ $wishlist->course->duration }}</p>
                                <p><span data-feather="calendar" class="pr-1" title="starts from"></span> {{ $wishlist->course->date_starting }}</p>
                                <p><span data-feather="tag" class="pr-1 @if(!($wishlist->course->fee)) disabled @endif" title="fee"></span> {{ ($wishlist->course->fee) ? $wishlist->course->fee." ".$wishlist->course->currency : "Free"}}</p>
                                <p><span data-feather="award" class="pr-1 @if(!($wishlist->course->has_certificate)) disabled @endif" title="certificate"></span> {{ ($wishlist->course->has_certificate) ? "Offers Certificate" : "No Certificate"}}</p>
                                @guest
                                    <form action="{{ route('student.course.enroll', $wishlist->course) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                                    </form>
                                @else
                                    @if($wishlist->course->hasStudent(Auth::user()->id))
                                        <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1" data-toggle="modal" data-target="#unEnroll"><strong>UN-ENROLL</strong></button>
                                    @elseif(Auth::guard('admin')->check() || Auth::guard('instructor')->check())
                                        <button type="button" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1" disabled><strong>ENROLL</strong></button>
                                    @else
                                        <form action="{{ route('student.course.enroll', $wishlist->course) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-block btn-primary btn-enroll btn-lg mt-1 mb-1"><strong>ENROLL</strong></button>
                                        </form>
                                    @endif
                                @endguest
                                @if(Auth::guard('student')->check() && !($wishlist->where('student_id', Auth::user()->id)->first()))
                                    <form action="{{ route('student.wishlist', $wishlist->course) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-danger wishlist-button"><span data-feather="bookmark" class="pr-2"></span>wishlist for later</button>
                                    </form>
                                @else
                                    <form action="{{ route('student.wishlist.remove', $wishlist->where('student_id', Auth::user()->id)->first()) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-danger wishlist-button">remove from wishlist</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            @empty
                <h4 class="display-4 text-center p-5">NO RECORDS FOUND</h4>
            @endforelse
        </div>
    </div>
@endsection
