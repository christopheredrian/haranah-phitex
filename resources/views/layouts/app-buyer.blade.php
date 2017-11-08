
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="/bp_assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="/bp_assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="/bp_assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/bp_assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/bp_assets/css/demo.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/bp_assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="/bp_assets/img/sidebar-5.jpg">

        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    HARANA-PHITEX
                </a>
            </div>

            <ul class="nav">
                <?php
                function url_contains($str)
                {
                    if (strpos(URL::current(), $str) !== false) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function is_active($arr){
                    foreach ($arr as $item){
                        if (url_contains($item)){
                            return 'active';
                        }
                    }
                    return '';
                }

                ?>
                <li class = {{ is_active(['/dashboard' ]) }}>
                    <a href="/buyer/dashboard">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class = {{ is_active(['/profile' ]) }}>
                    <a href="/buyer/profile">
                        <i class="pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class = {{ is_active(['/events' ]) }}>
                    <a href="/buyer/events">
                        <i class="pe-7s-note2"></i>
                        <p>Events</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">

        {{--NAVBAR--}}
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">User</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-globe"></i>
                                <b class="caret hidden-sm hidden-xs"></b>
                                <span class="notification hidden-sm hidden-xs">5</span>
                                <p class="hidden-lg hidden-md">
                                    5 Notifications
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-search"></i>
                                <p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    Account
                                    <b class="caret"></b>
                                </p>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/buyer_profile/profile">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
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
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="/bp_assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="/bp_assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="/bp_assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/bp_assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="/bp_assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="/bp_assets/js/demo.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        demo.initChartist();

        $.notify({
            icon: 'pe-7s-gift',
            message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

        }, {
            type: 'info',
            timer: 4000
        });

    });
</script>

</html>
{{--=======--}}
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}

    {{--<title>{{ config('app.name', 'Haranah Phitex') }}</title>--}}

    {{--<!--responsive to screen width -->--}}
    {{--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">--}}
    {{--<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
    {{--<!-- Font Awesome -->--}}
    {{--<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">--}}
    {{--<!-- Ionicons -->--}}
    {{--<link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">--}}
    {{--<!-- Theme style -->--}}
    {{--<link rel="stylesheet" href="/dist/css/AdminLTE.min.css">--}}
    {{--<!-- AdminLTE Skins. We have chosen the skin-blue for this starter--}}
          {{--page. However, you can choose any other skin. Make sure you--}}
          {{--apply the skin class to the body tag so the changes take effect. -->--}}
    {{--<link rel="stylesheet" href="/dist/css/skins/skin-purple.min.css">--}}
    {{--<link rel="stylesheet" href="/dist/css/skins/skin-black-light.min.css">--}}

    {{--<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
    {{--<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->--}}
    {{--<!--[if lt IE 9]>--}}
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    {{--<![endif]-->--}}

    {{--<!-- Google Font -->--}}
    {{--<link rel="stylesheet"--}}
          {{--href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
{{--</head>--}}


{{--<body class="hold-transition skin-blue-light sidebar-mini">--}}
{{--<div class="wrapper">--}}
    {{--<!-- Main Header -->--}}
    {{--<header class="main-header">--}}
        {{--<!-- Logo -->--}}
        {{--<a href="index2.html" class="logo">--}}
            {{--<!-- mini logo for sidebar mini 50x50 pixels -->--}}
            {{--<span class="logo-mini"><b>A</b>LT</span>--}}
            {{--<!-- logo for regular state and mobile devices -->--}}
            {{--<span class="logo-lg"><b>Haranah</b></span>--}}
        {{--</a>--}}
        {{--<!-- Header Navbar -->--}}
        {{--<nav class="navbar navbar-static-top" role="navigation">--}}
            {{--<!-- Sidebar toggle button-->--}}
            {{--<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
            {{--</a>--}}

            {{--<!-- Navbar Right Menu -->--}}
            {{--<div class="navbar-custom-menu">--}}
                {{--<ul class="nav navbar-nav">--}}
                    {{--<!-- User Account Menu -->--}}

                    {{--<li class="dropdown user user-menu">--}}
                        {{--<!-- Menu Toggle Button -->--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<!-- The user image in the navbar-->--}}
                            {{--<img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                            {{--<!-- hidden-xs hides the username on small devices so only the image appears. -->--}}
                            {{--<span class="hidden-xs">{{ Auth::user()->last_name }}--}}
                                {{--, {{ Auth::user()->first_name  }}</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<!-- The user image in the menu -->--}}
                            {{--<li class="user-header">--}}
                                {{--<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                                {{--<p>--}}
                                    {{--{{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}--}}
                                    {{--- {{Auth::user()->role }}--}}
                                {{--</p>--}}
                            {{--</li>--}}
                            {{--<!-- Menu Footer-->--}}
                            {{--<li class="user-footer">--}}
                                {{--<a href="{{ route('logout') }}"--}}
                                {{--onclick="event.preventDefault();--}}
                                {{--document.getElementById('logout-form').submit();">--}}
                                {{--Logout--}}
                                {{--</a>--}}
                                {{--<div a href="#" class="text-center">--}}
                                    {{--<a class="btn btn-default btn-lg btn-flat" href="{{ route('logout') }}"--}}
                                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                        {{--Logout--}}
                                    {{--</a>--}}
                                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                        {{--{{ csrf_field() }}--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</nav>--}}
    {{--</header>--}}
    {{--<!-- Left side column. contains the logo and sidebar -->--}}
    {{--<aside class="main-sidebar">--}}

        {{--<!-- sidebar: style can be found in sidebar.less -->--}}
        {{--<section class="sidebar">--}}

            {{--<!-- Sidebar user panel (optional) -->--}}
            {{--<div class="user-panel">--}}
                {{--<div class="pull-left image">--}}
                    {{--<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
                {{--</div>--}}
                {{--<div class="pull-left info">--}}
                    {{--<p>{{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}</p>--}}
                    {{--<!-- Status -->--}}
                    {{--<p>{{ Auth::user()->role }} </p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- Sidebar Menu -->--}}
            {{--<ul class="sidebar-menu" data-widget="tree">--}}
                {{--<li class="header">Navigator</li>--}}
                {{--<!-- Optionally, you can add icons to the links -->--}}
                {{--<li class="active"><a href="{{ url('/buyer/index') }}"><i class="fa fa-link"></i>--}}
                        {{--<span>Dashboard</span></a></li>--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class="fa fa-link"></i> <span>Profile</span>--}}
                        {{--<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>--}}
                    {{--</a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ url('/sellers') }}">View</a></li>--}}
                        {{--<li><a href="{{ url('/sellers') }}">Edit</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="{{ url('/sellers') }}"><i class="fa fa-link"></i> <span>Account</span></a></li>--}}
            {{--</ul>--}}
            {{--<!-- /.sidebar-menu -->--}}
        {{--</section>--}}
        {{--<!-- /.sidebar -->--}}
    {{--</aside>--}}

    {{--<!-- Content Wrapper. Contains page content -->--}}
    {{--<div class="content-wrapper">--}}
        {{--@yield('content')--}}
    {{--</div>--}}
    {{--<!-- /.content-wrapper -->--}}

    {{--<!-- Main Footer -->--}}
    {{--<footer class="main-footer">--}}
        {{--<!-- To the right -->--}}
        {{--<div class="pull-right hidden-xs">--}}
            {{--Anything you want--}}
        {{--</div>--}}
        {{--<!-- Default to the left -->--}}
        {{--<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.--}}
    {{--</footer>--}}

    {{--<!-- Control Sidebar -->--}}
    {{--<aside class="control-sidebar control-sidebar-dark">--}}
        {{--<!-- Create the tabs -->--}}
        {{--<ul class="nav nav-tabs nav-justified control-sidebar-tabs">--}}
            {{--<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>--}}
            {{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
        {{--</ul>--}}
        {{--<!-- Tab panes -->--}}
        {{--<div class="tab-content">--}}
            {{--<!-- Home tab content -->--}}
            {{--<div class="tab-pane active" id="control-sidebar-home-tab">--}}
                {{--<h3 class="control-sidebar-heading">Recent Activity</h3>--}}
                {{--<ul class="control-sidebar-menu">--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--<i class="menu-icon fa fa-birthday-cake bg-red"></i>--}}

                            {{--<div class="menu-info">--}}
                                {{--<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>--}}

                                {{--<p>Will be 23 on April 24th</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.control-sidebar-menu -->--}}

                {{--<h3 class="control-sidebar-heading">Tasks Progress</h3>--}}
                {{--<ul class="control-sidebar-menu">--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--<h4 class="control-sidebar-subheading">--}}
                                {{--Custom Template Design--}}
                                {{--<span class="pull-right-container">--}}
                    {{--<span class="label label-danger pull-right">70%</span>--}}
                  {{--</span>--}}
                            {{--</h4>--}}

                            {{--<div class="progress progress-xxs">--}}
                                {{--<div class="progress-bar progress-bar-danger" style="width: 70%"></div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.control-sidebar-menu -->--}}

            {{--</div>--}}
            {{--<!-- /.tab-pane -->--}}
            {{--<!-- Stats tab content -->--}}
            {{--<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>--}}
            {{--<!-- /.tab-pane -->--}}
            {{--<!-- Settings tab content -->--}}
            {{--<div class="tab-pane" id="control-sidebar-settings-tab">--}}
                {{--<form method="post">--}}
                    {{--<h3 class="control-sidebar-heading">General Settings</h3>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="control-sidebar-subheading">--}}
                            {{--Report panel usage--}}
                            {{--<input type="checkbox" class="pull-right" checked>--}}
                        {{--</label>--}}

                        {{--<p>--}}
                            {{--Some information about this general settings option--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<!-- /.form-group -->--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<!-- /.tab-pane -->--}}
        {{--</div>--}}
    {{--</aside>--}}
    {{--<!-- /.control-sidebar -->--}}
    {{--<!-- Add the sidebar's background. This div must be placed--}}
    {{--immediately after the control sidebar -->--}}
    {{--<div class="control-sidebar-bg"></div>--}}
{{--</div>--}}
{{--<!-- ./wrapper -->--}}

{{--<!-- REQUIRED JS SCRIPTS -->--}}

{{--<!-- jQuery 3 -->--}}
{{--<script src="/bower_components/jquery/dist/jquery.min.js"></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="/dist/js/adminlte.min.js"></script>--}}

{{--<!-- Optionally, you can add Slimscroll and FastClick plugins.--}}
     {{--Both of these plugins are recommended to enhance the--}}
     {{--user experience. -->--}}
{{--</body>--}}
{{--</html>--}}
{{-->>>>>>> origin/master--}}
