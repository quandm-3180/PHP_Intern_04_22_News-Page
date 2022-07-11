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
                <div class="card-body">
                    <h5>{{ __('post-revenue-statistics-chart-in :year', ['year' => $currentYear]) }}</h5>
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
