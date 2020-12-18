@extends('layouts.app')

@section('styles')
    <style>
        .container{
            width: 50%;
        }
        label{
            font-size: large!important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-success text-light">
                <h4>Edit Question</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('question.update', ['module'=>$module,'assessment'=>$assessment,'question'=>$question]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="question">Question</label>

                        <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ $question->question }}" required>

                        @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>

                        <select id="type" name="type" type="text" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="MCQ" @if( $question->type == "MCQ") selected @endif>MCQ</option>
                            <option value="Short Question" @if( $question->type == "Short Question") selected @endif>Short Question</option>
                            <option value="Descriptive" @if( $question->type == "Descriptive") selected @endif>Descriptive</option>
                            <option value="File Submission" @if( $question->type == "File Submission") selected @endif>File Submission</option>
                            <option value="Link Submission" @if( $question->type == "Link Submission") selected @endif>Link Submission</option>
                        </select>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="option-group" class="form-group">
                        <label for="option-row">Options</label>

                        @if($question->type == "MCQ")
                            @foreach($question->answers as $key=>$answer)
                            <div id="option-row" class="input-group options py-1">
                                <input id="correct" type="checkbox" name="correct{{$key}}" class="form-check-inline" {{ ($answer->is_correct) ? 'checked' : '' }}>
                                <label for="correct" class="form-check-label">mark as correct</label>
                                <input  type="text" class="form-control ml-2 @error('option.'.$key) is-invalid @enderror" name="option[]" value="{{ $answer->answer }}">
                                <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>

                                @error('option.'.$key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endforeach
                        @else
                            <div id="option-row" class="input-group options">
                                <input id="correct" type="checkbox" name="correct0" class="form-check-inline">
                                <label for="correct" class="form-check-label">mark as correct</label>
                                <input  type="text" class="form-control ml-2" name="option[]" value="{{ old('option.0') }}">
                                <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>

                                @error('option.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div id="option-row" class="input-group options py-1">
                                <input id="correct" type="checkbox" name="correct1" class="form-check-inline">
                                <label for="correct" class="form-check-label">mark as correct</label>
                                <input  type="text" class="form-control ml-2" name="option[]" value="{{ old('option.1') }}">
                                <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>
                            </div>
                        @endif
                        <button id="add-option" type="button" class="btn btn-success"><span class="feather-content" data-feather="plus-circle"></span></button>
                    </div>

                    <div id="answer-group" class="form-group">
                        <label for="answer">Answer</label>
                        <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ $question->answer }}">

                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="answer-group" class="form-group">
                        <label for="marks">Marks</label>
                        <input id="marks" type="text" class="form-control @error('marks') is-invalid @enderror" name="marks" value="{{ $question->marks }}" required>

                        @error('marks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="review-group" class="form-group">
                        <div class="form-check">
                            <input id="review" name="review" type="checkbox" class="form-check-input @error('review') is-invalid @enderror" {{ !($question->needs_review) ? 'checked' : '' }}>
                            <label for="review" class="form-check-label">automatically graded?</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-success">
                                Update
                            </button>
                            <a href="{{ route('assessment.show', ['module'=>$module,'assessment'=>$assessment]) }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var count = $('.options').length;
        $(document).ready(function (){
            if ($('#type').val() == "MCQ"){
                $('#review-group').hide();
                $('#option-group').show();
            }
            else if ($('#type').val() == "Short Question") {
                $('#review-group').show();
                $('input[name="option[]"]').val(null);
                $('.options').each(function (){
                    if ($('.options').length > 2){
                        $(this).closest('#option-row').remove();
                    }
                });
                $('#option-group').hide();
            }
            else {
                $('#review').prop('checked',false);
                $('#review-group').hide();
                $('input[name="option[]"]').val(null);
                $('.options').each(function (){
                    if ($('.options').length > 2){
                        $(this).closest('#option-row').remove();
                    }
                });
                $('#option-group').hide();
            }

            if ($('#review').is(':checked')){
                $('#answer-group').show();
            }
            else{
                $('#answer').val(null);
                $('#answer-group').hide();
            }

            $('#type').on('change',function (){
                if ($(this).val() == "MCQ"){
                    $('#review-group').hide();
                    $('#option-group').show();
                }
                else if ($(this).val() == "Short Question") {
                    $('#review-group').show();
                    $('input[name="option[]"]').val(null);
                    $('.options').each(function (){
                        if ($('.options').length > 2){
                            $(this).closest('#option-row').remove();
                        }
                    });
                    $('#option-group').hide();
                }
                else {
                    $('#review').prop('checked',false);
                    $('#review-group').hide();
                    $('input[name="option[]"]').val(null);
                    $('.options').each(function (){
                        if ($('.options').length > 2){
                            $(this).closest('#option-row').remove();
                        }
                    });
                    $('#option-group').hide();
                }
            });

            $('#review').click(function (){
                if ($('#review').is(':checked')){
                    $('#answer-group').show();
                }
                else{
                    $('#answer').val(null);
                    $('#answer-group').hide();
                }
            });

            $('#add-option').click(function (){
                var element = `<div id="option-row" class="input-group options py-1">
                            <input id="correct" type="checkbox" name="correct`+count+`" class="form-check-inline">
                            <label for="correct" class="form-check-label">mark as correct</label>
                            <input  type="text" class="form-control ml-2" name="option[]">
                            <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>
                        </div>`;

                if ($('.options').length < 10) {
                    $(this).before(element);
                }
                $('input[name="option[]"]:last').val(null);
                $('input[name="correct[]"]:last').prop('checked',false);
                feather.replace();
                count++
            });

            $(document).on('click', '#remove-option', function () {
                if ($('.options').length > 2){
                    $(this).closest('#option-row').remove();
                }
            });
        });
    </script>
@endsection
