<div class="tw-sticky tw-top-0 tw-z-10 tw-drop-shadow-2xl">
    <div class="row border-bottom border-1 py-2 bg-light">
        <div class="col-lg-4">
            <div class="m-0 p-2 text-center animate__animated animate__pulse">
                <a href="" class="text-decoration-none tw-text-2xl lg:tw-text-lg md:tw-text-base">{{ config('app.name') }}</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="m-0 p-2 d-flex justify-content-center">
                <div class="input-group">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">@lang('lang.all_categories')</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary" href="#"><i class="fas fa-bars"></i> @lang('lang.all_categories')</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bicycle"></i> @lang('lang.bicycels')</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-motorcycle"></i> @lang('lang.motor_cycles')</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-car"></i> @lang('lang.cars')</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                    <input type="text" class="form-control" placeholder="{{ __('lang.search_with_filter') }}"
                        aria-label="Text input with 2 dropdown buttons">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="tw-hidden md:tw-inline-block">
                        <div class="m-0 p-2 text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                   <i class="fas fa-bars"></i> Menu
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ Request::is('/') ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary' : '' }}" href="/">@lang('lang.home')</a></li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item {{ Request::is('shops') ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary' : '' }}" href="#">@lang('lang.shops')</a></li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item {{ Request::is('products') ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary' : '' }}" href="#">@lang('lang.products')</a></li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item {{ Request::is('accessories') ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary' : '' }}" href="#">@lang('lang.accessories')</a></li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item {{ Request::is('blogs') || Request::is('blog/*') ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary text-primary' : '' }}" href="{{ route('blogs') }}">@lang('lang.blogs')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="m-0 p-2 d-flex justify-content-center">
                        @if (auth()->guard('web')->check())
                        <a href="{{ route('notifications') }}" class="btn btn-sm {{ Request::is('notifications') || Request::is('notification/*') ? 'btn-primary' : 'btn-outline-primary' }} align-middle rounded me-2 tw-relative">
                            @php
                                $noti_count = auth()->guard('web')->user()->notifications->whereNull('read_at')->count();
                            @endphp
                            @if ($noti_count > 0)
                            <i class="fas fa-bell tw-absolute tw-inset-2"></i>
                            <i class="fas fa-bell tw-absolute tw-inset-2 tw-animate-ping"></i>
                            <i class="fas fa-bell tw-animate-ping"></i>
                            <span class="badge rounded-pill bg-danger tw-absolute tw--top-2 tw--right-2 border border-light">{{ $noti_count }}</span>
                            @else
                            <i class="fas fa-bell"></i>
                            @endif
                        </a>
                        @endif
                        <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                                class="fas fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                                class="fas fa-shopping-cart"></i></a>
                        @if (auth()->guard('web')->check())
                        <a href="{{ route('profile') }}" class="btn btn-sm {{ Request::is('profile') ? 'btn-primary' : 'btn-outline-primary' }} align-middle rounded" title="{{ __('lang.profile') }}"><i
                            class="fas fa-user"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row border-bottom border-1 py-1 bg-light md:tw-hidden">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12">
            <div class="m-0 p-2 d-flex justify-content-evenly">
                <a href="/" class="text-decoration-none {{ Request::is('/') ? 'text-primary animate__animated animate__tada' : 'text-dark' }}">@lang('lang.home')</a>
                <span class="text-secondary">/</span>
                <a href="" class="text-decoration-none {{ Request::is('shops') ? 'text-primary' : 'text-dark' }}">@lang('lang.shops')</a>
                <span class="text-secondary">/</span>
                <a href="" class="text-decoration-none {{ Request::is('products') ? 'text-primary' : 'text-dark' }}">@lang('lang.products')</a>
                <span class="text-secondary">/</span>
                <a href="" class="text-decoration-none {{ Request::is('accessories') ? 'text-primary' : 'text-dark' }}">@lang('lang.accessories')</a>
                <span class="text-secondary">/</span>
                <a href="{{ route('blogs') }}" class="text-decoration-none {{ Request::is('blogs') || Request::is('blog/*') ? 'text-primary animate__animated animate__tada' : 'text-dark' }}">@lang('lang.blogs')</a>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
