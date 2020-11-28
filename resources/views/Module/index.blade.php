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
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">{{ $course->title }}</h4>
            </div>
        </div>
        @forelse($course->modules as $module)
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11">
                                <h3>{{ $module->module_name }}</h3>
                            </div>
                            <div class="col-md-1">
                                <div class="dropdown">
                                    <button class="btn btn-block btn-primary btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span data-feather="tool"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                        @if(Auth::guard('admin')->check())
                                            <a href="#" class="dropdown-item">Create Content</a>
                                            <a href="{{ route('admin.course.module.edit', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Edit Module</a>
                                        @else
                                            <a href="#" class="dropdown-item">Create Content</a>
                                            <a href="{{ route('instructor.course.module.edit', ['course'=>$course,'module'=>$module]) }}" class="dropdown-item">Edit Module</a>
                                        @endif
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#dynamicModal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pl-0 pr-0">
                        <h6 class="pl-4 pr-4">Content 1</h6>
                        <hr>
                        <h6 class="pl-4 pr-4">Content 2</h6>
                        <hr>
                        <h6 class="pl-4 pr-4">Content 3</h6>
                    </div>
                </div>
                <br>
            </div>
            @component('components.modal')
                @slot('title') Delete Confirmation @endslot
                @slot('type') danger @endslot
                @slot('action') @if(Auth::guard('instructor')->check()) action="{{ route('instructor.course.module.destroy', ['course'=>$course,'module'=>$module]) }}" @elseif(Auth::guard('admin')->check()) action="{{ route('admin.course.module.destroy', ['course'=>$course,'module'=>$module]) }}" @endif @endslot
                Do you really want to delete the Module? All Contents inside will be deleted as well!
            @endcomponent
        @empty
            <div class="text-center">
                <h4>No Module Yet</h4>
            </div>
        @endforelse
        @if(Auth::guard('admin')->check())
            <div>
                <a href="{{ route('admin.course.module.create',$course, $course) }}" class="btn btn-block btn-success"><strong>CREATE MODULE</strong></a>
            </div>
        @else
            <div>
                <a href="{{ route('instructor.course.module.create',$course, $course) }}" class="btn btn-block btn-success"><strong>CREATE MODULE</strong></a>
            </div>
        @endif
    </div>
@endsection
