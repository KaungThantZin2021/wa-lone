@extends('backend.admin.layouts.app')
@section('title', 'Create User')
@section('user-active', 'nav-active')

@section('content')
    <div>
        <div class="page-header">
            <div>
                @include('backend.components.buttons.back_button')
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">user</a></li>
                    <li class="breadcrumb-item active" aria-current="page">create</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create User</h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.user.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputUsername1"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="exampleInputConfirmPassword1"
                                    placeholder="Confirm Password">
                            </div> --}}
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection
