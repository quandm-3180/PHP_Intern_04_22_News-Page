@extends('client.layout.app')
@section('content')
    <!-- navbar -->
    <div class="container hidden-xs">
        <nav class="navbar">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('client.home') }}" class="category01">{{ __('HOME') }}</a>
                    </li>
                    @foreach ($categories as $item)
                        <li><a href="{{ route('client.post-by-category', $item->slug) }}"
                                class="category03">{{ $item->name }}</a></li>
                    @endforeach
                    <li><a href="#" class="category08">{{ __('CONTACT') }}</a> </li>
                </ul>
            </div>
            <!-- navbar-collapse -->
        </nav>
    </div>
    </header>
    <section class="block-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ $category->name }}</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><i class="pe-7s-home"></i> <a href="{{ route('client.home') }}"
                                    title="">{{ __('HOME') }}</a></li>
                            <li><a href="{{ route('client.post-by-category', $category->slug) }}"
                                    title="">{{ $category->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @foreach ($posts as $post)
                    <!--Post list-->
                    <div class="post-style2 wow fadeIn" data-wow-duration="1s">
                        <a
                            href="{{ route('client.post-details', ['categorySlug' => $category->slug, 'postSlug' => $post->slug]) }}"><img
                                class="w_240 h-150" src="{{ asset('image/' . $post->images[0]->image) }}"
                                alt=""></a>
                        <div class="post-style2-detail">
                            <h3><a href="{{ route('client.post-details', ['categorySlug' => $category->slug, 'postSlug' => $post->slug]) }}"
                                    title="">{{ $post->name }}</a></h3>
                            <div class="date">
                                <ul>
                                    <li>{{ __('By') }} <a href="#"><span>{{ $post->user->name }}</span></a>
                                        --</li>
                                    <li><a title="{{ $post->getAttributes()['created_at'] }}"
                                            href="#">{{ $post->created_at }}</a>
                                    </li>
                                </ul>
                            </div>
                            <p>{{ $post->short_description }}</p>
                            <a href="{{ route('client.post-details', ['categorySlug' => $category->slug, 'postSlug' => $post->slug]) }}"
                                class="btn btn-style">{{ __('reade_more') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.left content inner -->
            <br>
            @include('client.layout.sidebar')
        </div>
        {{-- Pagination --}}
        <div class="row">
            {{ $posts->links('vendor.pagination.custom') }}
        </div>
    </div>
    </div>
@endsection
