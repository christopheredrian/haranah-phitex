<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="/bp_assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONT AWESOME ICONS  -->
    <link href="/bp_assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLE  -->
    <link href="/bp_assets/css/style.css" rel="stylesheet"/>
    <link href="/bp_assets/css/buyer-profile.css" rel="stylesheet"/>
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('additional-css')
    <title>
        @if(Request::is('*/change-password'))
            Account
        @else
            @yield('title')
        @endif
    </title>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>

        </div>
    </div>
</header>
<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/buyer/profile">

                <h3 style="color: white;">HARANAH PHITEX</h3>
                {{--<img src="/bp_assets/img/logo.png"/>--}}
            </a>

        </div>

        <div class="left-div">
            <div class="user-settings-wrapper">
                <ul class="nav">


                </ul>
            </div>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">

                        <?php
                        function url_contains($str)
                        {
                            if (strpos(URL::current(), $str) !== false) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        function is_active($arr)
                        {
                            foreach ($arr as $item) {
                                if (url_contains($item)) {
                                    return 'menu-top-active';
                                }
                            }
                            return '';
                        }

                        ?>

                        {{--<li><a class="{{ is_active(['/home' ]) }}" href="/buyer/home">Dashboard</a></li>--}}

                        <li><a class="{{ is_active(['/profile' ]) }}" href="{{ url('/buyer/profile') }}">Profile</a>
                        </li>
                        <li class="{{ is_active(['#' ]) }} dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Account
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-settings">

                                <li><a href="/change-password" style="color: black!important">Edit Password</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" style="color: black!important">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/"
                                                  target="_blank">DesignBootstrap</a>
            </div>

        </div>
    </div>
</footer>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="/bp_assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="/bp_assets/js/bootstrap.js"></script>
</body>
</html>
