@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('thread.index', ['course'=>$course, 'discussionPanel'=>$course->discussionPanel]) }}" class="btn btn-light">Back</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="display-4">{{ $thread->subject }}</h4>
                <span class="text-muted">
                    @if( $thread->student_id ) <img src="{{ $thread->student->profile_photo_path }}" alt="profile photo" class="rounded-circle" width="25px" height="25px">
                    {{ $thread->student->name }}
                    @elseif( $thread->instructor_id ) <img src="{{ $thread->instructor->profile_photo_path }}" alt="profile photo" class="rounded-circle" width="25px" height="25px">
                    {{ $thread->instructor->name }}
                    @else <img src="{{ asset('images/No_Image_Available.jpg') }}" alt="profile photo" class="rounded-circle" width="25px" height="25px">
                    <em class="text-danger">Admin</em> @endif</span>
                <span class="text-muted float-right"><small>{{ date('d/m/Y', strtotime($thread->created_at->toDateString())) }}</small></span>
                <hr>
                <p>{!! $thread->body !!}</p>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('thread.edit', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('thread.destroy', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-1">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
