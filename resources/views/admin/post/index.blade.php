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
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.post.edit', $post->id) }}">{{ __('Detail') }}
                                        </a> &nbsp;
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('admin.post.edit', $post->id) }}">{{ __('Edit') }}
                                        </a> &nbsp;
                                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('Delete')

                                            <input type="submit" class="btn btn-sm btn-danger"
                                                value="{{ __('Remove') }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
