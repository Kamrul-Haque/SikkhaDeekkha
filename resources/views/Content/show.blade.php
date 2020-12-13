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
                <h4 class="display-4">{{ $content->title }}</h4>
                <hr>
                <h5>{!! $content->description !!}</h5>
                <br>
                <div class="d-flex justify-content-center">
                    @if($content->type == 'Video')
                        <iframe src="http://www.youtube.com/embed/{{ $content->video_link }}" allowfullscreen></iframe>
                    @elseif($content->type == 'File')
                        <div class="row">
                            <span data-feather="file-text"></span>
                            <a href="{{ $content->file_path }}" class="pl-1">{{ basename($content->file_path) }}</a>
                        </div>
                    @elseif($content->type == 'Link')
                        <a href="{{ $content->web_link }}" class="link">{{ $content->web_link }}</a>
                    @endif
                </div>
                <br>
                <hr>
                <a href="{{ route('module.index', $module->course) }}" class="btn btn-light">Back</a>
            </div>
        </div>
    </div>
@endsection
