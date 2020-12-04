<style>
    nav.navbar{
        background-color:  #23272b!important;
        position: fixed;
        width: 100%;
        z-index: 100;
        border-bottom: 4px solid #3490dc;
        filter: drop-shadow(0px 1px 1px);
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
                @guest
                    <li>
                        <a class="nav-link" href="{{ route('guest.course.index') }}">Courses</a>
                    </li>
                @else
                    @if(Auth::guard('instructor')->check())
                        <li>
                            <a class="nav-link" href="{{ route('course.create') }}">Create Course</a>
                        </li>
                    @endif
                    <li>
                        <a class="nav-link" href="{{ route('course.index') }}">Courses</a>
                    </li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(!(Auth::guard('student')->check() || Auth::guard('instructor')->check() || Auth::guard('admin')->check()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login.form') }}">Admin Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::guard('admin')->check())
                                <a href="{{ route('admin.profile') }}" class="dropdown-item">My Account</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @elseif(Auth::guard('instructor')->check())
                                <a href="{{ route('instructor.profile') }}" class="dropdown-item">My Account</a>
                                <a class="dropdown-item" href="{{ route('instructor.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('instructor.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('student.profile') }}" class="dropdown-item">My Account</a>
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
                @endif
            </ul>
        </div>
    </div>
</nav>

