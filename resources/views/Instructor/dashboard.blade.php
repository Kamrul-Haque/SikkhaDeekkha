@extends('layouts.app')

@section('styles')
    <style>
        .logo{
            display: block;
            max-height: 50px;
            left: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <h4 class="display-4 text-center">Your Courses</h4>
        <br>
        <div class="row">
            <div class="col-md-4">
                @foreach($instructor->courses as $course)
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('course.show', $course) }}" class="course-title">
                                <h2>{{ $course->title }}</h2>
                            </a>
                            <hr>
                            <h3>{{ $course->subject->subject_name }}</h3>
                            <h5>{{ $course->topic }}</h5>
                            <div class="row">
                                <p title="rating" class="col-md-3"><span data-feather="star" class="pr-2" title="rating"></span>{{ number_format($course->ratings()->avg('rating'), 2, '.', ',') }}</p>
                                <p title="reviewers" class="col-md-3"><span data-feather="trending-up" class="pr-2" title="reviewers"></span> {{ $course->ratings()->count() }}</p>
                                <p title="enrolled" class="col-md-3"><span data-feather="users" class="pr-2" title="enrolled"></span> {{ $course->students()->count() }}</p>
                                <p title="completed" class="col-md-3"><span data-feather="check-circle" class="pr-2" title="completed"></span> {{ $course->students()->where('has_completed', true)->count() }}</p>
                            </div>
                            <hr>
                            <div>
                                @if($course->institution)
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ $course->institution->logo_path }}" class="logo" alt="">
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div>
                                <a href="{{ route('module.index', $course) }}" class="btn btn-block btn-success">Resume</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
