@extends('layouts.app')
@section('title', config('app.name', 'Wa Lone').' Admin Login')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="col-md-4 col-sm-12">
                    <h1 class="text-center">{{ config('app.name') }}</h1>
                </div>
                <div class="col-md-8 col-sm-12 card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Admin Login</h3>
                        <form method="POST" action="{{ route('admin.two-step-otp') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email *</label>
                                <input id="email" type="email" class="form-control text-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" type="password" class="form-control text-light @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> Remember me </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
