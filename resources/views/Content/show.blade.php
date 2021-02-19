@extends('layouts.app')

@section('styles')
    <style>
        iframe{
            width: 100vw;
            height: 56.25vh;
            border: 0;
        }
        .link{
            font-size: large;
        }
        a.sidebar {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            font-size: 20px;
        }
        a.child {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            font-size: 14px;
        }
        a:hover, a:focus {
            text-decoration: none !important;
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        #sidebar {
            position: fixed;
            padding-top: 35px;
            min-width: 300px;
            max-width: 300px;
            min-height: 100vh;
            max-height: 100vh;
            background: white;
            -webkit-transition: all 1s;
            -o-transition: all 1s;
            transition: all 1s;
            z-index: 50;
        }
        #sidebar ul.components {
            padding: 0;
        }
        #sidebar ul li {
            font-size: 14px;
        }
        #sidebar ul li > ul {
            margin-left: 10px;
        }
        #sidebar ul li > ul li {
            font-size: 12px;
        }
        #sidebar ul li a {
            padding: 15px 0;
            display: block;
            color: dodgerblue;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        #sidebar ul li a:hover {
            color: black;
        }
        #sidebar ul li.active > a {
            background: transparent;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 0;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <section>
                @if (!auth()->guard('admin')->check())
                    @include('layouts.content-nav')
                @endif
            </section>
        </div>
        <div class="col-md-10">
            <section>
                <div class="container py-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="display-4">{{ $content->title }}</h4>
                            <hr>
                            <h5>{!! $content->description !!}</h5>
                            <br>
                            <div class="d-flex justify-content-center">
                                @if($content->type == 'Video')
                                    <iframe src="http://www.youtube.com/embed/{{ $content->video_link }}" allowfullscreen></iframe>
                                @elseif($content->type == 'File')
                                    <div class="row">
                                        <span data-feather="file-text"></span>
                                        <a href="{{ $content->file_path }}" class="pl-1">{{ basename($content->file_path) }}</a>
                                    </div>
                                @elseif($content->type == 'Link')
                                    <a href="{{ $content->web_link }}" class="link">{{ $content->web_link }}</a>
                                @endif
                            </div>
                            <br>
                            <hr>
                            <a href="{{ route('module.index', $module->course) }}" class="btn btn-light">Back</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
