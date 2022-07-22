<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ asset('bower_components/light-bootstrap-dashboard/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png"
        href="{{ asset('bower_components/light-bootstrap-dashboard/assets/img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title', 'News 365') </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="{{ asset('bower_components/css/index') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome.min/index.css') }}" />
    <!-- CSS Files -->
    <link href="{{ asset('bower_components/light-bootstrap-dashboard/assets/css/bootstrap.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ asset('bower_components/light-bootstrap-dashboard/assets/css/light-bootstrap-dashboard.css?v=2.0.0') }} "
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bower_components/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-notification.css') }}">
</head>

<body>
    <div class="wrapper">

        @include('admin.layout.sidebar')

        <div class="main-panel">
            <!-- Navbar -->

            @include('admin.layout.navbar')

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright text-center">
                        ©2022 <a href="#">Quan Troy</a>, made with love for a better web
                    </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
@section('script')
    @include('admin.layout.script')
@show

</html>
