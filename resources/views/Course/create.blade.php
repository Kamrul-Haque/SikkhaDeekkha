@extends('layouts.app')

@section('styles')
    <style>
      .input-group-prepend{
          width: 600px;
      }
      .container{
          width: 50%;
      }
      label{
          font-size: large;
      }
    </style>
@endsection

@section('content')
    <div class="container p-4">
        <div class="card">
            <div class="card-header">Create Course</div>

            <div class="card-body">
                <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="pl-4 pr-4 pt-1">
                        <div class="form-group">
                            <label for="title">Title</label>

                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>

                            <textarea id="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" rows="2" placeholder="1 to 3 sentences" required>{{ old('subtitle') }}</textarea>

                            @error('subtitle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level">Level</label>

                            <select id="level" name="level" type="text" class="form-control @error('level') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                <option value="High School" @if( old('level') === "High School") selected @endif>High School</option>
                                <option value="Secondary" @if( old('level') === "Secondary") selected @endif>Secondary</option>
                                <option value="Higher Secondary" @if( old('level') === "Higher Secondary") selected @endif>Higher Secondary</option>
                                <option value="Diploma" @if( old('level') === "Diploma") selected @endif>Diploma</option>
                                <option value="Undergraduate" @if( old('level') === "Undergraduate") selected @endif>Undergraduate</option>
                                <option value="Graduate" @if( old('level') === "Graduate") selected @endif>Graduate</option>
                                <option value="Post-Graduate" @if( old('level') === "Post-Graduate") selected @endif>Post-Graduate</option>
                            </select>

                            @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="group" class="form-group">
                            <label for="difficulty">Difficulty</label>

                            <select id="difficulty" name="difficulty" type="text" class="form-control @error('difficulty') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                <option value="Beginner" @if( old('difficulty') === "Beginner") selected @endif>Beginner</option>
                                <option value="Intermediate" @if( old('difficulty') === "Intermediate") selected @endif>Intermediate</option>
                                <option value="Advanced" @if( old('difficulty') === "Advanced") selected @endif>Advanced</option>
                                <option value="Expert" @if( old('difficulty') === "Expert") selected @endif>Expert</option>
                            </select>

                            @error('difficulty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration</label>

                            <div id="duration" class="input-group">
                                <input type="text" class="form-control col-md-8 @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required>

                                <select type="text" class="form-control col-md-4 @error('duration_unit') is-invalid @enderror" name="duration_unit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="Days" @if( old('duration_unit') == "Days") selected @endif>Days</option>
                                    <option value="Weeks" @if( old('duration_unit') == "Weeks") selected @endif>Weeks</option>
                                    <option value="Months" @if( old('duration_unit') == "Months") selected @endif>Months</option>
                                </select>

                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div id="group" class="form-group">
                            <label for="subject">Subject</label>

                            <select id="subject" name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if( old('subject') == $subject->id) selected @endif>{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>

                            @error('$subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="topic">Topic</label>

                            <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ old('topic') }}" required>

                            @error('topic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_starting">Starting From</label>

                            <input id="date_starting" type="date" class="form-control @error('date_starting') is-invalid @enderror" name="date_starting" value="{{ old('date_starting') }}" required>

                            @error('date_starting')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea id="description" class="form-control editor @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="syllabus">Syllabus</label>

                            <textarea id="syllabus" class="form-control editor @error('syllabus') is-invalid @enderror" name="syllabus" rows="7" placeholder="we recommend you to use planned module names here." required>{{ old('syllabus') }}</textarea>

                            @error('syllabus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prerequisites">Prerequisites</label>

                            <textarea id="prerequisites" class="form-control editor @error('prerequisites') is-invalid @enderror" name="prerequisites" rows="7" placeholder="use bullets or lists" required>{{ old('prerequisites') }}</textarea>

                            @error('prerequisites')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expected_outcome">Expected Outcome</label>

                            <textarea id="expected_outcome" class="form-control editor @error('expected_outcome') is-invalid @enderror" name="expected_outcome" rows="7" placeholder="use bullets or lists" required>{{ old('expected_outcome') }}</textarea>

                            @error('expected_outcome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="marks_required">Required Marks to Complete the Course</label>

                            <input id="marks_required" type="text" class="form-control @error('marks_required') is-invalid @enderror" name="marks_required" placeholder="percentage(%)" value="{{ old('marks_required') }}" required>

                            @error('marks_required')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fee">Course Fee</label>

                            <div class="input-group">
                                <input type="text" class="form-control col-md-8 @error('fee') is-invalid @enderror" name="fee" id="fee" value="{{ old('fee') }}">

                                <select type="text" class="form-control col-md-4 @error('currency') is-invalid @enderror" name="currency" id="currency">
                                    <option value="" selected disabled>Select Currency</option>
                                    <option value="BDT" @if( old('currency') === "BDT") selected @endif>BDT</option>
                                    <option value="USD" @if( old('currency') === "USD") selected @endif>USD</option>
                                </select>
                                @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image_file">Course image</label>

                            <div id="image_file" class="custom-file">
                                <input id="image" name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror">
                                <label for="image" class="custom-file-label">Image Name</label>

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input id="certificate" name="certificate" type="checkbox" class="form-check-input @error('certificate') is-invalid @enderror" {{ old('certificate') ? 'checked' : '' }}>
                                <label for="certificate" class="form-check-label">the course offers certificate</label>
                            </div>

                            @error('certificate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input id="paid" name="paid" type="checkbox" class="form-check-input @error('paid') is-invalid @enderror" {{ old('paid') ? 'checked' : '' }}>
                                <label for="paid" class="form-check-label">the course is paid</label>
                            </div>

                            @error('paid')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-success">
                                    Create
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function (){
            if ($('#paid').is(":checked"))
            {
                $('#fee').attr('disabled', false);
                $('#currency').attr('disabled', false);
            }
            else
            {
                $('#fee').attr('disabled', true);
                $('#currency').attr('disabled', true);
            }

            $('#paid').click(function ()
            {
                if ($(this).is(":checked"))
                {
                    $('#fee').attr('disabled', false);
                    $('#fee').val(null);
                    $('#currency').attr('disabled', false);
                    $('#currency').val(null);
                }
                else
                {
                    $('#fee').attr('disabled', true);
                    $('#fee').val(null);
                    $('#currency').attr('disabled', true);
                    $('#currency').val(null);
                }
            });
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
