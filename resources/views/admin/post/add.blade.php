@extends('admin.layout.app')
@section('title')
    {{ __('Add Post') }}
@endsection

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">{{ __('Add Post') }}</h4>
        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="name">{{ __('Title') }}</label>
                <input class="form-control @error('name') is-invalid @enderror" id=" name" type="text"
                    value="{{ old('name') }}" name="name">
            </div>
            <div class="form-group">
                <label for="summernote">{{ __('Content') }}</label>
                <textarea class="form-control" name="content" id="summernote">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" class="form-control file-input @error('image') is-invalid @enderror" name="image"
                    id="image">
            </div>
            <div class="form-group">
                <label for="image">{{ __('Category') }}</label>
                <select class="custom-select form-control" name="category_id">
                    @foreach ($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check mt-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="{{ config('custom.post_popular.yes') }}"
                        name="is_popular">
                    <span class="form-check-sign"></span>
                    {{ __('Popular news') }}
                </label>
            </div>
            <a href="{{ url('admin/category') }}" class="btn btn-sm btn-dark mt-3"> {{ __('Close') }}</a> &nbsp;
            <input value="{{ __('Submit') }}" type="submit" class="btn btn-sm btn-success mt-3">
        </form>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ asset('/bower_components/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('/js/summernote.js') }}"></script>
@endsection
