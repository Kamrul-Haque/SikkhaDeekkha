@extends('layouts.app')

@section('styles')
    <style>
        #particles-js{
            width: 100%;
            height: 300px;
            opacity: 0.8;
        }
        .background{
            position: absolute;
            z-index: -1;
            width: 100%;
        }
        img{
            height: 300px;
            width: inherit;
            opacity: 0.2;
        }
        .section{
            position: absolute;
            width: 100%;
        }
        .jumbotron{
            background: rgba(240, 240, 240, 0.4);
            width: 100%;
            height: 300px;
            text-align: center;
            vertical-align: middle;
            z-index: 1;
        }
        .display-4{
            font-family: Sylfaen;
        }
        hr.line{
            border-top: 1px solid black;
            width: 70%;
        }
        a{
            display: block;
            position: relative;
            z-index: 9999;
            opacity: 1;
        }
        iframe{
            display: block;
            width: 250px;
            height: 200px;
            border: 0;
            filter: invert(25%);
        }
        iframe:hover{
            filter: invert(20%) drop-shadow(3px 7px 7px slategray);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <section>
            <div class="section">
                <div class="jumbotron">
                    <div class="content">
                        <h4 class="display-4">SikkhaDeekkha</h4>
                        <h6 class="text-dark"><i>World Class Online Education Platform First Ever In Bangladesh!</i></h6>
                        <hr class="line">
                        <a href="{{ route('student.register.form') }}" class="btn btn-success btn-lg" style="opacity: 1; z-index: 9999">Register</a>
                        <a href="{{ route('student.login.form') }}" class="btn btn-primary btn-lg">Login</a>
                    </div>
                </div>
            </div>
            <div class="background">
                <img src="{{ asset('images/blackhole_spacetime_curve.png') }}" alt="">
            </div>
            <div id="particles-js"></div>
        </section>
        <section style="background-color: azure">
            <div class="pt-5">
                <ul class="list-group-horizontal-md d-flex justify-content-center list-unstyled">
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>LEARN FROM EXPERTS</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe id="learn" src="{{ asset('icons/noun_experts_3201786.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>FIND QUALITY CONTENTS</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe id="content" src="{{ asset('icons/noun_High Quality Content_1563734.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>SHARPEN YOUR SKILLS</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe id="skill" src="{{ asset('icons/noun_skill_2170300.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>BE INDUSTRY READY</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe id="ready" src="{{ asset('icons/noun_technical expert_2439432.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>COMPETE WITH WORLD</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe id="world" src="{{ asset('icons/noun_Globe_1412361.svg') }}"></iframe>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        particlesJS();
    </script>
@endsection
