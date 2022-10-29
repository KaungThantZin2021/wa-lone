@extends('backend1.layouts.app')
@section('title', 'Admin Login OTP | ' . config('app.name', 'Wa Lone'))
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
            <h2 class="mt-3 text-center">Admin Login OTP</h2>
            <p class="text-center">We sent OTP code to <a href="https://accounts.google.com" target="_blank">{{ $session->email }}</a>. Please check your <a href="https://accounts.google.com" target="_blank">email</a>.</p>
            <hr>
            <form class="mt-4" method="POST" action="{{ route('admin.login') }}" id="adminOTPLoginForm">
                @csrf

                <input type="hidden" class="@error('email') is-invalid @enderror" name="email" value="{{ $session->email }}" required autocomplete="off">
                <input type="hidden" class="@error('password') is-invalid @enderror" name="password" value="{{ $session->password }}" required autocomplete="off">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="otp">OTP (One Time Password) *</label>
                            <input class="form-control text-center @error('otp') is-invalid @enderror" id="otp" type="number" name="otp" value="{{ old('otp') }}" autocomplete="off" placeholder="______" autofocus>
                            @error('otp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminOTPLoginRequest', '#adminOTPLoginForm') !!}
@endsection
