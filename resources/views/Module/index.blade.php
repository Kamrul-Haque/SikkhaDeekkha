@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron{
            width: 100%;
            height: 200px;
            background-color: ghostwhite;
            filter: drop-shadow(0px 1px 1px darkgray);
            background-image: linear-gradient(to left, rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%), url("{{ $course->image_path }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        hr{
            width: 100%;
            padding: 0;
        }
        .feather-content{
            width: 15px;
            height: 15px;
            vertical-align: middle;
        }
        .content-link{
            color: black;
            font-size: large;
        }
        a.link:hover{
            text-decoration: underline!important;
        }
        .delete-button{
            outline: none;
            background: transparent;
            border: none;
            padding-left: 0;
        }
        .delete-button:hover{
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="container pb-4">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">{{ $course->title }}</h4>
            </div>
        </div>
        @if($course->announcements->count())
            <br>
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    <h3>Announcements</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($course->announcements as $announcement)
                            <li class="list-group-item border-0">
                                <div class="row d-flex">
                                    <span data-feather="info" class="flex-column pt-1 mx-2"></span>
                                    <div class="content-link flex-column">
                                        {{ $announcement->message }}
                                    </div>
                                </div>
                                @if(auth()->guard('admin')->check() || auth()->guard('instructor')->check())
                                    <div class="row d-flex ml-4">
                                        <a href="{{ route('announcement.edit', ['course'=>$course, 'announcement'=>$announcement]) }}" class="text-primary link mr-1">edit</a>
                                        <form action="{{ route('announcement.destroy', ['course'=>$course, 'announcement'=>$announcement]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger delete-button ml-1">delete</button>
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <br>
        @endif
        @forelse($course->modules as $module)
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ $module->module_name }}</h3>
                        </div>
                        @if(auth()->guard('admin')->check() || auth()->guard('instructor')->check())
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-block btn-primary btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather="tool"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('content.create', $module) }}" class="dropdown-item">Create Content</a>
                                    <a href="{{ route('assessment.create', $module) }}" class="dropdown-item">Create Assessment</a>
                                    <a href="{{ route('module.edit', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Edit Module</a>
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">Delete</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pl-0 pr-0">
                    @forelse($module->contents as $content)
                    <div class="row">
                        <div class="col-md-10">
                            <a href="{{ route('content.show', ['module'=>$module,'content'=>$content]) }}" class="pl-4 content-link">{{ $content->title }}</a>
                        </div>
                        @if(auth()->guard('admin')->check() || auth()->guard('instructor')->check())
                        <div class="col-md-2 row justify-content-end">
                            <div class="d-flex mr-1">
                                <a href="{{ route('content.edit', ['module'=>$module,'content'=>$content]) }}" class="btn btn-sm btn-primary"><span class="feather-content" data-feather="edit"></span></a>
                                <form action="{{ route('content.destroy', ['module'=>$module,'content'=>$content]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-1"><span class="feather-content" data-feather="trash-2"></span></button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    @empty
                    <h5 class="pl-4 pr-4">No Contents Yet</h5>
                    @endforelse
                    @foreach($module->assessments as $assessment)
                        @if(!(auth()->guard('student')->check() && !($assessment->is_published)))
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ route('assessment.show', ['module'=>$module,'assessment'=>$assessment]) }}" class="pl-4 content-link">{{ $assessment->title }}</a>
                            </div>
                            @if(auth()->guard('admin')->check() || auth()->guard('instructor')->check())
                                <div class="col-md-2 row justify-content-end">
                                    <div class="d-flex mr-1">
                                        <a href="{{ route('assessment.edit', ['module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-sm btn-primary"><span class="feather-content" data-feather="edit"></span></a>
                                        <form action="{{ route('assessment.destroy', ['module'=>$module,'assessment'=>$assessment]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-1"><span class="feather-content" data-feather="trash-2"></span></button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr>
                        @endif
                    @endforeach
                </div>
            </div>
            <br>
            @component('components.modal')
                @slot('id') delete @endslot
                @slot('title') Delete Confirmation @endslot
                @slot('type') danger @endslot
                @slot('method') DELETE @endslot
                @slot('action') action="{{ route('module.destroy', ['course'=>$course,'module'=>$module]) }}" @endslot
                Do you really want to delete the Module? All Contents inside will be deleted as well!
            @endcomponent
        @empty
            <div class="text-center">
                <h4>No Module Yet</h4>
            </div>
        @endforelse
        @if(auth()->guard('admin')->check() || auth()->guard('instructor')->check())
        <div>
            <a href="{{ route('module.create',$course) }}" class="btn btn-block btn-success"><strong>CREATE MODULE</strong></a>
        </div>
        @else
        <div>
            <button type="button" class="btn btn-block btn-primary btn-lg mt-1 mb-1" data-toggle="modal" data-target="#unEnroll"><strong>UN-ENROLL</strong></button>
        </div>
        @endif
    </div>
    @component('components.modal')
        @slot('id') unEnroll @endslot
        @slot('title') Un-Enrollment Confirmation @endslot
        @slot('type') danger @endslot
        @slot('action') action="{{ route('student.course.unenroll', $course) }}" @endslot
        Do you really want to Un-Enroll the Course? Your progress will be deleted!
    @endcomponent
@endsection

@section('scripts')
    <script type='text/javascript'>
        $(function(){
            $('.card-body>hr:last-child').remove();
        });
    </script>
@endsection
