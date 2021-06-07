@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                Edit Subject
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subject.update', $subject) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="subject">Subject Name</label>
                        <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ $subject->subject_name }}" required>

                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Update</button>
                        <a href="{{ route('admin.subject.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
