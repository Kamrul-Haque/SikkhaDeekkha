@extends('layouts.app')

@section('styles')
    <style>
        iframe{
            width: 100vw;
            height: 56.25vh;
            border: 0;
        }
        .link{
            font-size: large;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h4 class="display-4">{{ $assessment->title }}</h4>
                <hr>
                <h5>{!! $assessment->description !!}</h5>
                <br>
                @if($assessment->attachment_path)
                    <div class="d-flex justify-content-center">
                        <span data-feather="file-text"></span>
                        <a href="{{ $assessment->attachment_path }}" class="pl-1">{{ basename($assessment->attachment_path) }}</a>
                    </div>
                @endif
                <br>
                <h5><span data-feather="calendar"></span> Deadline: {{$assessment->deadline}}</h5>
                <br>
                <hr>
                <a href="{{ route('module.index', $module->course) }}" class="btn btn-light">Back</a>
            </div>
        </div>
    </div>
@endsection
