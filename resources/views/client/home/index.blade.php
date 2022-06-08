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

    <section>
        <section class="container-fluid headding-news">
            <div class="container">
                <div class="row row-margin">
                    @foreach ($popularPosts as $post)
                        @if ($loop->iteration <= config('custom.post_propular_top_num'))
                            <div class="col-sm-6 col-padding">
                                <div class="post-wrapper post-grid-6 wow fadeIn" data-wow-duration="2s">
                                    <div class="post-thumb img-zoom-in">
                                        <a href="">
                                            <img class="entry-thumb-top"
                                                src="{{ asset('image/' . $post->images[0]->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <span class="color-3">{{ $post->category->name }} </span>
                                        <h3 class="post-title post-title-size"><a href="" rel="bookmark">
                                                {{ $post->name }}</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i>
                                                {{ $post->created_at }}
                                            </div>
                                            <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row row-margin">
                    <div id="content-slide-4" class="owl-carousel">
                        @foreach ($popularPosts as $post)
                            @if ($loop->iteration > config('custom.post_propular_top_num'))
                                <div class="item">
                                    <div class="post-wrapper post-grid-8 wow fadeIn" data-wow-duration="2s">
                                        <div class="post-thumb img-zoom-in">
                                            <a href="">
                                                <img class="entry-thumb-bottom"
                                                    src="{{ asset('image/' . $post->images[0]->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <span class="color-5">{{ $post->category->name }}</span>
                                            <h3 class="post-title post-title-size"><a href=""
                                                    rel="bookmark">{{ $post->name }}</a></h3>
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i> {{ $post->created_at }}
                                                </div>
                                                <a class="readmore pull-right" href=""><i class="pe-7s-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
        </div>
    </section>
@endsection
