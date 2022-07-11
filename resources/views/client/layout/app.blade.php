<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from news365htmllatest.bdtask.com/Demo/DemoNews365/home-style-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 May 2022 07:41:51 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('bower_components/templete-news365/images/fev-icon.png') }}" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> @yield('title') </title>

    @include('client.layout.style')
</head>

<body>
    <div class="se-pre-con"></div>
    <header>

        <!-- top header -->
        <div class="top_header hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-2">
                        <div class="top_header_menu_wrap">
                            @guest
                                <ul class="top-header-menu">
                                    <li><a href="{{ route('register') }}">{{ __('REGISTER') }}</a></li>
                                    <li><a href="{{ route('login') }}">{{ __('LOGIN') }}</a></li>
                                </ul>
                            @endguest
                            @auth
                                <div class="btn-group mt_1">
                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->role_id == config('custom.user_roles.admin')
                                                ||Auth::user()->role_id == config('custom.user_roles.writer'))
                                            <li><a href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a> </li>
                                        @endif
                                        <li><a href="{{ route('client.user.index') }}">{{ __('Profile') }}</a>
                                        </li>
                                        <li>
                                            <a>
                                                <input form="logout-form" class="btn btn-sm" type="submit"
                                                    value="{{ __('Logout') }}">
                                            </a>
                                        </li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                    <!--breaking news-->
                    <div class=" col-sm-8 col-md-7">
                        <div class="newsticker-inner">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="top_header_icon">
                            <!-- Localization  button -->
                            <div class="btn-group">
                                <button type=" button" class="btn btn-sm btn-info dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('change-language', ['en']) }}">{{ __('English') }}</a>
                                    </li>
                                    <li> <a href="{{ route('change-language', ['vi']) }}">{{ __('Tiếng Việt') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <span class="top_header_icon_wrap">
                                <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                            </span>
                            <span class="top_header_icon_wrap">
                                <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                            </span>
                            <span class="top_header_icon_wrap">
                                <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                            </span>
                            <span class="top_header_icon_wrap">
                                <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top_banner_wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-sm-4">
                        <div class="header-logo">
                            <!-- logo -->
                            <a href="{{ url('home') }}">
                                <img class="td-retina-data img-responsive"
                                    src="{{ asset('bower_components/templete-news365/images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                        <div class="header-banner">
                            {{-- <a href="#"><img class="td-retina img-responsive"
                                    src="{{ asset('bower_components/templete-news365/images/top-bannner.jpg') }}"
                                    alt=""></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @yield('content')

    <!-- footer Area
        ============================================ -->

    @include('client.layout.footer')
    <!-- /.footer Area -->

    <!-- script
            ============================================ -->
    @section('script')
        @include('client.layout.script')
    @show
    <!-- /.script -->
</body>

<!-- Mirrored from news365htmllatest.bdtask.com/Demo/DemoNews365/home-style-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 May 2022 07:46:19 GMT -->

</html>
