<div class="col-md-4 col-sm-4 left-padding">
    <!-- right content wrapper -->
    <form action="{{ route('client.post.search') }}" method="GET" id="form_search">
        <div class="input-group search-area">
            <!-- search area -->
            <input type="text" class="form-control" placeholder="{{ __('Search') }}" name="q" autocomplete="off">
            <div class="input-group-btn">
                <button class="btn btn-search" form="form_search" type="submit"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
            </div>
    </form>
</div>
<!-- /.search area -->
@isset($postHotinSidebar)
    <!-- Hot news -->
    <h3 class="category-headding ">{{ __('Hot') }}</h3>
    <div class="headding-border"></div>
    <div class="tab-inner">
        <!-- tabs -->
        <div class="tab_content">
            <div class="tab-item-inner">
                @foreach ($postHotinSidebar as $postHotItem)
                    <div class="box-item wow fadeIn" data-wow-duration="1s">
                        <div class="img-thumb">
                            <a
                                href="{{ route('client.post-details', [
                                    'categorySlug' => $postHotItem->category->slug,
                                    'postSlug' => $postHotItem->slug,
                                ]) }}"><img
                                    class="entry-thumb object_fit post_hot_img_size"
                                    src="{{ asset('image/' . $postHotItem->images[0]->image) }}"
                                    alt="{{ $postHotItem->slug }}"></a>
                        </div>
                        <div class="item-details">
                            <h6 class="sub-category-title bg-color-4">
                                <a
                                    href="{{ route('client.post-by-category', $postHotItem->category->slug) }}">{{ $postHotItem->category->name }}</a>
                            </h6>
                            <h3 class="td-module-title"><a
                                    href="{{ route('client.post-details', [
                                        'categorySlug' => $postHotItem->category->slug,
                                        'postSlug' => $postHotItem->slug,
                                    ]) }}">{{ $postHotItem->name }}</a>
                            </h3>
                            <div class="post-editor-date">
                                <!-- post date -->
                                <div class="post-date">
                                    <i class="pe-7s-clock"></i>{{ $postHotItem->created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- / tab_content -->
    </div>
    <!-- / tab -->
@endisset
