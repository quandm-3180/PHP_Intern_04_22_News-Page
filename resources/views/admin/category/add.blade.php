@extends('admin.layout.app')
@section('title')
    {{ __('Add Category') }}
@endsection

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">{{ __('Add Category') }}</h4>
        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group ">
                <label for="name">{{ __('Name') }}</label>
                <input class="form-control" id="name" type="text" value="{{ old('name') }}" name="name">
            </div>

            <div class="form-check ">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="{{ config('custom.category_status.show') }}"
                        name="is_show">
                    <span class="form-check-sign"></span>
                    {{ __('Show in client') }}
                </label>
            </div>
            <a href="{{ url('admin/category') }}" class="btn btn-sm btn-dark mt-3"> {{ __('Close') }}</a> &nbsp;
            <input type="submit" class="btn btn-sm btn-success mt-3">
        </form>
    </div>
@endsection
