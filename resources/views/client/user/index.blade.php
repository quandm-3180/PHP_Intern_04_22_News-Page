@extends('client.layout.app')

@section('title')
    {{ __('Profile') }}
@endsection
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3>
                    {{ __('Profile') }}</span>
                </h3>
                @isset($user)
                    <div class="section-card">
                        <div class="row mt_2">
                            <div class="col-md-3 col-sm-3">{{ __('Username') }}</div>
                            <div class="col-md-9 col-sm-9">{{ $user['name'] }}</div>
                        </div>
                        <div class="row mt_2">
                            <div class="col-md-3 col-sm-3">{{ __('Email') }}</div>
                            <div class="col-md-9 col-sm-9">{{ $user->email }}</div>
                        </div>
                        <div class="row mt_2">
                            <div class="col-md-3 col-sm-3">{{ __('Phone') }}</div>
                            <div class="col-md-9 col-sm-9">{{ $user->phone }}</div>
                        </div>
                        <div class="row mt_2">
                            <div class="col-md-3 col-sm-3">{{ __('Role') }}</div>
                            <div class="col-md-9 col-sm-9">{{ $user->role->name }}</div>
                        </div>
                        <div class="row mt_2">
                            <div class="col-md-3 col-sm-3">{{ __('Status') }}</div>
                            <div class="col-md-9 col-sm-9">{{ $user->status }}</div>
                        </div>
                        <div class="mt_2">
                            <a href="{{ route('client.user.edit') }}" class="">
                                <i class="fa fa-pencil-square-o fa-2x btn btn-sm btn-warning" aria-hidden="true"></i>
                            </a>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
