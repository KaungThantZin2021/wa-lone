<div class="row bg-primary">
    <div class="col-md-12">
        <div class=" d-flex justify-content-between p-0 m-0">
            <div class="py-2 px-4">
                <div class="d-flex justify-content-center">
                    <div class="me-2">
                        <a href="" class="btn btn-sm btn-outline-light rounded-circle"><i
                                class="fas fa-cog"></i></a>
                    </div>
                    <div>
                        <select class="m-0 py-1 bg-primary border-0 text-light">
                            <option selected>English</option>
                            <option value="1">မြန်မာ</option>
                        </select>
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
                        <a href="{{ route('login') }}" class="btn btn-sm {{ Request::is('login') ? 'btn-light' : 'btn-outline-light' }} m-0">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm {{ Request::is('register') ? 'btn-light' : 'btn-outline-light' }} m-0">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>