@extends('backend.admin.layouts.app')
@section('title', 'Give Permission To Role | ' . config('app.name'))
@section('role-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Give Permission To Role</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
                            <li class="breadcrumb-item">Give Permission To Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="mb-3">
            @include('backend.components.buttons.back_button')
        </div>
        <div class="card dark:tw-bg-slate-800">
            <div class="card-body">
                <form action="{{ route('admin.give-permission-to-role', $role->id) }}" method="POST">
                    @csrf

                    <div>
                        <p>{{ $role->name }}</p>
                    </div>

                    @foreach ($permission_groups as $permission_group)
                    <div class="card shadow-none dark:tw-bg-slate-600 mb-3">
                        <div class="card-header tw-rounded-t dark:tw-bg-slate-700">{{ $permission_group->name }}</div>
                        <div class="card-body">
                           <div class="row">
                                @foreach ($permission_group->permissions as $permission)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="{{ $permission->name }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} multiple>
                                        <label class="form-check-label" for="{{ $permission->name }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                           </div>
                        </div>
                    </div>
                    @endforeach

                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
@endsection
