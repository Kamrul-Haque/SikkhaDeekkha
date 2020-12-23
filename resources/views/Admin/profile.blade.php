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
            <div class="card-header bg-dark text-light">Admin Profile</div>

            <div class="card-body pl-4">
                <h4 class="font-weight-bolder">{{ Auth::user()->name }}</h4>
                <hr>

                <div class="form-group row">
                    <label for="email" class="col-md-5 text-right col-form-label">Email:</label>

                    <div class="col-md-7">
                        <label id="email" type="text" class="form-control-plaintext">{{ Auth::user()->email }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="designation" class="col-md-5 text-right col-form-label">Employee ID:</label>

                    <div class="col-md-7">
                        <label id="designation" type="text" class="form-control-plaintext">{{ Auth::user()->employee_id }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="job" class="col-md-5 text-right col-form-label">Job Title:</label>

                    <div class="col-md-7">
                        <label id="job" type="text" class="form-control-plaintext">{{ Auth::user()->job_title }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-5 text-right col-form-label">Phone:</label>

                    <div class="col-md-7">
                        <label id="phone" type="text" class="form-control-plaintext">{{ Auth::user()->phone }}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-5 text-right col-form-label">Address:</label>

                    <div class="col-md-7">
                        <label id="address" type="text" class="form-control-plaintext">{{ (Auth::user()->address) ? (Auth::user()->address) : "no address given" }}</label>
                    </div>
                </div>
                <hr>

                <div class="form-group row mb-0 justify-content-end">
                    <div class="pr-2 pl-2">
                        <a href="{{ route('admin.admin.edit', Auth::user()) }}" class="btn btn-dark btn-sm">
                            Edit Profile
                        </a>
                        <a href="#" class="btn btn-dark btn-sm">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
