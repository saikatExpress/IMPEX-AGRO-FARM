<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('custom/logos/751280420015239.png') }}" type="image/ico" />

    <title>Impex Agro Farm | Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="{{ asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('asset/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    {{-- Fort Awesome CDN Link Here --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('asset/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('asset/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('asset/build/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('dashboard') }}" class="site_title"> <img style="width: 30px; height:30px;"
                                src="{{ asset('custom/logos/751280420015239.png') }}" alt="">
                            <span>Impex Agro Farm</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('asset/images/img.jpg') }}" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Palash Saha</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> হোম <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('dashboard') }}">ড্যাশবোর্ড</a></li>
                                        <li><a href="{{ route('branch.create') }}">ব্রাঞ্চ</a></li>
                                    </ul>
                                </li>

                                {{-- HR Menu List --}}
                                <li><a><i style="font-size: 1.2rem;" class="fa-solid fa-user"></i> মানব সম্পদ <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('staff.us') }}">স্টাফ যুক্ত</a></li>
                                        <li><a href="form_advanced.html">স্টাফ তালিকা</a></li>
                                        <li><a href="form_validation.html">ব্যাবহারকারীদের তালিকা</a></li>
                                        <li><a href="form_wizards.html">স্টাফ বেতন</a></li>
                                    </ul>
                                </li>
                                {{-- HR Menu List --}}

                                {{-- Beef Menu List --}}
                                <li><a><i class="fa fa-desktop"></i> মাংস বিবরণী <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="general_elements.html">প্রাপ্ত মাংস</a></li>
                                        <li><a href="media_gallery.html">মাংস বিক্রয়</a></li>
                                        <li><a href="typography.html">বাকি সংগ্রহ</a></li>
                                    </ul>
                                </li>
                                {{-- Beef Menu List --}}

                                {{-- Milk Menu List --}}
                                <li><a><i class="fa fa-table"></i> দুধ বিবরণী <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="tables.html">প্রাপ্ত দুধ</a></li>
                                        <li><a href="tables_dynamic.html">দুধ বিক্রয়</a></li>
                                        <li><a href="tables_dynamic.html">বাকী সংগ্রহ</a></li>
                                    </ul>
                                </li>
                                {{-- Milk Menu List --}}

                                <li><a href=""> <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        পশু খাদ্য</a></li>

                                {{-- Animal Sell Menu List --}}
                                <li><a><i class="fa fa-bar-chart-o"></i> পশু ক্রয়/বিক্রয় <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="chartjs.html">ক্রয়</a></li>
                                        <li><a href="chartjs2.html">বিক্রয়</a></li>
                                        <li><a href="morisjs.html">বাকী সংগ্রহ</a></li>
                                    </ul>
                                </li>
                                {{-- Animal Sell Menu List --}}

                                <li><a><i class="fa fa-clone"></i>ফার্মের খরচ <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="fixed_sidebar.html">খরচের তালিকা</a></li>
                                        <li><a href="fixed_footer.html"> খরচের ধরণ </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="menu_section">
                            <h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa-solid fa-hippo"></i> পশু মনিটরিং <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="e_commerce.html">রুটিন মনিটরিং</a></li>
                                        <li><a href="projects.html">ভ্যাকসিন মনিটরিং</a></li>
                                        <li><a href="project_detail.html">প্রেগনেন্সি মনিটরিং</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        পরিবেশক
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        পশুর তালিকা
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        বাছুরের তালিকা
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        শেড বিবরণী
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        রিপোর্ট
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i style="font-size: 1.2rem;" class="fa-solid fa-bowl-food"></i>
                                        ক্যাটালগ
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('logout') }}">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('asset/images/img.jpg') }}" alt="">Palash Saha
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="{{ url('logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                @yield('content')

            </div>
            <!-- /page content -->


            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    IMPEX AGRO- Admin Panel by <a href="https://colorlib.com">TS WEB BUILD</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('asset/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('asset/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('asset/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('asset/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('asset/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('asset/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('asset/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('asset/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('asset/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('asset/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('asset/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('asset/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('asset/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('asset/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('asset/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/starrr/dist/starrr.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('asset/build/js/custom.min.js') }}"></script>

</body>

</html>
