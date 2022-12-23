@extends('frontend.layouts.app')
@section('title', __('lang.blogs'))
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('lang.blogs')</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <h1 class="text-center mb-3 animate__animated animate__pulse">@lang('lang.blogs')</h1>
                <div class="row d-flex justify-content-center">
                    @forelse ($blogs as $blog)
                    <div class="col-md-4">
                        <a href="{{ route('blog.show', $blog->id) }}" class="text-decoration-none text-dark">
                            <div class="card border border-0 tw-transition tw-ease-in-out tw-drop-shadow-xl hover:tw-drop-shadow-sm hover:tw-scale-95 tw-duration-300 mb-3">
                                <div class="tw-relative">
                                    <img src="{{ $blog->thumbnail }}" class="card-img tw-h-72 tw-object-cover" alt="...">
                                    <span class="tw-absolute tw-top-2 tw-right-2 text-light tw-text-sm bg-primary bg-opacity-50 tw-rounded px-1">{{ $blog->created_at->diffForHumans() }}</span>
                                    <h5 class="card-title tw-absolute tw-bottom-0 tw-left-0 m-2 tw-break-all text-light bg-primary bg-opacity-50 tw-leading-normal tw-rounded p-2">{!! \Str::limit($blog->title, 70, ' ... <b class="hover:tw-underline">See more</b>') !!}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-md-6">
                        <div class="alert alert-dismissible alert-primary">
                            <h5 class="text-center">No blog yet !</h5>
                            <p class="text-center">Coming Soon ...</p>
                            <p class="text-center"><a href="{{ route('home') }}"><<< Back to home page</a></p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
