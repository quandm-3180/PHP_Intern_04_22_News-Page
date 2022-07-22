<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo">{{ __('Dashboard') }}</a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nc-icon nc-zoom-split"></i>
                        <span class="d-lg-block">&nbsp;{{ __('Search') }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-notifications">
                    <a id="item-notifi" href="#notifications-panel" class="nav-link dropdown-toggle"
                        data-toggle="dropdown">
                        <i class="glyphicon glyphicon-bell nc-icon nc-bell-55"></i>
                        <i data-count="{{ Auth::user()->unreadNotification }}"
                            class="notification">{{ Auth::user()->unreadNotification }}</i>
                    </a>
                    <div class="dropdown-container">
                        <div class="dropdown-toolbar">
                            <div class="dropdown-toolbar-actions">
                                <a href="{{ route('admin.makeAllAsRead') }}"
                                    id="allRead">{{ __('mark_all_as_read') }}</a>
                            </div>
                            <h3 class="dropdown-toolbar-title">{{ __('notifications') }} (<span
                                    class="notif-count">{{ Auth::user()->unreadNotification }}</span>)</h3>
                        </div>
                        <ul class="dropdown-menu dropdown-menu2">
                            @foreach (Auth::user()->notifications as $noti)
                                <li class="notification2 {{ $noti->read_at ? '' : 'unchecked' }}">
                                    <a href="{{ $noti->data['urlPost'] }}?idnotify={{ $noti->id }}"
                                        data-id="{{ $noti->id }}" target="_blank">
                                        <div class="media">
                                            <div class="media-body">
                                                <p>{!! $noti->data['message'] !!}</p>
                                                <small class="timestamp">{{ $noti->data['created_at'] }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="dropdown-footer text-center">
                            <a href="#">{{ __('view_all') }}</a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item m-auto">
                    <a class="nav-link" href="#">
                        <span class="no-icon"> {{ Auth::user()->name }}</span>
                    </a>
                </li>
                <!-- Localization  button -->
                <div class="dropdown m-auto">
                    <a href="#" class="btn btn-sm btn-info" data-toggle="dropdown">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        <i class="fa fa-caret-down"> </i>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('change-language', ['en']) }}">{{ __('English') }}</a>
                        <a class="dropdown-item"
                            href="{{ route('change-language', ['vi']) }}">{{ __('Tiếng Việt') }}</a>
                    </ul>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <input class="btn" form="logout-form" type="submit" value="{{ __('Log out') }}">
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
