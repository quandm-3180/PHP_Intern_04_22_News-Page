@extends('admin.layout.app')

@section('title')
    {{ __('post_status') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">{{ __('post_status') }}</h4>
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
                                <th></th>
                                <th></th>
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
                                        </a>
                                    </td>
                                    <th>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-warning" data-toggle="dropdown">
                                                {{ __('change_status') }}
                                                <i class="fa fa-caret-down"> </i>
                                            </a>
                                            <ul class="dropdown-menu mt-1">
                                                @if (Auth::user()->role_id == config('custom.user_roles.admin'))
                                                    <a class="dropdown-item" id="postStatusApproved"
                                                        changeStatusURL={{ route('admin.post.change-status', [
                                                            'id' => $post->id,
                                                            'postStatus' => config('custom.post_status.approved'),
                                                        ]) }}>{{ __('Approved') }}</a>
                                                    <a class="dropdown-item" id="postStatusRejected"
                                                        changeStatusURL={{ route('admin.post.change-status', [
                                                            'id' => $post->id,
                                                            'postStatus' => config('custom.post_status.rejected'),
                                                        ]) }}>{{ __('Rejected') }}</a>
                                                @endif
                                                @if (Auth::user()->role_id == config('custom.user_roles.writer'))
                                                    <a class="dropdown-item" id="postStatusPending"
                                                        changeStatusURL={{ route('admin.post.change-status', [
                                                            'id' => $post->id,
                                                            'postStatus' => config('custom.post_status.pending'),
                                                        ]) }}>{{ __('Pending') }}</a>
                                                    <a class="dropdown-item" id="postStatusCancel"
                                                        changeStatusURL={{ route('admin.post.change-status', [
                                                            'id' => $post->id,
                                                            'postStatus' => config('custom.post_status.cancel'),
                                                        ]) }}>{{ __('Cancel') }}</a>
                                                @endif
                                            </ul>
                                        </div>
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
    <script src="{{ asset('bower_components/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/changepoststatus.js') }}"></script>
@endsection
