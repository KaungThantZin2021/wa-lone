@extends('frontend.layouts.app')
@section('title', __('lang.otp_code'))
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">@lang('lang.home')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('login') }}" class="text-decoration-none">@lang('lang.login')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('forget-password') }}" class="text-decoration-none">@lang('lang.forget_password')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('lang.otp_code')</li>
          </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.otp_code')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('new-password') }}" id="otpCodeForm">
                        @csrf

                        <ul class="text-muted px-3">
                            <li>We sent OTP Code to <span class="text-primary tw-underline">{{ $email }}</span>.</li>
                            <li>Please enter OTP Code to verify.</li>
                        </ul>
                        <hr>
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="mb-3">
                            <label for="otp" class="form-label">@lang('lang.otp_code')</label>
                            <input type="number" name="otp" class="form-control text-center @error('otp') is-invalid @enderror" id="otp" placeholder="------">
                            @error('otp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6 d-grid gap-1">
                                <button type="submit" class="btn btn-primary">@lang('lang.confirm')</button>
                            </div>
                            <div class="col-6 d-grid gap-1">
                                <a href="{{ route('login') }}" class="btn btn-secondary">@lang('lang.cancel')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\User\OTPCodeRequest', '#otpCodeForm') !!}
@endsection
