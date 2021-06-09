@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student {{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-3 text-right">Email address</label>
                            <div class="input-group col-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                <div class="input-group-append @error('email') invalid-append @enderror">
                                    <span data-feather="mail" class="icon @error('email') invalid-icon @enderror"></span>
                                </div>

                                @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-3 text-right">Password</label>
                            <div class="input-group col-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <div class="input-group-append @error('password') invalid-append @enderror">
                                    <span data-feather="lock" class="icon @error('password') invalid-icon @enderror"></span>
                                </div>

                                @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="col-8">
                                <button type="submit" class="btn btn-primary custom btn">Submit</button>
                                <span class="float-right"><a href="{{ route('student.password.request') }}" class="text-custom">Forgot Your Password?</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
