@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">OTP (One Time Password)</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <input type="hidden" class="form-control text-light @error('email') is-invalid @enderror" name="email" value="{{ $session->email }}" required autocomplete="email">
                        <input type="hidden" class="form-control text-light @error('password') is-invalid @enderror" name="password" value="{{ $session->password }}" required autocomplete="current-password">

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

                        <div class="row mb-3">
                            <label for="otp" class="col-md-4 col-form-label text-md-end">OTP</label>

                            <div class="col-md-6">
                                <input id="otp" type="number" class="form-control text-center text-light @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" autocomplete="off" placeholder="______" autofocus>

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm OTP') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
