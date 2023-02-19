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
                    {{-- <div class="card-header py-3 tw-relative tw-h-52 text-center tw-bg-cover tw-bg-center" id=""
                        style="background-image: url({{ is_null(currentUser()->cover_photo)
                        ? 'https://ui-avatars.com/api/?format=svg&background=random&name=' . str_replace(' ', '%20', currentUser()->name)
                        : currentUser()->originalCoverPhotoPath() }})">
                        <div class="tw-absolute tw-left-4 tw--bottom-8 rounded-circle bg-white">
                            <img class="rounded-circle border border-2 border-primary p-1 m-1" id="profilePhoto"
                            src="{{ is_null(currentUser()->profile_photo)
                                ? 'https://ui-avatars.com/api/?format=svg&background=random&name=' . currentUser()->name
                                : currentUser()->originalProfilePhotoPath()
                            }}"
                            alt="" width="100px" height="100px">
                        </div>
                    </div> --}}

                    <div class="p-0 m-0 tw-relative">
                        <img class="tw-w-full tw-h-52 tw-object-cover tw-rounded-t-md" id="coverPhoto"
                        src="{{ is_null(currentUser()->cover_photo)
                            ? 'https://ui-avatars.com/api/?format=svg&background=0c6dfc&color=fff&name=' . currentUser()->name
                            : currentUser()->originalCoverPhotoPath() }}"
                        title="{{ currentUser()->name . "'s cover photo" }}">

                        <div class="tw-absolute tw-left-4 tw--bottom-8 rounded-circle bg-white">
                            <img class="rounded-circle border border-2 border-primary p-1 m-1" id="profilePhoto"
                            src="{{ is_null(currentUser()->profile_photo)
                                ? 'https://ui-avatars.com/api/?format=svg&background=fff&color=0c6dfc&name=' . currentUser()->name
                                : currentUser()->originalProfilePhotoPath() }}"
                            title="{{ currentUser()->name }}" width="100px" height="100px">
                        </div>
                    </div>

                    <div class="card-body">
                        <h3 class="my-3">{{ currentUser()->name }}</h3>

                        <div class='onesignal-customlink-container'></div>

                        @if (currentUser()->email)
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-envelope"></i> Email</label>
                            <p class="text-muted">{{ currentUser()->email }}</p>
                            <hr>
                        </div>
                        @endif
                        @if (currentUser()->phone)
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-phone"></i> Phone</label>
                            <p class="text-muted">{{ currentUser()->phone }}</p>
                            <hr>
                        </div>
                        @endif
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-venus-mars"></i> Gender</label>
                            <p class="text-muted">{{ ucfirst(currentUser()->gender) }}</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-birthday-cake"></i> Date of birth</label>
                            <p class="text-muted">{{ currentUser()->dob }}</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-user-clock"></i> login at</label>
                            <p class="text-muted">{{ currentUser()->login_at }} ({{ Carbon\Carbon::parse(currentUser()->login_at)->diffForHumans() }})</p>
                            <hr>
                        </div>
                        <div>
                            <label class="tw-text-gray-600 tw-font-bold"><i class="fas fa-user-check"></i> Created at</label>
                            <p class="text-muted">{{ currentUser()->created_at }} ({{ currentUser()->created_at->diffForHumans() }})</p>
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

@section('script')
<script>
    $(() => {
        new Viewer(document.getElementById('profilePhoto'));
        new Viewer(document.getElementById('coverPhoto'));
    });
</script>
@endsection
