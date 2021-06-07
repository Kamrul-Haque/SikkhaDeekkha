@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        @if(Auth::guard('admin')->check()) Edit Student @else Update Profile @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" @if(Auth::guard('admin')->check()) action="{{ route('admin.student.update', $student) }}" @else action="{{ route('student.update', $student) }}" @endif>
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" value="{{ $student->name }}" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $student->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="study" class="col-md-4 col-form-label text-md-right">Currently Studying</label>

                                <div class="col-md-6">
                                    <select id="study" type="text" class="form-control @error('study') is-invalid @enderror" name="study" required>
                                        <option value="" selected disabled>Please Select...</option>
                                        <option value="Primary School" @if($student->study_level == "Primary School") selected @endif>Primary School</option>
                                        <option value="High School" @if($student->study_level == "High School") selected @endif>High School</option>
                                        <option value="Secondary" @if($student->study_level == "Secondary") selected @endif>Secondary</option>
                                        <option value="Higher Secondary" @if($student->study_level == "Higher Secondary") selected @endif>Higher Secondary</option>
                                        <option value="Diploma" @if($student->study_level == "Diploma") selected @endif>Diploma</option>
                                        <option value="Undergraduate" @if($student->study_level == "Undergraduate") selected @endif>Undergraduate</option>
                                        <option value="Graduate" @if($student->study_level == "Graduate") selected @endif>Graduate</option>
                                        <option value="Post-Graduate" @if($student->study_level == "Post-Graduate") selected @endif>Post-Graduate</option>
                                    </select>

                                    @error('study')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if($student->faculty)
                            <div id="group" class="form-group row">
                                <label for="faculty" class="col-md-4 col-form-label text-md-right">Faculty</label>

                                <div class="col-md-6">
                                    <select id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" autocomplete="faculty" required>
                                        <option value="" selected disabled>Please Select...</option>
                                        <option value="Science" @if($student->faculty == "Science") selected @endif>Science</option>
                                        <option value="Commerce" @if($student->faculty == "Commerce") selected @endif>Commerce</option>
                                        <option value="Art" @if($student->faculty == "Art") selected @endif>Art</option>
                                    </select>

                                    @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">Institution</label>

                                <div class="col-md-6">
                                    <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ $student->institution }}" required>

                                    @error('institution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="degree" class="form-group row">
                                <label for="specialization" class="col-md-4 col-form-label text-md-right">Specialization</label>

                                <div class="col-md-6">
                                    <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{ $student->specialization }}">

                                    @error('specialization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="interest" class="col-md-4 col-form-label text-md-right">Interest</label>

                                <div class="col-md-6">
                                    <input id="interest" type="text" class="form-control @error('interest') is-invalid @enderror" name="interest" value="">

                                    @error('interest')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+880</span>
                                        </div>
                                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $student->phone }}" required>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ $student->address }}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn @if(Auth::guard('admin')->check()) btn-dark @else btn-primary @endif">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#degree').hide();

            $('#study').change(function (){
                var study = $(this).val();

                switch (study){
                    case "Diploma":
                    case "Undergraduate":
                    case "Graduate":
                    case "Post-Graduate":
                        $('#degree').show();
                        break;
                    default:
                        $('#degree').hide();
                }
            });
            $('#study').change(function (){
                var study = $(this).val();

                switch (study){
                    case "Secondary":
                    case "Higher Secondary":
                    case "Diploma":
                    case "Undergraduate":
                    case "Graduate":
                    case "Post-Graduate":
                        $('#group').show();
                        break;
                    default:
                        $('#group').hide();
                }
            });
        });
    </script>
@endsection
