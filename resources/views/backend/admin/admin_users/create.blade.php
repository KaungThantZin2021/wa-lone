@extends('backend.admin.layouts.app')
@section('title', 'Create Admin User | ' . config('app.name'))
@section('admin-user-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create Admin User</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Admin User</a></li>
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
            @include('backend.layouts.flash')
            <div class="card-body">
                <form action="{{ route('admin.admin-user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('name') is-invalid @enderror" placeholder="Name"
                            aria-describedby="helpId">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('phone') is-invalid @enderror" placeholder="Phone"
                            aria-describedby="helpId">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('email') is-invalid @enderror" placeholder="Email"
                            aria-describedby="helpId">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('password') is-invalid @enderror" placeholder="Password"
                                    aria-describedby="helpId">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password"
                                    aria-describedby="helpId">
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Roles</label>
                        <select class="custom-select role @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple">
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.admin-user.index') }}" class="btn btn-secondary">Cancel</a>
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

@section('script')
<script>
    $(document).ready(function() {
        $('.role').select2({
            placeholder: '--- Choose Roles ---',
            theme: 'bootstrap4',
            allowClear: true
        });
    });
</script>
@endsection
