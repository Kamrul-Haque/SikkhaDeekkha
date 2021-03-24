@extends('layouts.app')

@section('styles')
    <style>
        .content-link{
            color: black;
            font-size: large;
        }
        .jumbotron{
            width: 100%;
            height: 200px;
            background-color: ghostwhite;
            filter: drop-shadow(0px 2px 2px darkgray);
            background-image: linear-gradient(to left, rgba(255,255,255,0.8) 0%,rgba(255,255,255,0.8) 100%), url("{{ asset('images/discussion.jpg') }}");
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pl-0 pr-0">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">Discussion Panel</h4>
            </div>
        </div>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <h4>Filter</h4>
                        <div class="list-group-item">
                            <a href="#" class="content-link">General Discussion</a>
                        </div>
                        @foreach($course->modules as $module)
                            <div class="list-group-item px-0">
                                <h4 class="content-link pl-3"><strong>{{ $module->module_name }}</strong></h4>
                                <hr>
                                @foreach($module->contents as $content)
                                <div class="pl-4">
                                    <a href="#" class="content-link pl-2">{{ $content->title }}</a>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9">
                    <h4>Posts</h4>
                    <div class="card">
                        <div class="card-body">
                            @forelse($threads as $thread)
                            <div>
                                <a href="{{ route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread]) }}" class="content-link">{{ $thread->subject }}</a>
                                <span class="text-success">solved!</span>
                                <span class="float-right text-muted"><small>{{ date('d/m/Y', strtotime($thread->created_at->toDateString())) }}</small></span>
                                <br>
                                <span class="text-muted">posted by @if( $thread->student_id ) {{ $thread->student->name }} @elseif( $thread->instructor_id ) {{ $thread->instructor->name }} @else <em class="text-danger">Admin</em> @endif</span>
                                <p>{!! Str::limit($thread->body,250) !!}</p>
                            </div>
                            <hr>
                            @empty
                                <h4 class="text-center">No Threads Yet.</h4>
                            @endforelse
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div class="d-block">
                            <a href="{{ route('module.index', $course) }}" class="btn btn-light">Back</a>
                        </div>
                        {{ $threads->links() }}
                        <div class="d-block">
                            <a href="{{ route('thread.create', ['course'=>$course, 'discussionPanel'=>$discussionPanel]) }}" class="float-right btn btn-outline-success mb-1">New Post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type='text/javascript'>
        $(function(){
            $('.card-body>hr:last-child').remove();
            $('.list-group-item>hr:last-child').remove();
        });
    </script>
@endsection
