@extends('frontend.layouts.app')
@section('title', __('lang.new_password'))
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">@lang('lang.home')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('login') }}" class="text-decoration-none">@lang('lang.login')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('forget-password') }}" class="text-decoration-none">@lang('lang.forget_password')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('lang.create_new_password')</li>
          </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.create_new_password')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('change-password') }}" id="newPasswordForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ $session->email }}">
                        <input type="hidden" name="otp" value="{{ $session->otp }}">

                        <div class="mb-3">
                            <label for="newPassword" class="form-label">@lang('lang.new_password')</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword">
                            @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">@lang('lang.confirm_password')</label>
                            <input type="password" name="confirm_password" class="form-control @error('new_password') is-invalid @enderror" id="confirmPassword">
                            @error('new_password')
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
{!! JsValidator::formRequest('App\Http\Requests\User\NewPasswordRequest', '#newPasswordForm') !!}
@endsection
