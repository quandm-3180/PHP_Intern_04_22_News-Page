<div class="sidebar" data-color="orange"
    data-image="{{ asset('bower_components/light-bootstrap-dashboard/assets/img/sidebar-5.jpg') }}">
    <!--
         Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
 
         Tip 2: you can also add an image using data-image tag
     -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/dashboard') }}" class="simple-text">
                {{ __('News 365') }}
            </a>
        </div>
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('admin.post.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>{{ __('Post') }}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.post.post-status') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __('post_status') }}</p>
                </a>
            </li>
            @if (Auth::user()->role_id == config('custom.user_roles.admin'))
                <li>
                    <a class="nav-link" href="{{ route('admin.category.index') }}">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>{{ __('category') }}</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin.user.index') }}">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>{{ __('User') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
