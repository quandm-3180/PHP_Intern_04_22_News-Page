@extends('client.layout.app')

@section('title')
    {{ __('edit_profile') }}
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
                <h3>{{ __('edit_profile') }}</h3>
                @isset($user)
                    <form class="section-card" action="{{ route('client.user.update') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input type="text" class="form-control" id="username" name="name"
                                value="{{ $user->name }}">
                            @error('name')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ $user->email }}">
                            @error('email')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}">
                            @error('phone')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                    </form>
                @endisset
            </div>
        </div>
    </div>
    </div>
@endsection
