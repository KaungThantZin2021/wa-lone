@extends('backend.admin.layouts.app')
@section('title', 'Users')
@section('user-active', 'active')

@section('content')
<div>
    <div class="page-header">
        <div>
            @include('backend.components.buttons.back_button')
            <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Create User</a>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">user</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-light">Name</th>
                                    <th class="text-light">Email</th>
                                    <th class="text-light">Created At</th>
                                    <th class="text-light">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td class="text-light">{{ $user->name }}</td>
                                    <td class="text-light">{{ $user->email }}</td>
                                    <td class="text-light">{{ $user->created_at }}</td>
                                    <td class="text-light">{{ $user->updated_at }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-light" colspan="4"><label class="badge badge-danger">No data...!</label></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
