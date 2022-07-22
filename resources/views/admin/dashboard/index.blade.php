@extends('admin.layout.app')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">{{ __('Dashboard') }}</h4>
                </div>
                <div class="row px-2 mt-3">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="row px-4 d-flex align-items-center">
                                <div class="col-6">
                                    <div class="h2">
                                        <i class="nc-icon nc-paper-2"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h2>{{ $countPost }}</h2>
                                    <p>{{ __('posts') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="row px-4 d-flex align-items-center">
                                <div class="col-6">
                                    <div class="h2">
                                        <i class="nc-icon nc-single-02"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h2>{{ $countUser }}</h3>
                                        <p>{{ __('users') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="row px-4 d-flex align-items-center">
                                <div class="col-6">
                                    <div class="h2">
                                        <i class="nc-icon nc-circle-09"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h2>{{ $countWrite }}</h2>
                                    <p>{{ __('writers') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5>{{ __('post-statistics-chart-in :year', ['year' => $currentYear]) }}</h5>
                    <canvas id="chartStatisticsPost" category-name={{ $categoryName }}
                        count-posts-in-month={{ $countPostsInMonth }}></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ asset('js/utils.js') }}"></script>
    <script src="{{ asset('js/dashboard-statistics.js') }}"></script>
@endsection
