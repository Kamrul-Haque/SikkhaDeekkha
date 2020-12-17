@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header bg-success text-light">
                Edit Module
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('module.update', ['course'=>$course,'module'=>$module]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="module_name" class="col-md-4 col-form-label text-md-right">Edit Module</label>

                        <div class="col-md-6">
                            <input id="module_name" type="text" class="form-control @error('module_name') is-invalid @enderror" name="module_name" value="{{ $module->module_name }}" required autofocus>

                            @error('module_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                Edit
                            </button>
                            <a href="{{ route('module.index', $course) }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
