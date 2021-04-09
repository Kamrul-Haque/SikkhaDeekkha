@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron{
            position: relative;
            width: 100%;
            height: 200px;
            background-color: ghostwhite;
            filter: drop-shadow(0px 1px 1px darkgray);
            background-image: linear-gradient(to left, rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%), url("{{ $course->image_path }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 5;
        }
        .display-4{
            text-shadow: 1px 1px dimgrey!important;
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
        em{
            font-style: normal;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container pb-4">
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <h4 class="display-4">{{ $course->title }}</h4>
                    </div>
                    <div class="col-md-1">
                        @can('access', $course)
                            <div class="dropdown">
                                <button class="dropdown-button float-right pt-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather="settings"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('module.index', $course) }}" class="dropdown-item">Course Modules</a>
                                    @can('rate', $course)
                                        @if(!$course->rated())
                                            <a href="{{ route('student.course.rating', $course) }}" class="dropdown-item">Rate/Review this Course</a>
                                        @else
                                            <a href="{{ route('student.course.rating.edit',['course'=>$course,'rating'=>$course->ratings()->where('student_id',auth()->user()->id)->first()]) }}" class="dropdown-item">Edit Rating/Review</a>
                                        @endif
                                        <button type="submit" class="dropdown-item text-danger" data-toggle="modal" data-target="#unEnroll"><strong>UN-ENROLL</strong></button>
                                    @endcan
                                    @can('modify', $course)
                                        <a href="{{ route('course.edit', $course) }}" class="dropdown-item" title="edit">Edit</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">Delete</button>
                                        <a href="{{ route('course.add.instructor', $course) }}" class="dropdown-item">Add Instructor</a>
                                        <a href="{{ route('course.image.form', $course) }}" class="dropdown-item">Upload/Change Image</a>
                                        <a href="{{ route('module.create',$course) }}" class="dropdown-item">Create Module</a>
                                        <a href="{{ route('announcement.create',$course) }}" class="dropdown-item">Create Announcement</a>
                                        @can('leaveCourse', $course)
                                            <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#leave">Leave Course</button>
                                        @endcan
                                        @can('assignInstitution', $course)
                                            <a href="{{ route('admin.course.assign.institution', $course) }}" class="dropdown-item">Assign Institution</a>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
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
                                @can('modify', $course)
                                    <div class="row d-flex ml-4">
                                        <a href="{{ route('announcement.edit', ['course'=>$course, 'announcement'=>$announcement]) }}" class="text-primary link mr-1">edit</a>
                                        <form action="{{ route('announcement.destroy', ['course'=>$course, 'announcement'=>$announcement]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger delete-button ml-1">delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <br>
        @endif
        <div class="card border-primary">
            <div class="card-header bg-primary text-light">
                <h3>Discussion Panel</h3>
            </div>
            <div class="card-body">
                <p>Discussion panel is the medium of communication between students & course instructors in our fully online course platform.
                    Any disrespectful behaviour will not be tolerated and will be addressed as soon as possible.<em class="text-danger">
                    Anyone using hate speech will be punished and may be banned permanently from the platform.</em></p>
                <br>
                <a href="{{ route('thread.index', ['course'=>$course, 'discussionPanel'=>$course->discussionPanel]) }}" class="btn btn-block btn-primary">Open Discussion Panel</a>
            </div>
        </div>
        <br>
        @forelse($course->modules as $module)
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex">
                        <div class="col-md-11">
                            <h3>{{ $module->module_name }}</h3>
                        </div>
                        @can('modify', $course)
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-block btn-primary btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather="tool"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('content.create', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Create Content</a>
                                    <a href="{{ route('assessment.create', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Create Assessment</a>
                                    <a href="{{ route('module.edit', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Edit Module</a>
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">Delete</button>
                                </div>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body pl-0 pr-0">
                    @forelse($module->contents as $content)
                    <div class="row">
                        <div class="col-md-10">
                            <a href="{{ route('content.show', ['course'=>$course,'module'=>$module,'content'=>$content]) }}" class="pl-4 content-link">{{ $content->title }}</a>
                        </div>
                        @can('modify', $course)
                        <div class="col-md-2 row justify-content-end">
                            <div class="d-flex mr-1">
                                <a href="{{ route('content.edit', ['course'=>$course,'module'=>$module,'content'=>$content]) }}" class="btn btn-sm btn-primary"><span class="feather-content" data-feather="edit"></span></a>
                                <form action="{{ route('content.destroy', ['course'=>$course,'module'=>$module,'content'=>$content]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-1"><span class="feather-content" data-feather="trash-2"></span></button>
                                </form>
                            </div>
                        </div>
                        @endcan
                    </div>
                    <hr>
                    @empty
                    <h5 class="pl-4 pr-4">No Contents Yet</h5>
                    @endforelse
                    @foreach($module->assessments as $assessment)
                        @if(!(auth()->guard('student')->check() && !($assessment->is_published)))
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ route('assessment.show', ['course'=>$course,'module'=>$module,'assessment'=>$assessment]) }}" class="pl-4 content-link">{{ $assessment->title }}</a>
                            </div>
                            @can('modify', $course)
                                <div class="col-md-2 row justify-content-end">
                                    <div class="d-flex mr-1">
                                        <a href="{{ route('assessment.edit', ['course'=>$course,'module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-sm btn-primary"><span class="feather-content" data-feather="edit"></span></a>
                                        <form action="{{ route('assessment.destroy', ['course'=>$course,'module'=>$module,'assessment'=>$assessment]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-1"><span class="feather-content" data-feather="trash-2"></span></button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
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
    </div>
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

    @component('components.modal')
        @slot('id') delete @endslot
        @slot('title') Delete Confirmation @endslot
        @slot('type') danger @endslot
        @slot('action') action="{{ route('course.destroy', $course) }}" @endslot
        @slot('method') DELETE @endslot
        Do you really want to delete the Course? All Contents will be deleted as well!
    @endcomponent
@endsection

@section('scripts')
    <script type='text/javascript'>
        $(function(){
            $('.card-body>hr:last-child').remove();
        });
    </script>
@endsection
