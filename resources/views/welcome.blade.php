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
        }
        .jumbotron-intro{
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
        .num{
            justify-content: center;
            text-align: center;
            font-size: 30px;
            color: #1f6fb2;
            font-family: "montserrat",sans-serif;
            font-weight: 8;
            text-shadow: 2px 2px 4px #2176bd;
        }
        li.stat-list{
            position: relative;
            background: #060c21;
        }
        .stat-jumbotron.d-flex{
            height: 350px;
            background-image: background-color:hsl(0, 0%, 90%);
        }
        .bg-white{
            background: linear-gradient(0deg, #a5dce3, #e2dad0);
        }
        .bg-white:before{
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            background: linear-gradient(45deg, #c1c1c1, #e2f3f1, #d6d5cf, #c5d7c5, #c1c1c1, #c5d7c5, #c5d7c5, #c5d7c5);
            background-size: 400%;
            width: calc(100% + 10px);
            height: calc(100% + 10px);
            z-index: -1;
            animation: gradient-shadow 20s linear infinite;
        }
        @keyframes gradient-shadow {
            0%{
                background-position: 0 0 ;
            }
            50%{
                background-position: 300% 0 ;
            }
            100%{
                background-position: 0 0 ;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <section>
            <div class="section">
                <div class="jumbotron jumbotron-intro">
                    <div class="content">
                        <h4 class="display-4">SikkhaDeekkha</h4>
                        <h6 class="text-dark"><i>World Class Online Education Platform First Ever In Bangladesh!</i></h6>
                        <hr class="line">
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg" style="opacity: 1; z-index: 9999">Register</a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
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
        <section class="counter d-flex">
            <div class="pt-5">
                <ul class="list-group-horizontal">
                    <li class="list-inline-item bg-white rounded stat-list">
                        <div class="num text-center">80000</div>
                        <div class="text-center">
                            <iframe class="icon" src="{{ asset('icons/student.svg')}}"></iframe>
                        </div>
                        <div>
                            <h4 class="font-weight-bold">Students</h4>
                        </div>
                    </li>
                    <li class="list-inline-item  bg-white rounded stat-list">
                        <div class="num text-center">4400</div>
                        <div class="text-center">
                            <iframe class="icon" src="{{ asset('icons/teacher.svg')}}"></iframe>
                        </div>
                        <div>
                            <h4 class="font-weight-bold">Teacher</h4>
                        </div>
                    </li>
                    <li class="list-inline-item bg-white rounded stat-list">
                        <div class="num text-center">5140</div>
                        <div class="text-center">
                            <iframe class="icon" src="{{ asset('icons/Institute.svg')}}"></iframe>
                        </div>
                        <div>
                            <h4 class="font-weight-bold">Institute</h4>
                        </div>
                    </li>
                    <li class="list-inline-item bg-white rounded stat-list">
                        <div class="num text-center">1400</div>
                        <div class="text-center">
                            <iframe class="icon" src="{{ asset('icons/Institution.svg')}}"></iframe>
                        </div>
                        <div>
                            <h4 class="font-weight-bold">Institution</h4>
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
        $(".num").counterUp({delay:10,time:500});
    </script>
@endsection
