@extends('frontend.layouts.app')
@section('title', __('lang.forget_password'))
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">@lang('lang.home')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('login') }}" class="text-decoration-none">@lang('lang.login')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('lang.forget_password')</li>
          </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.forget_password')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('send-request') }}" id="forgetPassword">
                        @csrf
                        <ul class="text-muted px-3">
                            <li>To get new password, we have to verify your account.</li>
                            <li>Please fill your registerated walone account email and we will send OTP code.</li>
                        </ul>
                        <hr>
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('lang.email')</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
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
{!! JsValidator::formRequest('App\Http\Requests\User\ForgetPasswordRequest', '#forgetPassword') !!}
@endsection
