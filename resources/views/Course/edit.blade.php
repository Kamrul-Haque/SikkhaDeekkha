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
            <div class="card-header bg-success text-light">
                <h4>Edit Course</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.course.update', $course) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="pl-4 pr-4 pt-1">
                        <div class="form-group">
                            <label for="title">Title</label>

                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $course->title }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level">Level</label>

                            <select id="level" name="level" type="text" class="form-control @error('level') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                <option value="High School" @if( $course->level == "High School") selected @endif>High School</option>
                                <option value="Secondary" @if( $course->level == "Secondary") selected @endif>Secondary</option>
                                <option value="Higher Secondary" @if( $course->level == "Higher Secondary") selected @endif>Higher Secondary</option>
                                <option value="Diploma" @if( $course->level == "Diploma") selected @endif>Diploma</option>
                                <option value="Undergraduate" @if( $course->level == "Undergraduate") selected @endif>Undergraduate</option>
                                <option value="Graduate" @if( $course->level == "Graduate") selected @endif>Graduate</option>
                                <option value="Post-Graduate" @if( $course->level == "Post-Graduate") selected @endif>Post-Graduate</option>
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
                                <option value="Beginner" @if( $course->difficulty == "Beginner") selected @endif>Beginner</option>
                                <option value="Intermediate" @if( $course->difficulty == "Intermediate") selected @endif>Intermediate</option>
                                <option value="Advanced" @if( $course->difficulty == "Advanced") selected @endif>Advanced</option>
                                <option value="Expert" @if( $course->difficulty == "Expert") selected @endif>Expert</option>
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
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ $duration[0] }}" required>
                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <select type="text" class="form-control @error('duration_unit') is-invalid @enderror" name="duration_unit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="Days" @if( $duration[1] == "Days") selected @endif>Days</option>
                                    <option value="Weeks" @if( $duration[1] == "Weeks") selected @endif>Weeks</option>
                                    <option value="Months" @if( $duration[1] == "Months") selected @endif>Months</option>
                                </select>

                                @error('duration_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div id="group" class="form-group">
                            <label for="category">Category</label>

                            <select id="category" name="category" type="text" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $course->category_id) selected @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @error('difficulty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="topic">Topic</label>

                            <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ $course->topic }}" required>

                            @error('topic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_starting">Starting From</label>

                            <input id="date_starting" type="date" class="form-control @error('date_starting') is-invalid @enderror" name="date_starting" required>

                            @error('date_starting')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea id="description" class="form-control editor @error('description') is-invalid @enderror" name="description" rows="5" required>{!!$course->description!!}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="syllabus">Syllabus</label>

                            <textarea id="syllabus" class="form-control editor @error('syllabus') is-invalid @enderror" name="syllabus" rows="7" required>{!! $course->syllabus !!}</textarea>

                            @error('syllabus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prerequisites">Prerequisites</label>

                            <textarea id="prerequisites" class="form-control editor @error('prerequisites') is-invalid @enderror" name="prerequisites" rows="7" required>{!! $course->prerequisites !!}</textarea>

                            @error('prerequisites')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expected_outcome">Expected Outcome</label>

                            <textarea id="expected_outcome" class="form-control editor @error('expected_outcome') is-invalid @enderror" name="expected_outcome" rows="7" required>{!! $course->expected_outcome !!}</textarea>

                            @error('expected_outcome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="marks_required">Required Marks to Complete the Course</label>

                            <input id="marks_required" type="text" class="form-control @error('marks_required') is-invalid @enderror" name="marks_required" placeholder="percentage(%)" value="{{ $course->marks_required_for_completion }}" required>

                            @error('marks_required')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fee">Course Fee</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" id="fee" value="{{ $course->fee }}">
                                    @error('fee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <select type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" id="currency">
                                    <option value="" selected disabled>Select Currency</option>
                                    <option value="BDT" @if( $course->currency === "BDT") selected @endif>BDT</option>
                                    <option value="USD" @if( $course->currency === "USD") selected @endif>USD</option>
                                </select>

                                @error('currency')
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
                                <input id="certificate" name="certificate" type="checkbox" class="form-check-input @error('certificate') is-invalid @enderror" {{ ($course->has_certficate) ? 'checked' : '' }}>
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
                                <input id="paid" name="paid" type="checkbox" class="form-check-input @error('paid') is-invalid @enderror" {{ ($course->is_paid) ? 'checked' : '' }}>
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
                                    Update
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
                    $('#currency').val('disabled', null);
                }
                else
                {
                    $('#fee').attr('disabled', true);
                    $('#fee').val(null);
                    $('#currency').attr('disabled', true);
                    $('#currency').val('disabled', null);
                }
            });
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
