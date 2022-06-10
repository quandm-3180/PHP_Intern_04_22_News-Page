@extends('admin.layout.app')
@section('title')
    {{ __('Edit Post') }}
@endsection

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">{{ __('Edit Post') }}</h4>
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="user_id" value="{{ $post->user->id }}">
            <div class="form-group">
                <label for="name">{{ __('Title') }}</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                    value="{{ $post->name }}" name="name">
            </div>
            <div class="form-group">
                <label for="summernote">{{ __('Content') }}</label>
                <textarea class="form-control" name="content" id="summernote">{!! $post->content !!}</textarea>
            </div>
            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" class="form-control file-input @error('image') is-invalid @enderror" name="image"
                    id="image">
                <img class="pt-3" width="150" src="{{ asset('image/' . $post->images[0]->image) }}"
                    alt="{{ $post->slug }}">
            </div>
            <div class="form-group">
                <label for="image">{{ __('Category') }}</label>
                <select class="custom-select form-control" name="category_id">
                    @foreach ($categorys as $category)
                        <option value="{{ $category->id }}"
                            {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check mt-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        {{ $post->is_popular == config('custom.post_popular.yes') ? 'checked' : '' }}
                        value="{{ config('custom.post_popular.yes') }}" name="is_popular">
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
