@extends('layouts.app')

@section('styles')
    <style>
        .container-fluid{
            overflow-x: hidden;
        }
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
            padding: 0;
            margin: 0;
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
        button{
            display: block;
            position: relative;
            z-index: 5!important;
            opacity: 1;
        }
        iframe.benefits{
            display: block;
            width: 250px;
            height: 200px;
            border: 0;
            filter: invert(25%);
        }
        iframe.benefits:hover{
            filter: invert(20%) drop-shadow(3px 7px 7px slategray);
        }
       /* ol,ul,dl{
            margin-bottom: 0rem;
        }*/
        .num{
            font-size: 25px;
            color: black;
            position: absolute;
            z-index: 5;
            padding-left: 90px;
            padding-top: 165px;
        }
        .thirdsection{
            background: dodgerblue;
        }
        iframe.second-frame{
            display: block;
            filter: invert(100%);
            padding-top: 10px;
            width: 250px;
            height: 200px;
            border: 0;
        }
        iframe.second-frame:hover{
            filter: invert(25%) drop-shadow(3px 5px 5px black);
        }
        .contact{
            background-color: #23272b!important;
        }
        .formtext{
            color: white;
        }
        label{
            font-size: 20px;
        }
        img.social{
            display: block;
            width: 50px;
            height: 50px;
            border: 0;
            filter: invert(100%) brightness(0.225) sepia(1) hue-rotate(180deg) saturate(100);
        }
        img.social:hover{
            display: block;
            width: 50px;
            height: 50px;
            border: 0;
            filter: invert(100%) brightness(0.2) sepia(1) hue-rotate(180deg) saturate(50) drop-shadow(1px 2px 2px black);
        }
        pre{
            font-size: 20px;
            font-family: Helvetica;
        }
        h5{
            font-size: 20px;
        }
        .feather{
            width: 18px;
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid m-0 p-0">
        <section>
            <div class="section">
                <div class="jumbotron jumbotron-intro">
                    <div class="content">
                        <h4 class="display-4">SikkhaDeekkha</h4>
                        <h6 class="text-dark"><i>World Class Online Education Platform First Ever In Bangladesh!</i></h6>
                        <hr class="line">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="dropdown col-md-1 float-right pr-1">
                                <button class="dropdown-button btn btn-block btn-success btn-lg" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Register
                                </button>
                                <div class="dropdown-menu dropdown-menu-right bg-transparent border-0 text-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('student.register.form') }}" class="dropdown-item bg-primary">Student Register</a>
                                    <a href="{{ route('instructor.register.form') }}" class="dropdown-item bg-success" title="edit">Instructor Register</a>
                                </div>
                            </div>
                            <div class="dropdown col-md-1 float-left pl-1">
                                <button class="dropdown-button btn btn-block btn-primary btn-lg" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Login
                                </button>
                                <div class="dropdown-menu dropdown-menu-left bg-transparent border-0 text-left" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('student.login.form') }}" class="dropdown-item bg-primary">Student Login</a>
                                    <a href="{{ route('instructor.login.form') }}" class="dropdown-item bg-success" title="edit">Instructor Login</a>
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
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
                            <iframe class="benefits" id="learn" src="{{ asset('icons/noun_experts_3201786.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>FIND QUALITY CONTENTS</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe class="benefits" id="content" src="{{ asset('icons/noun_High Quality Content_1563734.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>SHARPEN YOUR SKILLS</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe class="benefits" id="skill" src="{{ asset('icons/noun_skill_2170300.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>BE INDUSTRY READY</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe class="benefits" id="ready" src="{{ asset('icons/noun_technical expert_2439432.svg') }}"></iframe>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="text-center">
                            <h5><strong>COMPETE WITH WORLD</strong></h5>
                        </div>
                        <div class="img-container text-center">
                            <iframe class="benefits" id="world" src="{{ asset('icons/noun_Globe_1412361.svg') }}"></iframe>
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
                            <h5 class="num num-student"><strong>80000</strong></h5>
                            <iframe class="second-frame" src="{{ asset('icons/student.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h4 class="text-light"><strong>Students</strong></h4>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num num-courses"><strong>8778</strong></h5>
                            <iframe class="second-frame" src="{{ asset('icons/noun_online learning course_2485285.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h4 class="text-light"><strong>Courses</strong></h4>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num num-instructors"><strong>2000</strong></h5>
                            <iframe class="second-frame" src="{{ asset('icons/teacher.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h4 class="text-light"><strong>Instructors</strong></h4>
                        </div>
                    </li>
                    <li class="list-inline-item p-3">
                        <div class="img-container text-center">
                            <h5 class="num num-institutions"><strong>10000</strong></h5>
                            <iframe class="second-frame" src="{{ asset('icons/noun_city hall_2152676.svg') }}"></iframe>
                        </div>
                        <div class="text-center">
                            <h4 class="text-light"><strong>Institutions</strong></h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <section class="partner-logos">
            <ul class="list-group-horizontal-md d-flex justify-content-center list-unstyled">
                <li class="list-inline-item">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
                <li class="list-inline-item  pl-5">
                    <img src="{{asset('icons/noun_university_213486.svg')}}" alt="" style="max-height: 70px">
                </li>
            </ul>
            <a class="font-weight-bold text-center text-dark">And 100 More Institutions</a>
        </section>
        <section class="contact pb-4">
            <h1 class="text-center text-primary pt-4"><strong>Contact us</strong></h1>
            <div class="container-fluid" style="width: 1450px">
                <div class="row">
                    <div class="col-md-3">
                        <form id="contact-form" action="#" name="contact-form" method="POST">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div>
                                        <label for="name" class="formtext">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div>
                                        <label for="email" class="formtext">Email</label>
                                        <input type="text" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div>
                                        <label for="phone" class="formtext">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div>
                                        <label for="usertype" class="formtext">You're a(n)?</label>
                                        <select type="text" id="usertype" name="usertype" class="form-control">
                                            <option value="" selected disabled>Please Select...</option>
                                            <option value="Instructor">Instructor</option>
                                            <option value="Institution Management Authority">Institution Management Authority</option>
                                            <option value="Student">Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="subject" class="formtext">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="message" class="formtext">Enquiry Details</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success">Enquire</button>
                        </form>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="pt-5">
                            <iframe class="pt-4 border-0" src="{{ asset('icons/noun_contact_918754.svg') }}" style="filter: invert(35%) grayscale(100%)"></iframe>
                            <br>
                            <ul class="list-group-horizontal-md d-flex justify-content-center list-unstyled">
                                <li class="list-inline-item text-center">
                                    <div class="img-container text-center">
                                        <a href="#"><img class="social" src="{{ asset('icons/010-linkedin.svg') }}"></a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="img-container text-center">
                                        <a href="#"><img class="social" src="{{ asset('icons/001-facebook.svg') }}"></a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="img-container text-center">
                                        <a href="#"><img class="social" src="{{ asset('icons/twitter.svg') }}"></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-block float-right text-right">
                            <h2 class="text-light">
                                <strong>Code Breakers</strong>
                            </h2>
                            <br>
                            <div class="text-light">
                                <h5><span data-feather="phone" class="text-success"></span> +88 01521479924</h5>
                                <h5><span data-feather="phone" class="text-success"></span> +88 01784086002</h5>
                                <h5><span data-feather="phone" class="text-success"></span> +88 01786543641</h5>
                                <h5><span data-feather="phone" class="text-success"></span> +88 01302570934</h5>
                            </div>
                            <br>
                            <div class="text-light">
                                <h5><span data-feather="mail" class="text-info"></span> kamrul35-255@diu.edu.bd</h5>
                                <h5><span data-feather="mail" class="text-info"></span> eshan35-268@diu.edu.bd</h5>
                                <h5><span data-feather="mail" class="text-info"></span> razwan35-2233@diu.edu.bd</h5>
                                <h5><span data-feather="mail" class="text-info"></span> masud35-254@diu.edu.bd</h5>
                            </div>
                            <br>
                            <div>
                                <pre class="text-light">
                                <span data-feather="map-pin" class="text-danger"></span> House:9(2nd Floor), Road:10,
                                Sector:9, Uttara, Dhaka-1230</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
        <script type="text/javascript">
            particlesJS();
        </script>
@endsection
