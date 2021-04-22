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
    .navbar .dropdown.show a.notification-button{
        color: dodgerblue!important;
    }
    .notification-icon
    {
        padding: 3px;
    }
    .dropdown-item:hover, a.dropdown-item:hover{
        background: transparent;
    }
    .dropdown-item:active, a.dropdown-item:active{
        background: transparent;
    }
    .search-box{
        background: transparent;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: 0;
    }
    .search-box:focus+.btn-search{
        border-color: dodgerblue;
    }
    .search-box::placeholder{
        color: white;
        opacity: 1;
    }
    .search-box:focus::placeholder{
        color: black;
        opacity: 1;
    }
    .btn-search{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
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
                    <li>
                        <a class="nav-link" href="{{ route('course.index') }}">Courses</a>
                    </li>
                    @can('create', \App\Course::class)
                        <li>
                            <a class="nav-link" href="{{ route('course.create') }}">Create Course</a>
                        </li>
                    @endif
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login.form') }}">Admin Login</a>
                    </li>
                @else
                    <div class="nav-item mt-1 mr-3">
                        <form class="d-flex">
                            <input class="form-control search-box me-2" type="search" placeholder="Search Course..." aria-label="Search">
                            <button class="btn btn-outline-light btn-search btn-sm" type="submit"><span data-feather="search" class="p-1"></span></button>
                        </form>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link notification-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span data-feather="bell" class="notification-icon"></span>
                            <span class="badge badge-primary">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right bg-dark border-0" aria-labelledby="dropdownMenuButton">
                            <span class="dropdown-item text-light">Notification 1</span>
                            <hr>
                            <span class="dropdown-item text-light">Notification 2</span>
                            <hr>
                            <span class="dropdown-item text-light">Notification 3</span>
                            <hr>
                            <span class="dropdown-item text-light">see all notifications</span>
                        </div>
                    </div>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-dark border-0" aria-labelledby="navbarDropdown">
                            @if(Auth::guard('admin')->check())
                                <a href="{{ route('admin.profile') }}" class="dropdown-item text-light">
                                    <span data-feather="user" class="p-1"></span>My Account
                                </a>
                                <a class="dropdown-item text-light" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <span data-feather="power" class="p-1 text-danger"></span>{{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @elseif(Auth::guard('instructor')->check())
                                <a href="{{ route('instructor.profile') }}" class="dropdown-item text-light">
                                    <span data-feather="user" class="p-1"></span>My Account
                                </a>
                                <a class="dropdown-item text-light" href="{{ route('instructor.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span data-feather="power" class="p-1 text-danger"></span>{{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('instructor.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('student.wishlist.index') }}" class="dropdown-item text-light">
                                    <span data-feather="bookmark" class="p-1"></span>Wishlists
                                </a>
                                <a href="{{ route('student.profile') }}" class="dropdown-item text-light">
                                    <span data-feather="user" class="p-1"></span>My Account
                                </a>
                                <a class="dropdown-item text-light" href="{{ route('student.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span data-feather="power" class="p-1 text-danger"></span>{{ __('Logout') }}
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

