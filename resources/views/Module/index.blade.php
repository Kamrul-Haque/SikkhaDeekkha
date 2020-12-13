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
    </style>
@endsection

@section('content')
    <div class="container pb-4">
        <div class="jumbotron">
            <div class="container">
                <h4 class="display-4">{{ $course->title }}</h4>
            </div>
        </div>
        @forelse($course->modules as $module)
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ $module->module_name }}</h3>
                        </div>
                        @if(Auth::guard('admin')->check() || Auth::guard('instructor')->check())
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-block btn-primary btn-sm float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather="tool"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('content.create', $module) }}" class="dropdown-item">Create Content</a>
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
                        @if(Auth::guard('admin')->check() || Auth::guard('instructor')->check())
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
        @if(Auth::guard('admin')->check() || Auth::guard('instructor')->check())
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
