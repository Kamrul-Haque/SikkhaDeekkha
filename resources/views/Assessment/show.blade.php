@extends('layouts.app')

@section('styles')
    <style>
        label{
            font-size: large;
        }
        .form-check-label{
            font-size: medium;
        }
        .feather-content{
            height: 15px;
            width: 15px;
            padding-bottom: 2px;
        }
        a.sidebar {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            font-size: 20px;
        }
        a.child {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            font-size: 14px;
        }
        a:hover, a:focus {
            text-decoration: none !important;
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        #sidebar {
            position: fixed;
            padding-top: 35px;
            min-width: 300px;
            max-width: 300px;
            min-height: 100vh;
            max-height: 100vh;
            background: white;
            -webkit-transition: all 1s;
            -o-transition: all 1s;
            transition: all 1s;
            z-index: 50;
        }
        #sidebar ul.components {
            padding: 0;
        }
        #sidebar ul li {
            font-size: 14px;
        }
        #sidebar ul li > ul {
            margin-left: 10px;
        }
        #sidebar ul li > ul li {
            font-size: 12px;
        }
        #sidebar ul li a {
            padding: 15px 0;
            display: block;
            color: dodgerblue;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        #sidebar ul li a:hover {
            color: black;
        }
        #sidebar ul li.active > a {
            background: transparent;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 0;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h4 class="display-4 col-md-10">{{ $assessment->title }}</h4>
                    <h5 class="col-md-2 text-right"><strong><span data-feather="calendar" title="deadline"></span> {{$assessment->deadline}}</strong></h5>
                </div>
                <hr>
                <h5>{!! $assessment->description !!}</h5>
                <br>
                @if($assessment->attachment_path)
                    <div class="d-flex justify-content-center border p-3">
                        <span data-feather="file-text"></span>
                        <a href="{{ $assessment->attachment_path }}" class="pl-1">{{ basename($assessment->attachment_path) }}</a>
                    </div>
                @endif
                <br>
                @foreach($assessment->questions as $question)
                    @if(Auth::guard('student')->check())
                    <form action="{{ route('response.store',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" method="post" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="answer">{{$loop->iteration}}. {{ $question->question }}</label>
                            <span class="float-right text-muted">{{ $question->marks }} marks</span>
                            @if($question->type == 'MCQ')
                                @if($question->hasMultipleAnswers())
                                    @foreach($question->answers as $answer)
                                        <div class="custom-control custom-checkbox">
                                            <input id="option{{$loop->iteration}}" type="checkbox" name="options[]" class="custom-control-input @error('options') is-invalid @enderror" value="{{ $answer->answer }}">
                                            <label for="option{{$loop->iteration}}" class="custom-control-label">{{ $answer->answer }}</label>

                                            @error('options')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($question->answers as $answer)
                                        <div class="custom-control custom-radio">
                                            <input id="answer{{$loop->iteration}}" type="radio" name="answer" class="custom-control-input @error('answer') is-invalid @enderror" value="{{ $answer->answer }}" required>
                                            <label for="answer{{$loop->iteration}}" class="custom-control-label">{{ $answer->answer }}</label>

                                            @error('answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                @endif
                            @elseif($question->type == 'Descriptive')
                                <textarea name="answer" rows="5" class="form-control editor @error('answer') is-invalid @enderror" required></textarea>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @elseif($question->type == 'File Submission')
                                <div class="custom-file">
                                    <input id="attachment" name="attachment" type="file" class="custom-file-input @error('attachment') is-invalid @enderror" required>
                                    <label for="attachment" class="custom-file-label">File Name</label>

                                    @error('attachment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @elseif($question->type == 'Link Submission')
                                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" required>

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @else
                                <input id="answer" type="text" name="answer" class="form-control @error('answer') is-invalid @enderror" required>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @endif
                        </div>
                        @if(Auth::guard('student')->check())
                            @if($question->responses()->where('student_id',Auth::user()->id)->first())
                            <span class="font-weight-bold">Marks Obtained: {{ $question->responses()->where('student_id',Auth::user()->id)->first()->obtained_marks ?? 'Pending Review' }}</span>
                            @else
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            @endif
                        @else
                            <div class="d-flex">
                                @if(!($assessment->is_published))
                                <a href="{{ route('question.edit',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" class="btn btn-sm btn-primary"><span data-feather="edit" class="feather-content"></span></a>
                                <form action="{{ route('question.destroy',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger ml-1"><span data-feather="trash-2" class="feather-content"></span></button>
                                </form>
                                @else
                                <a href="{{ route('response.index',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" class="btn btn-sm btn-success ml-1"><span data-feather="eye" class="feather-content"></span> Responses</a>
                                @endif
                            </div>
                        @endif
                    @if(Auth::guard('student')->check())
                    </form>
                    @endif
                    <br>
                @endforeach
                @if(!(Auth::guard('student')->check()))
                    @if(!($assessment->is_published))
                    <br>
                    <a href="{{ route('question.create',['module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-success">Create Question</a>
                    @endif
                @endif
                <hr>
                <div class="d-flex">
                    <a href="{{ route('module.index', $module->course) }}" class="btn btn-light">Back</a>
                    @if(!($assessment->is_published) && !(Auth::guard('student')->check()))
                    <form action="{{ route('assessment.publish', ['module'=>$module,'assessment'=>$assessment]) }}" method="post">
                        @csrf
                        <button class="btn btn-primary ml-1">Publish</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
