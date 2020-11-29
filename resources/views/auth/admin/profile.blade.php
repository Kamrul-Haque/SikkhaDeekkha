@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header bg-dark text-light">Admin Login</div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <img src="{{ asset('images/No_Image_Available.jpg') }}" alt="" width="175px" height="150px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-5 col-form-label text-md-right">Name:</label>

                        <div class="col-md-7">
                            <label id="name" type="text" class="form-control-plaintext">{{ Auth::user()->name }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-5 col-form-label text-md-right">Email:</label>

                        <div class="col-md-7">
                            <label id="email" type="text" class="form-control-plaintext">{{ Auth::user()->email }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="designation" class="col-md-5 col-form-label text-md-right">Employee ID:</label>

                        <div class="col-md-7">
                            <label id="designation" type="text" class="form-control-plaintext">{{ Auth::user()->employee_id }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="job" class="col-md-5 col-form-label text-md-right">Job Title:</label>

                        <div class="col-md-7">
                            <label id="job" type="text" class="form-control-plaintext">{{ Auth::user()->job_title }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-5 col-form-label text-md-right">Phone:</label>

                        <div class="col-md-7">
                            <label id="phone" type="text" class="form-control-plaintext">{{ Auth::user()->phone }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-5 col-form-label text-md-right">Address:</label>

                        <div class="col-md-7">
                            <label id="address" type="text" class="form-control-plaintext">{{ (Auth::user()->address) ? (Auth::user()->address) : "no address given" }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0 justify-content-center">
                        <div class="pr-2 pl-2">
                            <a href="#" class="btn btn-dark btn-sm">
                                Edit Profile
                            </a>
                            <a href="#" class="btn btn-dark btn-sm">
                                Upload Profile Photo
                            </a>
                            <a href="#" class="btn btn-dark btn-sm">
                                Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
