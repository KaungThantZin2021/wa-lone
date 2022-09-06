<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/default.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
{{-- <style>
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
</style> --}}

<body>
    <div class="container-fluid">
        <div class="row bg-primary">
            <div class="col-md-12">
                <div class=" d-flex justify-content-between p-0 m-0">
                    <div class="py-2 px-4">
                        <div class="d-flex justify-content-center">
                            <div class="me-2">
                                <button class="btn btn-sm btn-outline-light rounded-circle"><i
                                        class="fas fa-cog"></i></button>
                            </div>
                            <div>
                                <select class="m-0 py-1 bg-primary border-0 text-light">
                                    <option selected>English</option>
                                    <option value="1">Myanmar</option>
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
                                        src="https://cdn.vectorstock.com/i/1000x1000/06/18/male-avatar-profile-picture-vector-10210618.webp"
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
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light m-0">Login In</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light m-0">Register</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-0 border-bottom border-1 py-2">
            <div class="col-md-4">
                <div class="m-0 p-2">
                    <h3 class="text-primary text-center text-nowrap">{{ config('app.name') }}</h3>
                </div>
            </div>

            <div class="col-md-5">
                <div class="m-0 p-2">
                    <div class="input-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">All Categoies</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action before</a></li>
                            <li><a class="dropdown-item" href="#">Another action before</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                        <input type="text" class="form-control" placeholder="Search with filter"
                            aria-label="Text input with 2 dropdown buttons">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="m-0 p-2 text-center">
                    <button class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                            class="fas fa-heart"></i></button>
                    <button class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                            class="fas fa-shopping-cart"></i></button>
                    <button class="btn btn-sm btn-outline-primary align-middle rounded"><i
                        class="fas fa-user"></i></button>
                </div>
            </div>
        </div>

        <div class="row m-0 border-bottom border-1 py-1">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-12">
                <div class="m-0 p-2 d-flex justify-content-evenly">
                    <a href="/" class="text-decoration-none">Home</a>
                    <a href="" class="text-decoration-none text-dark">Shops</a>
                    <a href="" class="text-decoration-none text-dark">accessories</a>
                    <a href="" class="text-decoration-none text-dark">Blogs</a>
                    <a href="" class="text-decoration-none text-dark">Contact Us</a>
                    <a href="" class="text-decoration-none text-dark">About Us</a>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="my-3">
            @yield('content')
        </div>
    </div>


    {{-- <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#logout', function (e) {
                e.preventDefault();
                $('#logoutForm').submit();
            })
        });
    </script>
</body>

</html>
