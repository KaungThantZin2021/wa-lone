@extends('frontend.layouts.app')
@section('title', __('lang.profile'))
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('lang.profile')</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 tw-flex tw-justify-center animate__animated animate__fadeInDown">
            <div class="col-md-4 col-sm-12">
                <div class="card border border-0 tw-drop-shadow-xl mb-3">
                    <div class="card-header py-3 text-center">
                        <img class="rounded-circle border border-2 border-primary p-1"
                            src="https://ui-avatars.com/api/?format=svg&background=random&name={{ auth()->user()->name }}"
                            alt="" width="100px" height="100px">
                        <h3 class="my-2">{{ auth()->user()->name }}</h3>
                    </div>

                    <div class="card-body">

                        <div class='onesignal-customlink-container'></div>

                        @if (auth()->user()->email)
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-envelope"></i> Email</label>
                            <p class="text-muted">{{ auth()->user()->email }}</p>
                            <hr>
                        </div>
                        @endif
                        @if (auth()->user()->phone)
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-phone"></i> Phone</label>
                            <p class="text-muted">{{ auth()->user()->phone }}</p>
                            <hr>
                        </div>
                        @endif
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-venus-mars"></i> Gender</label>
                            <p class="text-muted">{{ ucfirst(auth()->user()->gender) }}</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-birthday-cake"></i> Date of birth</label>
                            <p class="text-muted">{{ auth()->user()->dob }}</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-user-clock"></i> login at</label>
                            <p class="text-muted">{{ auth()->user()->login_at }} ({{ Carbon\Carbon::parse(auth()->user()->login_at)->diffForHumans() }})</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-user-check"></i> Created at</label>
                            <p class="text-muted">{{ auth()->user()->created_at }} ({{ auth()->user()->created_at->diffForHumans() }})</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row py-2">
                            <div class="col-6 d-grid gap-1">
                                <a href="/" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit Profile</a>
                            </div>
                            <div class="col-6 d-grid gap-1">
                                <a href="#" class="btn btn-danger" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
