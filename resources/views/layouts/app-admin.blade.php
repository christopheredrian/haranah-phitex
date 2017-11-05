<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Haranah Phitex') }}</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/build/css/custom.min.css" rel="stylesheet">
    @yield('styles')

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-plane"></i> <span>Haranah-Phitex</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    {{--<div class="profile_pic">--}}
                        {{--<img src="images/img.jpg" alt="..." class="img-circle profile_img">--}}
                    {{--</div>--}}
                    <div class=" text-center">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

               @include('layouts.sidebar')
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/img.jpg" alt="">
                                {{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Profile</a></li>

                                <li><a href="javascript:;">Help</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>

                        {{--<li role="presentation" class="dropdown">--}}
                            {{--<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">--}}
                                {{--<i class="fa fa-envelope-o"></i>--}}
                                {{--<span class="badge bg-green">6</span>--}}
                            {{--</a>--}}
                            {{--<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">--}}
                                {{--<li>--}}
                                    {{--<a>--}}
                                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a>--}}
                                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a>--}}
                                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a>--}}
                                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="text-center">--}}
                                        {{--<a>--}}
                                            {{--<strong>See All Alerts</strong>--}}
                                            {{--<i class="fa fa-angle-right"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
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
                2017 Haranah-Phitex
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- jQuery Sparklines -->
<script src="/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- morris.js -->
<script src="/vendors/raphael/raphael.min.js"></script>
<script src="/vendors/morris.js/morris.min.js"></script>
<!-- gauge.js -->
<script src="/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- Skycons -->
<script src="/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="/vendors/Flot/jquery.flot.js"></script>
<script src="/vendors/Flot/jquery.flot.pie.js"></script>
<script src="/vendors/Flot/jquery.flot.time.js"></script>
<script src="/vendors/Flot/jquery.flot.stack.js"></script>
<script src="/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="/vendors/DateJS/build/date.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="/vendors/moment/min/moment.min.js"></script>
<script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="/build/js/custom.min.js"></script>
@yield('scripts')

</body>
</html>