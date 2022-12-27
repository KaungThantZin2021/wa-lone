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
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg"
                                class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg"
                                class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg"
                                class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">

                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://cdn.dribbble.com/users/8066256/screenshots/15918044/cycle-sell-post-design_4x.jpg"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://cdn.dribbble.com/users/3488450/screenshots/14969137/media/b41bfb478d26a25643d46b98a2604afa.png?compress=1&resize=400x300"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://www.promaticsindia.com/blog/wp-content/uploads/2018/07/World%E2%80%99s-top-bike-sharing-Programs-and-Apps.jpg"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQT-d8cgqC44RIS83OmHNugQwMc7b7MGAk7MGas2SWg7332ZprpvhyQMwtpqL8L-XxWPOs&usqp=CAU"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://e7.pngegg.com/pngimages/647/843/png-clipart-trek-bicycle-corporation-bicycle-shop-logo-electra-bicycle-company-giant-bike-text-trademark.png"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQl_Y1lToB3urd0a0ri1F3oCHylN6KM17vvJQ&usqp=CAU"
                                        class="d-block w-100" alt="..."
                                        style="height: 200px !important; object-fit:cover">
                                </div>
                            </div>
                            <!--
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    -->
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
                                    <img src="{{ $blog->thumbnailPath() }}" class="card-img tw-h-72 tw-object-cover" alt="...">
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
