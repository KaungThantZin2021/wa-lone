@extends('frontend.layouts.app')
@section('title', __('lang.home'))
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('lang.home')</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="col-md-8 col-sm-12">
                <div id="carouselBicycle" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($bicycle_sliders as $key => $slider)
                        <button type="button" data-bs-target="#carouselBicycle" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="true" aria-label="{{ $slider->title }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($bicycle_sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $slider->sliderPath() }}"
                                class="d-block w-100 tw-h-96 lg:tw-h-80 md:tw-h-44 sm:tw-h-56 xs:tw-h-56 tw-object-cover" alt="{{ $slider->title }}">
                            <div class="carousel-caption d-none d-md-block">
                                @if ($slider->title)
                                <h5><span class="text-light bg-primary bg-opacity-50 tw-rounded p-1">{{ $slider->title }}</span></h5>
                                @endif
                                @if ($slider->description)
                                <p class="mt-3"><span class="text-light bg-primary bg-opacity-50 tw-rounded p-1">{{ $slider->description }}</span></p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBicycle"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBicycle"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">

                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselMotorCycle" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($motor_cycle_sliders as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $slider->sliderPath() }}"
                                        class="d-block w-100 tw-h-48 lg:tw-h-40 md:tw-h-44 sm:tw-h-56 xs:tw-h-56 tw-object-cover" alt="...">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMotorCycle"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselMotorCycle"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselCar" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($car_sliders as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $slider->sliderPath() }}"
                                        class="d-block w-100 tw-h-48 lg:tw-h-40 md:tw-h-44 sm:tw-h-56 xs:tw-h-56 tw-object-cover" alt="...">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCar" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselCar" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-primary bg-opacity-25 tw-rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <h1 class="text-center mb-3">@lang('lang.shops')</h1>
                <div class="row d-flex justify-content-center">

                    @forelse ($blogs as $blog)
                    <div class="col-md-3">
                        <a href="" class="text-decoration-none text-dark">
                            <div class="card border border-0 tw-transition tw-ease-in-out tw-drop-shadow-xl hover:tw-drop-shadow-sm hover:tw-scale-95 tw-duration-300 mb-3">
                                <img src="https://d1mgeijqpfaspl.cloudfront.net/uploads/bike/image_side/thumbs/628/6399e589302b3_IMG_2229.JPG" class="card-img" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-md-8">
                        <div class="alert alert-dismissible alert-primary">
                            <h5 class="text-center">No blog yet !</h5>
                            <p class="text-center">Coming Soon ...</p>
                            <p class="text-center"><a href="{{ route('blogs') }}">Go to blogs page >>></a></p>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if ($blogs)
                <div class="text-center">
                    <a href="{{ route('blogs') }}" class="btn btn-sm btn-primary my-2 tw-animate-bounce">See More Blogs ...</a>
                </div>
                @endif
            </div>
        </div>

        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <h1 class="text-center mb-3">@lang('lang.products')</h1>
                <div class="row d-flex justify-content-center">

                    @forelse ($blogs as $blog)
                    <div class="col-md-4">
                        <a href="" class="text-decoration-none text-dark">
                          <div class="card border-light mb-3" style="height: 300px;">
                            <div class="card-header">{{ $blog->title }}</div>
                            <div class="card-body">
                                <h5 class="card-title">Light card title</h5>
                                {{ $blog->description }}
                            </div>
                        </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-md-8">
                        <div class="alert alert-dismissible alert-primary">
                            <h5 class="text-center">No blog yet !</h5>
                            <p class="text-center">Coming Soon ...</p>
                            <p class="text-center"><a href="{{ route('blogs') }}">Go to blogs page >>></a></p>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if ($blogs)
                <div class="text-center">
                    <a href="{{ route('blogs') }}" class="btn btn-sm btn-primary my-2 tw-animate-bounce">See More Blogs ...</a>
                </div>
                @endif
            </div>
        </div>

        <div class="row mb-5 animate__animated animate__fadeInDown">
            <div class="">
                <h1 class="text-center mb-3">@lang('lang.blogs')</h1>
                <div class="row d-flex justify-content-center">

                    @forelse ($blogs as $blog)
                    <div class="col-md-4">
                        <a href="{{ route('blog.show', $blog->id) }}" class="text-decoration-none text-dark">
                            <div class="card border border-0 tw-transition tw-ease-in-out tw-drop-shadow-xl hover:tw-drop-shadow-sm hover:tw-scale-95 tw-duration-300 mb-3">
                                <div class="tw-relative">
                                    <img src="{{ $blog->thumbnailPath() }}" class="card-img tw-h-64 xl:tw-h-44 lg:tw-h-44 md:tw-h-44 sm:tw-h-44 xs:tw-h-52 tw-object-cover" alt="...">
                                    <span class="tw-absolute tw-top-2 tw-right-2 text-light tw-text-sm bg-primary bg-opacity-50 tw-rounded px-1">{{ $blog->created_at->diffForHumans() }}</span>
                                    <h5 class="card-title tw-absolute tw-bottom-0 tw-left-0 m-2 tw-break-all text-light bg-primary bg-opacity-50 tw-leading-normal tw-rounded p-2">{!! \Str::limit($blog->title, 70, ' ... <b class="hover:tw-underline">See more</b>') !!}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-md-8">
                        <div class="alert alert-dismissible alert-primary">
                            <h5 class="text-center">No blog yet !</h5>
                            <p class="text-center">Coming Soon ...</p>
                            <p class="text-center"><a href="{{ route('blogs') }}">Go to blogs page >>></a></p>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if ($blogs)
                <div class="text-center">
                    <a href="{{ route('blogs') }}" class="btn btn-sm btn-primary my-2 tw-animate-bounce">See More Blogs ...</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
