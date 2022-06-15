@extends('admin.layout.app')

@section('title')
    {{ __('list_user') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                @empty($users)
                    <h4 class="pl-4">{{ __('no_record') }}</h4>
                @endempty
                @isset($users)
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('list_user') }}</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->status }}</td>
                                        <th>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm btn-warning" data-toggle="dropdown">
                                                    {{ __('change_status') }}
                                                    <i class="fa fa-caret-down"> </i>
                                                </a>
                                                <ul class="dropdown-menu mt-1">
                                                    <a class="dropdown-item" id="userStatusActive"
                                                        changeStatusURL={{ route('admin.user.change-status', [
                                                            'id' => $user->id,
                                                            'userStatus' => config('custom.user_status.active'),
                                                        ]) }}>{{ __('active') }}</a>
                                                    <a class="dropdown-item" id="userStatusBlock"
                                                        changeStatusURL={{ route('admin.user.change-status', [
                                                            'id' => $user->id,
                                                            'userStatus' => config('custom.user_status.block'),
                                                        ]) }}>{{ __('block') }}</a>
                                                </ul>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endisset
            </div>
        </div>
    </div>
    {{-- Pagination --}}
    <div class="container">
        <div class="row">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ asset('bower_components/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/change-user-status.js') }}"></script>
@endsection
