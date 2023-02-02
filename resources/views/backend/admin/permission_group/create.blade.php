@extends('backend.admin.layouts.app')
@section('title', 'Create Permission Group | ' . config('app.name'))
@section('permission-group-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create Permission Group</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.permission-group.index') }}">Permission Group</a></li>
                            <li class="breadcrumb-item">Create</li>
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
                <form action="{{ route('admin.permission-group.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">Guard name</label>
                        <select class="custom-select @error('gurad_name') is-invalid @enderror" name="guard_name">
                            <option value="" selected> -- Choose auth guard name --- </option>
                            <option value="admin_user">Admin User</option>
                        </select>
                        @error('gurad_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('name') is-invalid @enderror" placeholder="Permission group name"
                            aria-describedby="helpId">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.permission-group.index') }}" class="btn btn-secondary">Cancel</a>
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
