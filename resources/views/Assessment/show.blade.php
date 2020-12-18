@extends('layouts.app')

@section('styles')
    <style>
        label{
            font-size: large;
        }
        .form-check-label{
            font-size: medium;
        }
        .feather{
            height: 15px;
            width: 15px;
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
                    <form action="#" method="post" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="answer">{{ $question->question }}</label>
                            @if($question->type == 'MCQ')
                                @if($question->hasMultipleAnswers())
                                    @foreach($question->answers as $answer)
                                        <div class="form-check">
                                            <input id="option" type="checkbox" name="options[]" class="form-check-input @error('options.*') is-invalid @enderror" value="{{ $answer->answer }}">
                                            <label for="option" class="form-check-label">{{ $answer->answer }}</label>
                                        </div>
                                    @endforeach

                                    @error('options.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @else
                                    @foreach($question->answers as $answer)
                                        <div class="form-check">
                                            <input id="option" type="radio" name="option" class="form-check-input @error('option') is-invalid @enderror" value="{{ $answer->answer }}">
                                            <label for="option" class="form-check-label">{{ $answer->answer }}</label>
                                        </div>
                                    @endforeach

                                    @error('option')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @endif
                            @elseif($question->type == 'Descriptive')
                                <textarea name="answer" rows="5" class="form-control editor @error('answer') is-invalid @enderror"></textarea>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @elseif($question->type == 'File Submission')
                                <div class="custom-file">
                                    <input id="attachment" name="attachment" type="file" class="custom-file-input @error('attachment') is-invalid @enderror">
                                    <label for="attachment" class="custom-file-label">File Name</label>

                                    @error('attachment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @elseif($question->type == 'Link Submission')
                                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror">

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @else
                                <input id="answer" type="text" name="answer" class="form-control @error('answer') is-invalid @enderror">

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            @endif
                        </div>
                        @if(Auth::guard('student')->check())
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        @else
                            <div class="d-flex">
                                <a href="{{ route('question.edit',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" class="btn btn-sm btn-primary"><span data-feather="edit"></span></a>
                                <form action="{{ route('question.destroy',['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger ml-1"><span data-feather="trash-2"></span></button>
                                </form>
                            </div>
                        @endif
                    @if(Auth::guard('student')->check())
                    </form>
                    @endif
                    <br>
                @endforeach
                <br>
                <a href="{{ route('question.create',['module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-success">Create Question</a>
                <hr>
                <a href="{{ route('module.index', $module->course) }}" class="btn btn-light">Back</a>
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
