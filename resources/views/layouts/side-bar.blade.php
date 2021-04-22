<style>
    a.sidebar {
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
        color: dodgerblue;
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
        min-width: 200px;
        max-width: 200px;
        min-height: 100vh;
        max-height: 100vh;
        background: #23272b;
        color: #fff;
        -webkit-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
        z-index: 50;
    }
    #sidebar ul.components {
        padding: 0;
    }
    #sidebar ul li {
        font-size: 16px;
    }
    #sidebar ul li > ul {
        margin-left: 10px;
    }
    #sidebar ul li > ul li {
        font-size: 14px;
    }
    #sidebar ul li a {
        padding: 15px 0;
        display: block;
        color: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    #sidebar ul li a:hover {
        color: dodgerblue;
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
    .last:hover{
        color: white;
    }
</style>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" style="height: 100%">
        <div class="p-3">
            <ul class="list-unstyled components mb-5 pt-2">
                <li>
                    <a href="#subjectSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Subjects</a>
                    <ul class="collapse list-unstyled" id="subjectSubmenu">
                        <li>
                            <a href="{{ route('admin.subject.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subject.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#institutionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Institutions</a>
                    <ul class="collapse list-unstyled" id="institutionSubmenu">
                        <li>
                            <a href="{{ route('admin.institution.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.institution.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#instructorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Instructors</a>
                    <ul class="collapse list-unstyled" id="instructorSubmenu">
                        <li>
                            <a href="{{ route('admin.instructor.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.instructor.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Courses</a>
                    <ul class="collapse list-unstyled" id="courseSubmenu">
                        <li>
                            <a href="{{ route('course.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('course.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#paymentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Payments</a>
                    <ul class="collapse list-unstyled" id="paymentSubmenu">
                        <li>
                            <a href="{{ route('admin.payment.index') }}" class="child">Index</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">Students</a>
                    <ul class="collapse list-unstyled" id="studentSubmenu">
                        <li>
                            <a href="{{ route('admin.student.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.student.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar last text-danger">Admins</a>
                    <ul class="collapse list-unstyled" id="adminSubmenu">
                        <li>
                            <a href="{{ route('admin.admin.index') }}" class="child">Index</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admin.create') }}" class="child">Create</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }
</script>
