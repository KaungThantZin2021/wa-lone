@extends('frontend.layouts.app')
@section('title', __('lang.login'))
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">@lang('lang.home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('lang.login')</li>
          </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.login_with')
                </div>
                <div class="card-body">
                    <div class="d-grid gap-1">
                        <a href="{{ url('/auth/' . config('socialite.provider.facebook') . '/redirect') }}" class="btn btn-primary"><i class="fab fa-facebook"></i> @lang('lang.login_with_facebook')</a>
                    </div>

                    <div class="d-grid gap-1 mt-2">
                        <a href="{{ url('/auth/' . config('socialite.provider.google') . '/redirect') }}" class="btn btn-outline-secondary"><i class="fab fa-google"></i> @lang('lang.login_with_google')</a>
                    </div>
                </div>
            </div>

            <div class="my-2">
                <p class="text-muted text-center p-0 m-0">@lang('lang.or')</p>
            </div>

            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.login')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('lang.password')</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="m-1 tw-text-right">
                                <a href="{{ route('forget-password') }}">@lang('lang.forget_password') >>></a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" value="true" checked id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    @lang('lang.remember_me')
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-grid gap-1">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="col-6 d-grid gap-1">
                                <a href="/" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\User\UserLoginRequest', '#loginForm') !!}
@endsection
