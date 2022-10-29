@extends('backend1.layouts.app')
@section('title', 'Admin Login | '. config('app.name', 'Wa Lone'))
@section('content')
<div class="auth-box row">
    {{-- <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{ asset('backend1/assets/images/big/3.jpg') }});"> --}}
    </div>
    <div class="col-lg-5 col-md-7 bg-white card">
        <div class="p-3">
            <div class="text-center">
                {{-- <img src="{{ asset('backend1/assets/images/big/icon.png') }}" alt="wrapkit"> --}}
                <h3 class="text-primary">{{ config('app.name') }}</h3>
            </div>
            <hr>
            <h2 class="mt-3 text-center">Admin Login</h2>
            <p class="text-center">Enter your email address and password to access admin panel.</p>
            <hr>
            <form class="mt-4" method="POST" action="{{ route('admin.two-step-otp') }}" id="adminLoginForm">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email"
                                placeholder="enter your email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="pwd" type="password" name="password"
                                placeholder="enter your password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminLoginRequest', '#adminLoginForm') !!}
@endsection
