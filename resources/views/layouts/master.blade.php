<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='icon' href='{{asset('/img/'.\Setting::getSetting()->favicon)}}' type='image/x-icon' />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('/img/profile.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline text-white">Welcome, {{ Auth::user()->name }} <span class="caret"></span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-info">
                <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                <p>
                    Welcome, {{ Auth::user()->name }} <span class="caret"></span>
                    <small>Developer</small>
                </p>
                </li>
            </li>
                <!-- Menu Footer-->
            <li class="user-footer">
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                <!-- <a href="{{asset('auth/logout') }}" class="btn btn-outline-info btn-flat float-right">Logout</a> -->
                <a class="btn btn-outline-info btn-flat float-right" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-purple elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('/img/'.\Setting::getSetting()->logo)}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold">{{\Setting::getSetting()->app_name}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        @auth
                            <a href="{{route('profile.show', Auth::user()->id )}}" class="d-block">
                                {{ Auth::user()->name }} <br>
                                <span class="small text-info">{{ ucfirst(Auth::user()->roles[0]->name) }}</span>
                            </a>
                        @endauth
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                @include('layouts.partials.sideBarMenu')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                {{\Setting::getSetting()->footer_right}}
            </div>
            {{\Setting::getSetting()->footer_left}}
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- js -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/dropify.js') }}"></script>
    <script src="{{ asset('/js/jquery.fancybox.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
