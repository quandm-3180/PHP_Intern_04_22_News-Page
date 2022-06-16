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
                                class="category03">{{ __("$item->name") }}</a></li>
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
            <div class="col-md-8 col-sm-8">
                <br>
                @empty($listofSearchPost->total())
                    <h3>
                        {{ __('no_results_for') }} <span class="color-1">{{ " `$keyword`" }}</span>
                    </h3>
                @endempty
                @if ($listofSearchPost->total())
                    <h3>
                        {{ __('search_result_for') }} <span class="color-1">{{ " `$keyword`" }}</span>
                    </h3>
                    @foreach ($listofSearchPost as $searchPostItem)
                        <!--Post list-->
                        <div class="post-style2 wow fadeIn" data-wow-duration="1s">
                            <a
                                href="{{ route('client.post-details', ['categorySlug' => $searchPostItem->category->slug, 'postSlug' => $searchPostItem->slug]) }}"><img
                                    src="{{ asset('image/' . $searchPostItem->images[0]->image) }}" alt=""
                                    class="w_240"></a>
                            <div class="post-style2-detail">
                                <h3><a href="{{ route('client.post-details', ['categorySlug' => $searchPostItem->category->slug, 'postSlug' => $searchPostItem->slug]) }}"
                                        title="">{{ $searchPostItem->name }}</a></h3>
                                <div class="date">
                                    <ul>
                                        <li>{{ __('By') }} <a
                                                href="#"><span>{{ $searchPostItem->user->name }}</span></a> --</li>
                                        <li><a title="{{ $searchPostItem->getAttributes()['created_at'] }}"
                                                href="#">{{ $searchPostItem->created_at }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>{{ $searchPostItem->short_description }}</p>
                                <a href="{{ route('client.post-details', ['categorySlug' => $searchPostItem->category->slug, 'postSlug' => $searchPostItem->slug]) }}"
                                    class="btn btn-style">{{ __('reade_more') }}</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- /.left content inner -->
            <br><br>
            @include('client.layout.sidebar')
        </div>
    </div>
    {{-- Pagination --}}
    <div class="row">
        {{ $listofSearchPost->links('vendor.pagination.custom') }}
    </div>
    </div>
@endsection
