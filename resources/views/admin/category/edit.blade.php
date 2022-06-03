@extends('admin.layout.app')
@section('title')
    {{ __('Edit Category') }}
@endsection

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">{{ __('Edit Category') }}</h4>
        <form action="{{ route('admin.category.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group ">
                <label for="name">{{ __('Name') }}</label>
                <input class="form-control" id="name" type="text" value="{{ $category->name }}" name="name">
            </div>

            <div class="form-check ">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="{{ config('custom.category_status.show') }}"
                        name="is_show"
                        {{ $category->status == config('custom.category_status_text.show') ? 'checked' : '' }}>
                    <span class="form-check-sign"></span>
                    {{ __('Show in client') }}
                </label>
            </div>
            <a href="{{ url('admin/category') }}" class="btn btn-sm btn-dark mt-3"> {{ __('Close') }}</a> &nbsp;
            <input type="submit" class="btn btn-sm btn-success mt-3" value="{{ __('Submit') }}">
        </form>
    </div>
@endsection
