@extends('layouts.app')

@section('styles')
    <style>
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
                <h4>Create Content</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('content.store', $module) }}" enctype="multipart/form-data">
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

                        <div id="group" class="form-group">
                            <label for="type">Type</label>

                            <select id="type" name="type" type="text" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="" selected disabled>Please Select...</option>
                                <option value="Text" @if( old('type') === "Text") selected @endif>Text</option>
                                <option value="Video" @if( old('type') === "Video") selected @endif>Video</option>
                                <option value="File" @if( old('type') === "File") selected @endif>File</option>
                            </select>

                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="editor" class="form-group">
                            <label for="description">Description</label>

                            <textarea id="description" class="form-control editor @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description') }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="link" class="form-group">
                            <label for="video-link">Video Link</label>

                            <input id="video-link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="youtube url" value="{{ old('link') }}">

                            @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="file" class="form-group">
                            <label for="content-file">Content File</label>

                            <div id="file" class="custom-file">
                                <input id="content-file" name="file" type="file" class="custom-file-input @error('file') is-invalid @enderror">
                                <label for="content-file" class="custom-file-label">File Name</label>

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input id="protected" name="protected" type="checkbox" class="form-check-input @error('protected') is-invalid @enderror" {{ old('protected') ? 'checked' : '' }}>
                                <label for="protected" class="form-check-label">the file is protected</label>
                            </div>

                            @error('protected')
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
            if ( $('#type').val() == "Video" ){
                $('#link').show();
                $('#file').hide();
                $('#editor').hide();
            }
            else if( $('#type').val() == "File" ){
                $('#file').show();
                $('#link').hide();
                $('#editor').hide();
            }
            else {
                $('#link').hide();
                $('#file').hide();
                $('#editor').show();
            }
        });
        $('#type').on('change',function (){
            if ( $(this).val() == "Video" ){
                $('#link').show();
                $('#content-file').val(null);
                $('#file').hide();
                $('#description').val(null);
                $('#editor').hide();
            }
            else if( $(this).val() == "File" ){
                $('#file').show();
                $('#link').hide();
                $('#video-link').val(null);
                $('#editor').hide();
            }
            else {
                $('#editor').show();
                $('#video-link').val(null);
                $('#link').hide();
                $('#content-file').val(null);
                $('#file').hide();
            }
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
