@extends('admin.layout.app')

@section('title')
    {{ __('List Post') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">{{ __('List Post') }}</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th class="col-3">{{ __('Title') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Writer') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th><a class="btn btn-sm btn-success" href="{{ route('admin.post.create') }}"
                                        value="">{{ __('Add') }}</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>
                                        <img width="100px" src="{{ asset('image/' . $post->images[0]->image) }}"
                                            alt="img">
                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->status }}</td>
                                    <th>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.post.preview', $post->slug) }}">{{ __('Preview') }}
                                        </a> &nbsp;
                                        @can('update', $post)
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('admin.post.edit', $post->id) }}">{{ __('Edit') }}
                                            </a> &nbsp;
                                        @endcan
                                        @if (Auth::user()->role_id == config('custom.user_roles.admin'))
                                            <a id="deleteElement" data-url="{{ route('admin.post.destroy', $post->id) }}"
                                                class="btn btn-sm btn-danger"
                                                data-name="{{ $post->name }}">{{ __('Remove') }}
                                            </a>
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Pagination --}}
    <div class="container">
        <div class="row">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
    <script src="{{ asset('bower_components/jquery.i18n/src/jquery.i18n.js') }}"></script>
    <script src="{{ asset('bower_components/jquery.i18n/src/jquery.i18n.messagestore.js') }}"></script>
    <script src="{{ asset('js/confirm-remove.js') }}"></script>
@endsection
