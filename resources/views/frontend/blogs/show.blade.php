@extends('frontend.layouts.app')
@section('title', __('lang.blogs'))
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs') }}"
                        class="text-decoration-none">@lang('lang.blogs')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ \Str::limit($blog->title, 20) }}</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <div class="tw-relative">
                    <img class="tw-w-full tw-h-96 tw-object-cover tw-rounded" src="{{ $blog->thumbnailPath() }}" alt="">
                    <span class="tw-absolute tw-top-2 tw-right-2 text-light tw-text-sm bg-primary bg-opacity-50 tw-rounded px-1">{{ $blog->created_at->diffForHumans() }}</span>
                    <h2 class="card-title tw-absolute tw-bottom-0 tw-left-0 m-2 tw-break-all text-light bg-primary bg-opacity-50 tw-leading-normal tw-rounded p-2">{{ $blog->title }}</h2>
                </div>
                <div class="my-4">
                    {!! $blog->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
