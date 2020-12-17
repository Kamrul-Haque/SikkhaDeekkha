@extends('layouts.app')

@section('styles')
    <style>
        .container{
            width: 50%;
        }
        label{
            font-size: large;
        }
        .col-form-label{
            font-size: large!important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-success">
                <h4>Create Question</h4>
            </div>
            <div class="card-body">
                <div id="question-group" class="questions">
                    <div class="form-group">
                        <label for="question">Question</label>

                        <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}">

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
                            <option value="MCQ" @if( old('type') == "MCQ") selected @endif>MCQ</option>
                            <option value="Short Question" @if( old('type') == "Short Question") selected @endif>Short Question</option>
                            <option value="Descriptive" @if( old('type') == "Descriptive") selected @endif>Descriptive</option>
                            <option value="File Submission" @if( old('type') == "File Submission") selected @endif>File Submission</option>
                            <option value="Link Submission" @if( old('type') == "Link Submission") selected @endif>Link Submission</option>
                        </select>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="option-group" class="form-group row">
                        <label for="option" class="col-md-2 col-form-label">Options</label>

                        <div class="col-md-10">
                            <div id="option-row" class="input-group options py-1">
                                <input  type="text" class="form-control" name="option[]">
                                <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>
                            </div>
                            <div id="option-row" class="input-group options py-1">
                                <input  type="text" class="form-control" name="option[]">
                                <button id="remove-option" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>
                            </div>
                            <button id="add-option" type="button" class="btn btn-success"><span class="feather-content" data-feather="plus-circle"></span></button>
                        </div>

                        @error('option[]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="answer-group" class="form-group">
                        <label for="answer">Answer(s)</label>
                        <div id="answer-row" class="input-group answers py-1">
                            <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}">
                            <button id="remove-answer" type="button" class="btn btn-danger"><span class="feather-content" data-feather="trash-2"></span></button>
                        </div>
                        <button id="add-answer" type="button" class="btn btn-success"><span class="feather-content" data-feather="plus-circle"></span></button>

                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="review-group" class="form-group">
                        <div class="form-check">
                            <input id="review" name="review" type="checkbox" class="form-check-input @error('review') is-invalid @enderror" {{ old('review') ? 'checked' : '' }}>
                            <label for="review" class="form-check-label">automatically graded?</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-success">
                                Create
                            </button>
                            <a href="{{ route('module.index', $module->course) }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#type').on('change',function (){
                if ($(this).val() == "MCQ"){
                    $('#answer-group').show();
                    $('#review-group').show();
                    $('#option-group').show();
                    $('#add-answer').show();
                }
                else if ($(this).val() == "Short Question")
                {
                    $('#answer-group').show();
                    $('#review-group').show();
                    $('.options').val(null);
                    $('#option-group').hide();
                    $('#add-answer').hide();
                }
                else {
                    $('#answer').val(null);
                    $('#answer-group').hide();
                    $('#review').val(null);
                    $('#review-group').hide();
                    $('.options').val(null);
                    $('#option-group').hide();
                    $('#add-answer').hide();
                }
            });

            $('#peer').click(function (){
                if ($(this).is(':checked')){
                    $('#review-group').hide();
                    $('#review').prop('checked',false);
                }
                else
                    $('#review-group').show();
            });

            $('#review').click(function (){
                if ($(this).is(':checked')){
                    $('#peer-group').hide();
                    $('#peer').prop('checked',false);
                }
                else
                    $('#peer-group').show();
            });

            $('#add-option').click(function (){
                if ($('.options').length < 10) {
                    $(this).before($('.options:last').clone());
                }
                feather.replace();
            });

            $('#add-answer').click(function (){
                if ($('.answers').length < 10) {
                    $(this).before($('.answers:last').clone());
                }
                feather.replace();
            });

            $(document).on('click', '#remove-option', function () {
                if ($('.options').length > 2){
                    $(this).closest('#option-row').remove();
                }
            });

            $(document).on('click', '#remove-answer', function () {
                if ($('.answers').length > 1){
                    $(this).closest('#answer-row').remove();
                }
            });

            $('#add-question').click(function (){
                $(this).before($('.questions:last').clone());
                feather.replace();
            });
        });
    </script>
@endsection
