<div class="row bg-primary">
    <div class="col-md-12">
        <div class=" d-flex justify-content-between p-0 m-0">
            <div class="py-2 px-4">
                <div class="d-flex justify-content-center">
                    <div class="me-2">
                        <a href="" class="btn btn-sm btn-outline-light rounded-circle"><i
                                class="fas fa-cog"></i></a>
                    </div>
                    <div class="d-flex justify-content-center p-0 m-0">
                        <div class="me-2 my-0">
                            <img class="rounded"
                                @if (app()->isLocale(config('app.available_language.english')))
                                    src="{{ asset('frontend/images/flags/english-circle.png') }}"
                                @elseif (app()->isLocale(config('app.available_language.myanmar')))
                                    src="{{ asset('frontend/images/flags/myanmar-circle.png') }}"
                                @endif
                                alt="" width="30px" height="30px">
                        </div>
                        <div class="py-1">
                            <p class="text-light m-0 dropdown-toggle" id="languageDropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (app()->isLocale(config('app.available_language.english')))
                                    English
                                @elseif (app()->isLocale(config('app.available_language.myanmar')))
                                    မြန်မာ
                                @endif
                            </p>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdownMenuButton">
                                <li>
                                    <a class="dropdown-item py-0 
                                        {{ app()->isLocale(config('app.available_language.english')) ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary bg-light' : '' }}
                                        change-language" data-lang="{{ config('app.available_language.english') }}" href="">
                                        <img class="rounded"
                                            src="{{ asset('frontend/images/flags/english-circle.png') }}"
                                            alt="" width="25px" height="25px">
                                        English
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item py-0
                                        {{ app()->isLocale(config('app.available_language.myanmar')) ? 'border border-top-0 border-bottom-0 border-end-0 border-3 border-primary bg-light' : '' }}
                                        change-language" data-lang="{{ config('app.available_language.myanmar') }}" href="">
                                        <img class="rounded"
                                            src="{{ asset('frontend/images/flags/myanmar-circle.png') }}"
                                            alt="" width="25px" height="25px">
                                        မြန်မာ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="py-2 px-4">
                <div class="d-flex justify-content-evenly">
                    <button class="btn btn-sm btn-outline-light rounded-circle"><i
                            class="fab fa-facebook"></i></button>
                    <button class="btn btn-sm btn-outline-light rounded-circle"><i
                        class="fab fa-youtube"></i></button>
                    <button class="btn btn-sm btn-outline-light rounded-circle"><i
                        class="fab fa-instagram"></i></button>
                    <button class="btn btn-sm btn-outline-light rounded-circle"><i
                        class="fab fa-twitter"></i></button>
                </div>
            </div> --}}

            <div class="py-2 px-4">
                @if (auth()->guard('web')->check())
                    <div class="d-flex justify-content-center p-0 m-0">
                        <div class="me-2 my-0">
                            <img class="rounded-circle"
                                src="https://ui-avatars.com/api/?format=svg&background=random&name={{ auth()->user()->name }}"
                                alt="" width="30px" height="30px">
                        </div>
                        <div class="py-1">
                            <p class="text-light m-0 dropdown-toggle" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </p>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#"><i class="fas fa-user"></i> View Profile</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" id="logout" href=""><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </li>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                @elseif (!auth()->guard('web')->check())
                    <div class="p-0 m-0">
                        <a href="{{ route('login') }}" class="btn btn-sm {{ Request::is('login') ? 'btn-light' : 'btn-outline-light' }} m-0">@lang('lang.login')</a>
                        <a href="{{ route('register') }}" class="btn btn-sm {{ Request::is('register') ? 'btn-light' : 'btn-outline-light' }} m-0">@lang('lang.register')</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>