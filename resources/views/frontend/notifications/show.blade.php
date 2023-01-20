@extends('frontend.layouts.app')
@section('title', __('lang.notification_detail'))
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notifications') }}"
                        class="text-decoration-none">@lang('lang.notifications')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('lang.notification_detail')</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 tw-flex tw-justify-center animate__animated animate__fadeInDown">
            <div class="col-md-6">
                <div class="card border border-0 tw-drop-shadow-xl mb-3">
                    <div class="card-body">
                        <h3 class="my-2 text-primary">{{ $notification->data['title'] }}</h3>
                        <div class="border-top border-bottom py-3">
                            <p class="text-muted mb-0">{{ $notification->data['description'] }}</p>
                        </div>
                        <div class="tw-flex tw-justify-between py-3 mb-0">
                            <div>
                                <label for="">Notified at</label>
                                <p class="text-muted mb-0">{{ $notification->created_at }} ({{ $notification->created_at->diffForHumans() }})</p>
                            </div>
                            @if (!is_null($notification->read_at))
                            <div>
                                <label for="">Read at</label>
                                <p class="text-success mb-0">{{ $notification->read_at }} ({{ $notification->read_at->diffForHumans() }})</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
