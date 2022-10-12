@extends('frontend.layouts.app')
@section('title', __('lang.register'))
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">@lang('lang.home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('lang.register')</li>
          </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.register_with')
                </div>
                <div class="card-body">
                    <div class="d-grid gap-1">
                        <a href="{{ url('/auth/' . config('socialite.provider.facebook') . '/redirect') }}" class="btn btn-primary"><i class="fab fa-facebook"></i> @lang('lang.register_with_facebook')</a>
                    </div>

                    <div class="d-grid gap-1 mt-2">
                        <a href="{{ url('/auth/' . config('socialite.provider.google') . '/redirect') }}" class="btn btn-outline-secondary"><i class="fab fa-google"></i> @lang('lang.register_with_google')</a>
                    </div>
                </div>
            </div>

            <div class="my-2">
                <p class="text-muted text-center p-0 m-0">@lang('lang.or')</p>
            </div>

            @include('frontend.layouts.flash')

            <div class="card">
                <div class="card-header text-primary">
                    @lang('lang.register')
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('lang.name')</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <br>
                            <div class="row">
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="male" value="male" checked autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary for="male"><i class="fas fa-male"></i> Male</label>
                                </div>
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="female" value="female" autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary for="female"><i class="fas fa-female"></i> Female</label>
                                </div>
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="other" value="other" autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary for="other"><i class="fas fa-genderless"></i> Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" checked id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Remember me
                            </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-grid gap-1">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                            <div class="col-6 d-grid gap-1">
                                <a href="/" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center my-2">If you have an account, go to <a href="{{ route('login') }}">Login >>>.</a></p>

        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\User\UserRegisterRequest', '#registerForm') !!}
@endsection
