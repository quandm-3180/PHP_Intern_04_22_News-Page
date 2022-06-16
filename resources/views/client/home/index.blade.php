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

    <section>
        <section class="container-fluid headding-news">
            <div class="container">
                <div class="row row-margin">
                    @foreach ($popularPosts as $post)
                        @if ($loop->iteration <= config('custom.post_propular_top_num'))
                            <div class="col-sm-6 col-padding">
                                <div class="post-wrapper post-grid-6 wow fadeIn" data-wow-duration="2s">
                                    <div class="post-thumb img-zoom-in">
                                        <a
                                            href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}">
                                            <img class="entry-thumb-top"
                                                src="{{ asset('image/' . $post->images[0]->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <span class="color-3">{{ $post->category->name }} </span>
                                        <h3 class="post-title post-title-size"><a
                                                href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"
                                                rel="bookmark">
                                                {{ $post->name }}</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i>
                                                {{ $post->created_at }}
                                            </div>
                                            <a class="readmore pull-right"
                                                href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"><i
                                                    class="pe-7s-angle-right"></i></a>
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
                                            <a
                                                href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}">
                                                <img class="entry-thumb-bottom"
                                                    src="{{ asset('image/' . $post->images[0]->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <span class="color-5">{{ $post->category->name }}</span>
                                            <h3 class="post-title post-title-size"><a
                                                    href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"
                                                    rel="bookmark">{{ $post->name }}</a></h3>
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i> {{ $post->created_at }}
                                                </div>
                                                <a class="readmore pull-right"
                                                    href="{{ route('client.post-details', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"><i
                                                        class="pe-7s-angle-right"></i></a>
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
            <div class="row">
                <div class="col-sm-8">
                    <!-- RECENT NEWS -->
                    <section class="articale-inner">
                        <h3 class="category-headding ">{{ __('recent_news') }}</h3>
                        <div class="headding-border"></div>
                        <div class="row">
                            <div id="content-slide-5" class="owl-carousel">
                                <div class="item">
                                    <div class="row rn_block">
                                        @foreach ($recentPosts as $recentPostsItem)
                                            <div class="col-xs-6 col-md-4 col-sm-4 padd recent_posts_height">
                                                <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                                    <!-- image -->
                                                    <div class="post-thumb">
                                                        <a
                                                            href="{{ route('client.post-details', [
                                                                'categorySlug' => $recentPostsItem->category->slug,
                                                                'postSlug' => $recentPostsItem->slug,
                                                            ]) }}">
                                                            <img class="img-responsive recent_posts_image_height object_fit"
                                                                src="{{ asset('image/' . $recentPostsItem->images[0]->image) }}"
                                                                alt="{{ $recentPostsItem->slug }}">
                                                        </a>
                                                    </div>
                                                    <div class="post-info meta-info-rn">
                                                        <div class="slide">
                                                            <a target="_blank"
                                                                href="{{ route('client.post-by-category', $recentPostsItem->category->slug) }}"
                                                                class="post-badge btn-info">{{ $recentPostsItem->category->name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-title-author-details">
                                                    <h4><a
                                                            href="{{ route('client.post-details', [
                                                                'categorySlug' => $recentPostsItem->category->slug,
                                                                'postSlug' => $recentPostsItem->slug,
                                                            ]) }}">{{ $recentPostsItem->name }}</a>
                                                    </h4>
                                                    <div class="post-editor-date">
                                                        <div class="post-date">
                                                            <i class="pe-7s-clock"></i>
                                                            {{ $recentPostsItem->created_at }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.RECENT NEWS -->

                <!-- /.left content inner -->
                @include('client.layout.sidebar')
            </div>
            <!-- side content end -->
        </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="buisness">
                            <h3 class="category-headding ">{{ __('Travel') }}</h3>
                            <div class="headding-border bg-color-5"></div>
                            @foreach ($recentPostofTravle as $postofTravleItem)
                                @if ($loop->first)
                                    <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                        <!-- post title -->
                                        <h3><a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofTravleItem->category->slug,
                                                    'postSlug' => $postofTravleItem->slug,
                                                ]) }}">{{ $postofTravleItem->name }}</a>
                                        </h3>
                                        <!-- post image -->
                                        <div class="post-thumb">
                                            <a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofTravleItem->category->slug,
                                                    'postSlug' => $postofTravleItem->slug,
                                                ]) }}">
                                                <img src="{{ asset('image/' . $postofTravleItem->images[0]->image) }}"
                                                    class="img-responsive recent_posts_image_by_category_height object_fit"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-title-author-details">
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i>{{ $postofTravleItem->created_at }}
                                            </div>
                                        </div>
                                        <p>{{ $postofTravleItem->short_description }}<a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofTravleItem->category->slug,
                                                    'postSlug' => $postofTravleItem->slug,
                                                ]) }}">{{ __('reade_more') }}</a>
                                        </p>
                                    </div>
                                @else
                                    <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                        <div class="img-thumb">
                                            <a href="{{ route('client.post-details', [
                                                'categorySlug' => $postofTravleItem->category->slug,
                                                'postSlug' => $postofTravleItem->slug,
                                            ]) }}"
                                                rel="bookmark"><img class="entry-thumb box_item_size"
                                                    src="{{ asset('image/' . $postofTravleItem->images[0]->image) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item-details">
                                            <h3 class="td-module-title"><a
                                                    href="{{ route('client.post-details', [
                                                        'categorySlug' => $postofTravleItem->category->slug,
                                                        'postSlug' => $postofTravleItem->slug,
                                                    ]) }}">{{ $postofTravleItem->name }}
                                                </a></h3>
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i>{{ $postofTravleItem->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="food">
                            <h3 class="category-headding ">{{ __('Food') }}</h3>
                            <div class="headding-border bg-color-4"></div>
                            @foreach ($recentPostofFood as $postofFoodItem)
                                @if ($loop->first)
                                    <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                        <!-- post title -->
                                        <h3><a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofFoodItem->category->slug,
                                                    'postSlug' => $postofFoodItem->slug,
                                                ]) }}">{{ $postofFoodItem->name }}</a>
                                        </h3>
                                        <!-- post image -->
                                        <div class="post-thumb">
                                            <a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofFoodItem->category->slug,
                                                    'postSlug' => $postofFoodItem->slug,
                                                ]) }}">
                                                <img src="{{ asset('image/' . $postofFoodItem->images[0]->image) }}"
                                                    class="img-responsive recent_posts_image_by_category_height object_fit"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-title-author-details">
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i>{{ $postofFoodItem->created_at }}
                                            </div>
                                        </div>
                                        <p>{{ $postofFoodItem->short_description }}<a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofTravleItem->category->slug,
                                                    'postSlug' => $postofTravleItem->slug,
                                                ]) }}">{{ __('reade_more') }}</a>
                                        </p>
                                    </div>
                                @else
                                    <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                        <div class="img-thumb">
                                            <a href="{{ route('client.post-details', [
                                                'categorySlug' => $postofFoodItem->category->slug,
                                                'postSlug' => $postofFoodItem->slug,
                                            ]) }}"
                                                rel="bookmark"><img class="entry-thumb box_item_size"
                                                    src="{{ asset('image/' . $postofFoodItem->images[0]->image) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item-details">
                                            <h3 class="td-module-title"><a
                                                    href="{{ route('client.post-details', [
                                                        'categorySlug' => $postofFoodItem->category->slug,
                                                        'postSlug' => $postofFoodItem->slug,
                                                    ]) }}">{{ $postofFoodItem->name }}
                                                </a></h3>
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i>{{ $postofFoodItem->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="Fashion">
                            <h3 class="category-headding ">{{ __('Fashion') }}</h3>
                            <div class="headding-border bg-color-3"></div>
                            @foreach ($recentPostofFashion as $postofFashionItem)
                                @if ($loop->first)
                                    <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                        <!-- post title -->
                                        <h3><a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofFashionItem->category->slug,
                                                    'postSlug' => $postofFashionItem->slug,
                                                ]) }}">{{ $postofFashionItem->name }}</a>
                                        </h3>
                                        <!-- post image -->
                                        <div class="post-thumb">
                                            <a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofFashionItem->category->slug,
                                                    'postSlug' => $postofFashionItem->slug,
                                                ]) }}">
                                                <img src="{{ asset('image/' . $postofFashionItem->images[0]->image) }}"
                                                    class="img-responsive recent_posts_image_by_category_height object_fit"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-title-author-details">
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i>{{ $postofFashionItem->created_at }}
                                            </div>
                                        </div>
                                        <p>{{ $postofFashionItem->short_description }}<a
                                                href="{{ route('client.post-details', [
                                                    'categorySlug' => $postofFashionItem->category->slug,
                                                    'postSlug' => $postofFashionItem->slug,
                                                ]) }}">{{ __('reade_more') }}</a>
                                        </p>
                                    </div>
                                @else
                                    <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                        <div class="img-thumb">
                                            <a href="{{ route('client.post-details', [
                                                'categorySlug' => $postofFashionItem->category->slug,
                                                'postSlug' => $postofFashionItem->slug,
                                            ]) }}"
                                                rel="bookmark"><img class="entry-thumb box_item_size"
                                                    src="{{ asset('image/' . $postofFashionItem->images[0]->image) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item-details">
                                            <h3 class="td-module-title"><a
                                                    href="{{ route('client.post-details', [
                                                        'categorySlug' => $postofFashionItem->category->slug,
                                                        'postSlug' => $postofFashionItem->slug,
                                                    ]) }}">{{ $postofFashionItem->name }}
                                                </a></h3>
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i>{{ $postofFashionItem->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
