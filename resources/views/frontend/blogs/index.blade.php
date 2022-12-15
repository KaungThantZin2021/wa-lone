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
        <div class="row mb-5">
            <div class="">
                <h1 class="text-center mb-3 animate__animated animate__pulse">@lang('lang.blogs')</h1>
                <div class="row d-flex justify-content-center">
                    @forelse ($blogs as $key => $blog)
                    <div class="col-md-4">
                        <a href="" class="text-decoration-none text-dark">
                          <div class="card border-light mb-3 animate__animated animate__jackInTheBox" style="height: 300px">
                            <div class="card-header">{{ $blog->title }}</div>
                            <div class="card-body">
                                <h5 class="card-title">Light card title</h5>
                                {{ $blog->description }}
                            </div>
                        </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-md-4">

                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
