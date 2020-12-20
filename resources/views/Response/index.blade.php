@extends('layouts.app')

@section('styles')
    <style>
        hr{
            width: 100%;
            padding: 0;
        }
        .col-form-label{
            font-size: large;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        @forelse($question->responses as $response)
            <div class="card">
                <div class="card-header pl-0 pr-0">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <img src="{{ $response->student->profile_photo ?? asset('images/No_Image_Available.jpg') }}" alt="" width="30px" height="30px" class="rounded-circle">
                        </div>
                        <div class="col-md-10">
                            <h4 ><strong>{{ $response->student->name }}</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pl-0 pr-0">
                    <div class="pl-4 pr-4">
                        <h4>{{ $question->question }}</h4>
                        <h5>Answers:</h5>
                        @if($response->responseAnswers->first()->attachment_path)
                            <div class="d-flex justify-content-center border p-3">
                                <span data-feather="file-text"></span>
                                <a href="{{ $assessment->attachment_path }}" class="pl-1">{{ basename($assessment->attachment_path) }}</a>
                            </div>
                        @elseif($question->type == 'Descriptive')
                            <h5>{!! $response->responseAnswers->first()->answer !!}</h5>
                        @elseif($question->type == 'Link Submission')
                            <a href="{{ $response->responseAnswers->first()->answer }}" class="link">{{ $response->responseAnswers->first()->answer }}</a>
                        @else
                            @foreach($response->responseAnswers as $answer)
                                <li class="ml-3">{{ $answer->answer }}</li>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    @if($question->needs_review)
                    <form action="{{ route('response.grade',['module'=>$module,'assessment'=>$assessment,'question'=>$question,'response'=>$response]) }}" method="post">
                        @csrf
                        <div class="form-group row pl-2">
                            <label for="marks" class="col-form-label col-md-1 text-right">Marks</label>
                            <div class="col-md-2 pl-0">
                                <input id="marks" type="text" name="marks" class="form-control" value="{{ $response->obtained_marks ?? '' }}">
                            </div>
                            <h4 class="pl-0 pt-2">/{{ $question->marks }}</h4>
                            <div class="col-md-2 pl-2">
                                <button type="submit" class="btn btn-primary">Grade</button>
                            </div>
                        </div>
                    </form>
                    @endif
                    <hr>
                    <a href="{{ route('assessment.show', ['module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-light ml-4">Back</a>
                </div>
            </div>
            <br>
        @empty
            <div class="display-4 text-center">No Responses Yet</div>
        @endforelse
    </div>
@endsection
