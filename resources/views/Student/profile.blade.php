@extends('layouts.app')

@section('styles')
    <style>
        .bottom{
            padding-top: 50px;
        }
        .container{
            width: 60vh;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">Student Profile</div>

            <div class="card-body pl-4">
                <div class="d-flex row">
                    <div class="col-md-4">
                        <img src="{{ Auth::user()->profile_photo_path ?? asset('images/No_Image_Available.jpg') }}" alt="" width="75px" height="75px" class="rounded">
                    </div>
                    <div class="text-right bottom col-md-8">
                        <h4 class="font-weight-bolder">{{ Auth::user()->name }}</h4>
                    </div>
                </div>
                <hr>

                <div class="form-group row">
                    <label for="email" class="col-md-5 text-right col-form-label">Email:</label>

                    <div class="col-md-7">
                        <label id="email" type="text" class="form-control-plaintext">{{ Auth::user()->email }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="study" class="col-md-5 text-right col-form-label">Currently Studying:</label>

                    <div class="col-md-7">
                        <label id="study" type="text" class="form-control-plaintext">{{ Auth::user()->study_level }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="institution" class="col-md-5 text-right col-form-label">Institution:</label>

                    <div class="col-md-7">
                        <label id="institution" type="text" class="form-control-plaintext">{{ Auth::user()->institution }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="specialization" class="col-md-5 text-right col-form-label">Specialization:</label>

                    <div class="col-md-7">
                        <label id="specialization" type="text" class="form-control-plaintext">{{ Auth::user()->specialization }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-5 text-right col-form-label">Phone:</label>

                    <div class="col-md-7">
                        <label id="phone" type="text" class="form-control-plaintext">{{ (Auth::user()->phone) ? (Auth::user()->phone) : "no phone number given" }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-5 text-right col-form-label">Address:</label>

                    <div class="col-md-7">
                        <label id="address" type="text" class="form-control-plaintext">{{ (Auth::user()->address) ? (Auth::user()->address) : "no address given" }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="interests" class="col-md-5 text-right col-form-label">Interests:</label>

                    <div class="col-md-7">
                        <label id="interests" type="text" class="form-control-plaintext">{{ Auth::user()->interests }}</label>
                    </div>
                </div>
                <hr>

                <div class="form-group row mb-0 justify-content-end">
                    <div class="pr-2 pl-2">
                        <a href="{{ route('student.edit', Auth::user()) }}" class="btn btn-primary btn-sm">
                            Edit Profile
                        </a>
                        <a href="{{ route('student.photo.upload.form', Auth::user()) }}" class="btn btn-primary btn-sm">
                            Upload Profile Photo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
