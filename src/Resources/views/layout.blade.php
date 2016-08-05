<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beanstalkd Admin UI</title>

    <link href="{{ asset('vendor/beanstalkdui/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/beanstalkdui/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/beanstalkdui/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/beanstalkdui/css/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/beanstalkdui/css/pnotify.buttons.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        @include('beanstalkdui::partials.sidenav')

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
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
                <a href="https://github.com/Dionera/laravel-beanstalkd-admin-ui">
                    <i class="fa fa-github"></i> Beanstalkd Admin UI - Github
                </a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<script src="{{ asset('vendor/beanstalkdui/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/beanstalkdui/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/beanstalkdui/js/vendor/pnotify.js') }}"></script>
<script src="{{ asset('vendor/beanstalkdui/js/vendor/custom.min.js') }}"></script>

@yield('scripts')
</body>
</html>
