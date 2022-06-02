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
                <a class="nav-link" href="{{ url('/admin/post') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>{{ __('Post') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
