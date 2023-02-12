@extends('backend.admin.layouts.app')
@section('title', 'Create User | ' . config('app.name'))
@section('user-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create User</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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
                @include('backend.layouts.flash')
                <form action="{{ route('admin.user.store') }}" method="POST" id="createUserForm">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('name') is-invalid @enderror" placeholder="name"
                            aria-describedby="helpId">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('phone') is-invalid @enderror" placeholder="phone"
                            aria-describedby="helpId">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('email') is-invalid @enderror" placeholder="email"
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
                                <input type="password" name="password" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('password') is-invalid @enderror" placeholder="password"
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
                                <input type="password" name="confirm_password" class="form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('confirm_password') is-invalid @enderror" placeholder="confirm password"
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
                        <label for="">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="gender" value="male" class="custom-control-input" id="customControlValidation2" checked>
                                <label class="custom-control-label" for="customControlValidation2">Male</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="gender" value="female" class="custom-control-input" id="customControlValidation3">
                                <label class="custom-control-label" for="customControlValidation3">Female</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="gender" value="other" class="custom-control-input" id="customControlValidation4">
                                <label class="custom-control-label" for="customControlValidation4">Other</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="text" name="dob" class="form-control dark:tw-bg-slate-700 dark:focus:tw-border-gray-500" placeholder="YYYY-MM-DD"
                            aria-describedby="helpId">
                    </div>

                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\CreateUserRequest', '#createUserForm') !!}

<script>
    $(() => {
        $('input[name="dob"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            locale: {
                format: 'YYYY-MM-DD'
            },
            drops: 'up'
        });
    });
</script>
@endsection
