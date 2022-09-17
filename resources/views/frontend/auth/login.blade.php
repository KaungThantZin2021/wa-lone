@extends('frontend.layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    Login with Social Media
                </div>
                <div class="card-body">
                    <div class="d-grid gap-1">
                        <a href="{{ url('/auth/' . config('socialite.provider.facebook') . '/redirect') }}" class="btn btn-primary"><i class="fab fa-facebook"></i> Login with Facebook</a>
                    </div>

                    <div class="d-grid gap-1 mt-2">
                        <a href="{{ url('/auth/' . config('socialite.provider.google') . '/redirect') }}" class="btn btn-outline-secondary"><i class="fab fa-google"></i> Login with Google</a>
                    </div>
                </div>
            </div>

            <div class="my-2">
                <p class="text-muted text-center p-0 m-0">OR</p>
            </div>

            <div class="card">
                <div class="card-header text-primary">
                    Login
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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

            <p class="text-center my-2">If you don't have an account, go to <a href="{{ route('register') }}">Register >>>.</a></p>

        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
@endsection
