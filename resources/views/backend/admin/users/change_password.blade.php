@extends('backend.admin.layouts.app')
@section('title', 'Change User Password | ' . config('app.name'))
@section('user-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Change User ({{ $user->name }})'s Password</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                            <li class="breadcrumb-item">Change Password</li>
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
                {!! Form::model($user, ['route' => ['admin.user.update-password', $user->id], 'id' => 'changeUserPasswordForm', 'method' => 'patch']) !!}

                @include('backend.admin.users.partials._form', ['form_type' => 'change-password'])

                {!! Form::close() !!}
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\ChangeUserPasswordRequest', '#changeUserPasswordForm') !!}
@endsection