@extends('client.layout.app')
@section('title')
    {{ __('Homepage') }}
@endsection

@section('content')
    <!-- navbar -->
    <div class="container hidden-xs">
        <nav class="navbar">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('home') }}" class="category01">{{ __('HOME') }}</a>
                    </li>
                    @foreach ($categories as $category)
                        <li><a href="#" class="category03">{{ __("$category->name") }}</a></li>
                    @endforeach
                    <li><a href="{{ url('contact') }}" class="category08">{{ __('CONTACT') }}</a> </li>
                </ul>
            </div>
            <!-- navbar-collapse -->
        </nav>
    </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <article class="content">
                    <div class="post-thumb">
                        <img src="{{ asset('image/' . $post->images[0]->image) }}" class="img-responsive post-image"
                            alt="{{ $post->slug }}">
                        <!-- /.social icon -->
                    </div>
                    <h1>{{ $post->name }}</h1>
                    <div class="date">
                        <ul>
                            <li>{{ __('By') }}<a title="" href="#">&nbsp;<span>{{ $post->user->name }}</span></a> --
                            </li>
                            <li><a title="{{ $post->getAttributes()['created_at'] }}"
                                    href="#">{{ $post->created_at }}</a> --</li>
                        </ul>
                    </div>
                    <div class="main-content">
                        {!! $post->content !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
