<style>
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
        max-width: 250px;
        min-height: 100%;
        max-height: 100%;
        background: white;
        -webkit-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
        z-index: 50;
        border-right: 1px solid lightgrey;
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
        color: black;
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
</style>
<div class="d-flex">
    <nav id="sidebar" style="height: 100%">
        <ul class="list-unstyled components">
            @foreach($module->course->modules as $module)
                <li>
                    <a href="#{{ str_replace(' ','',$module->module_name) }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar">
                        <p class="col-md-10">{{ $module->module_name }}</p>
                    </a>
                    <ul class="collapse list-unstyled" id="{{ str_replace(' ','',$module->module_name) }}">
                        @foreach($module->contents as $content)
                            <li>
                                <a href="#" class="child ml-3">{{ $content->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
