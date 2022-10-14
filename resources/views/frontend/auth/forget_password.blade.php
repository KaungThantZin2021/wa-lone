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
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.forget_password')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('forget-password.store') }}" id="forgetPasswordForm">
                        @csrf

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
                            <div class="d-grid gap-1">
                                <button type="submit" class="btn btn-block btn-primary">Send Password Reset Link</button>
                                <a href="{{ route('login') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center my-2">@lang('lang.if_you_do_not_have_an_account')</p>

        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\User\ForgetPasswordRequest', '#forgetPasswordForm') !!}
@endsection
