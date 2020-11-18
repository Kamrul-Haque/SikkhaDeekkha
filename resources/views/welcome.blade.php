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
        ol,ul,dl{
            margin-bottom: 0rem;
        }
        .num{
            font-size: 25px;
            color: black;
            z-index: 1;
            position: absolute;
            padding-top: 70px;
            padding-left: 92px;
        }
        .thirdsection{
            background: dodgerblue;
        }
        #second-frame{
            filter: invert(90%) drop-shadow(3px 7px 7px slategray);
            z-index: -1;
        }
        .text-white{
            font-size: 25px;
        }
        h2{
            text-align: center;
            padding: 20px;
        }
        .mb-4{
            background-color: #23272b!important;
        }
        .formtext{
            color: white;
        }
        label{
            font-size: 20px;
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
        <section class="thirdsection">
            <div class="pt-0">
                <ul class="list-group-horizontal-md d-flex justify-content-center list-unstyled">
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num"><strong>80000</strong></h5>
                            <iframe id="second-frame" src="{{ asset('icons/student.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h5 class="text-white"><strong>Student</strong></h5>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num"><strong>8778</strong></h5>
                            <iframe id="second-frame" src="{{ asset('icons/teacher.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h5 class="text-white"><strong>Coures</strong></h5>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num"><strong>2000</strong></h5>
                            <iframe id="second-frame" src="{{ asset('icons/institute.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h5 class="text-white"><strong>Institution</strong></h5>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num"><strong>10000</strong></h5>
                            <iframe id="second-frame" src="{{ asset('icons/institution.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h5 class="text-white"><strong>Instructor</strong></h5>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <section class="partner-logos">
            <h2 class="font-weight-bold justify-content-center">Our Partners</h2>
            <ul class="list-group-horizontal-md d-flex justify-content-center list-unstyled">
            <li class="list-inline-item  pl-5">
                <img src="{{asset('icons/adidas.png')}}" alt="" style="max-height: 70px">
            </li>
            <li class="list-inline-item  pl-5">
                <img src="{{asset('icons/adidas.png')}}" alt="" style="max-height: 70px">
            </li>
            <li class="list-inline-item pl-5">
                <img src="{{asset('icons/adidas.png')}}" alt="" style="max-height: 70px">
            </li>
            <li class="list-inline-item  pl-5">
                <img src="{{asset('icons/adidas.png')}}" alt="" style="max-height: 70px">
            </li>
            </ul>
        </section>
        <section class="mb-4">
            <h2 class="h1-responsive font-weight-bold text-center my-4 text-white">Contact us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="formtext">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="formtext">Your email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="phone" class="formtext">Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="usertype" class="formtext">What type of user you are?</label>
                                    <input type="text" id="" name="usertype" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="formtext">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <label for="subject" class="formtext">Type your message here.</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-md-left pt-3">
                        <a class="btn btn-outline-success" onclick="document.getElementById('contact-form').submit();">Submit</a>
                    </div>
                    <div class="status"></div>
                </div>
                <div class="col-md-4 pl-lg-5 pt-4">
                    <h5 class="font-weight-bold text-white">
                        Name: Somthing
                    </h5>
                    <h5 class="font-weight-bold text-white">
                        Phone: Phone Number
                    </h5>
                    <h5 class="font-weight-bold text-white">
                        Email: someone@example.com
                    </h5>
                    <h5 class="font-weight-bold text-white">
                        Address: <br>Plot: 2A, House: 212,<br>
                        Baridhara J Block, Dhaka 1212.
                    </h5>
                </div>
            </div>
            <hr class="line">
        </section>

@endsection

@section('scripts')
            <script type="text/javascript">
                particlesJS();
            </script>
@endsection
