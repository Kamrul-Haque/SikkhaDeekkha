<style>
    nav.navbar{
        background-color:  #23272b!important;
        position: fixed;
        width: 100%;
        z-index: 100;
        border-bottom: 4px solid #3490dc;

    }
    .navbar-collapse a{
        text-align: right!important;
        color: whitesmoke!important;
        font-size: medium!important;
    }
    a.navbar-brand{
        color: deepskyblue!important;
        font-weight: bold!important;
    }
    a.dropdown-item{
        color: black!important;
    }
</style>
<nav class="navbar navbar-dark navbar-expand-md shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.student.index') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.course.index') }}">Courses</a>
                </li>
                @else
                <li>
                    <a class="nav-link" href="#">Courses</a>
                </li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login.form') }}">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructor.login.form') }}">Instructor Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="#" class="dropdown-item">My Account</a>
                            @if(Auth::guard('admin')->check())
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @elseif(Auth::guard('instructor')->check())
                                <a class="dropdown-item" href="{{ route('instructor.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('instructor.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a class="dropdown-item" href="{{ route('student.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

