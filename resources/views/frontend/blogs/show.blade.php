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
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <div class="tw-relative">
                    <img class="tw-w-full tw-h-96 tw-object-cover" src="{{ $blog->thumbnail_path() }}" alt="">
                    <h2 class="tw-absolute tw-bottom-2 tw-left-2 text-light bg-primary bg-opacity-50 p-2">{{ $blog->title }}</h2>
                </div>
                <div>
                    {!! $blog->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
