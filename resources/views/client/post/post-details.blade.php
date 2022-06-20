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
                    <li><a href="{{ route('client.home') }}" class="category01">{{ __('HOME') }}</a>
                    </li>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('client.post-by-category', $category->slug) }}"
                                class="category03">{{ $category->name }}</a></li>
                    @endforeach
                    <li><a href="#" class="category08">{{ __('CONTACT') }}</a> </li>
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
                        <img src="{{ asset('image/' . $post->images[0]->image) }}"
                            class="img-responsive post-image box_image_size" alt="{{ $post->slug }}">
                        <!-- /.social icon -->
                    </div>
                    <h1>{{ $post->name }}</h1>
                    <div class="date">
                        <ul>
                            <li>{{ __('By') }}<a title=""
                                    href="#">&nbsp;<span>{{ $post->user->name }}</span></a>
                                --
                            </li>
                            <li><a title="{{ $post->getAttributes()['created_at'] }}"
                                    href="#">{{ $post->created_at }}</a> --</li>
                        </ul>
                    </div>
                    <div class="main-content">
                        {!! $post->content !!}
                    </div>
                </article>
                <!-- Related news area
                                                                                         ============================================ -->
                @isset($relatedPosts)                    
                @if ($relatedPosts->count())
                    <div class="related-news-inner">
                        <h3 class="category-headding ">{{ __('related_news') }}</h3>
                        <div class="headding-border"></div>
                        <div class="row">
                            <div id="content-slide-5" class="owl-carousel">
                                <!-- item-1 -->
                                <div class="item">
                                    <div class="row rn_block">
                                        @foreach ($relatedPosts as $relatedPostItem)
                                            <div class="col-xs-12 col-md-4 col-sm-4 padd">
                                                <div class="post-wrapper wow fadeIn" data-wow-duration="2s">
                                                    <!-- image -->
                                                    <div class="post-thumb">
                                                        <a
                                                            href="{{ route('client.post-details', [
                                                                'categorySlug' => $relatedPostItem->category->slug,
                                                                'postSlug' => $relatedPostItem->slug,
                                                            ]) }}">
                                                            <img class="img-responsive recent_posts_image_height"
                                                                src="{{ asset('image/' . $relatedPostItem->images[0]->image) }}"
                                                                alt="{{ $relatedPostItem->slug }}">
                                                        </a>
                                                    </div>
                                                    <div class="post-info meta-info-rn">
                                                        <div class="slide">
                                                            <a target="_blank"
                                                                href="{{ route('client.post-by-category', $relatedPostItem->slug) }}"
                                                                class="post-badge btn-warning">{{ $relatedPostItem->category->slug }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-title-author-details">
                                                    <h4>
                                                        <a
                                                            href="{{ route('client.post-details', [
                                                                'categorySlug' => $relatedPostItem->category->slug,
                                                                'postSlug' => $relatedPostItem->slug,
                                                            ]) }}">{{ $relatedPostItem->name }}</a>
                                                    </h4>
                                                    <div class="post-editor-date">
                                                        <div class="post-date">
                                                            <i class="pe-7s-clock"></i>{{ $relatedPostItem->created_at }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endisset       
                <!-- form
                                                                                          ============================================ -->
                <br><br>
                @isset($comments)                    
                <div class="form-area">
                    <h3 class="category-headding">{{ __('comment') }}</h3>
                    <div class="headding-border"></div>
                    @guest
                        <span class="input">
                            <textarea disabled name="content" class="input_field textarea_message" id="message"></textarea>
                            <label class="input_label" for="message">
                                <span class="input_label_content">{{ __('login_to_comment') }}</span>
                            </label>
                        </span>
                        <a href="{{ route('login') }}" class="btn btn-style">{{ __('Login') }}</a>
                    @endguest
                    @auth
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('client.comment.store', $post->id) }}" id="form_store_comment"
                                    method="post">
                                    @csrf

                                    <span class="input">
                                        <textarea name="content" class="input_field textarea_message" id="message"></textarea>
                                        <label class="input_label" for="message">
                                            <span class="input_label_content"
                                                data-content="{{ __('your_message') }}">{{ __('your_message') }}</span>
                                        </label>
                                    </span>
                                    <button type="submit" class="btn btn-style">{{ __('post_your_message') }}</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
                <!-- comment box
                           ============================================ -->
                <ul class="comments-container">
                    @foreach ($comments as $comment)
                        <li>
                            <b class="color_dark">{{ $comment->user->name }}</b> &nbsp;<i
                                class="pe-7s-clock"></i><i>{{ $comment->created_at }}</i>
                            <p>{{ $comment->content }}</p>
                        </li>
                    @endforeach
                </ul>
                @endisset
            </div>
            <!-- /.left content inner -->
            <br><br>
            @include('client.layout.sidebar')
        </div>
    </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
    <script src="{{ asset('js/custom-client.js') }}"></script>
@endsection
