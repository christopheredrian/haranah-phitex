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
    <style>
        .panel {
            width: 60%;
            margin: 30px auto 0 auto;
        }

        .panel-body{
            margin: 15px 30px;
        }
    </style>
    <title>
        Buyer
    </title>
</head>
<body>

<div class="content-wrapper">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Choose event
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($events as $event)
                        <li class="list-group-item" style="width: 100%">
                            <a href="/buyer/profile/{{ $event->id }}">{{ $event->event_name }} <span class="badge pull-right">{{ $event->event_date }}</span> <br> {{ $event->event_description }}
                            </a>

                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="/bp_assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="/bp_assets/js/bootstrap.js"></script>
</body>
</html>
