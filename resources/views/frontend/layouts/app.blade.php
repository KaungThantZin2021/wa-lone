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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

</head>
<style>
    body {
        margin: 0 !important;
        padding: 0 !important;
        background: #eeeeee;
    }
</style>

<body>
    <div class="container-fluid">
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
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light m-0">Login In</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light m-0">Register</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row border-bottom border-1 py-2 bg-light">
            <div class="col-md-4">
                <div class="m-0 p-2">
                    <h3 class="text-primary text-center text-nowrap">
                        <a href="" class="text-decoration-none">{{ config('app.name') }}</a>
                    </h3>
                </div>
            </div>

            <div class="col-md-5">
                <div class="m-0 p-2">
                    <div class="input-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">All Categoies</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item border border-top-0 border-bottom-0 border-end-0 border-3 border-primary bg-light" href="#"><i class="fas fa-bars"></i> All Categories</a></li>                       
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-bicycle"></i> Bicycles</a></li>                       
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-motorcycle"></i> Motor Bikes</a></li>                       
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-car"></i> Cars</a></li>                       
                            <hr class="dropdown-divider">
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
                    <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                        class="fas fa-bell"></i></a>
                    <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                            class="fas fa-heart"></i></a>
                    <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                            class="fas fa-shopping-cart"></i></a>
                    <a href="" class="btn btn-sm btn-outline-primary align-middle rounded"><i
                        class="fas fa-user"></i></a>
                </div>
            </div>
        </div>

        <div class="row border-bottom border-1 py-1 bg-light">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-12">
                <div class="m-0 p-2 d-flex justify-content-evenly">
                    <a href="/" class="text-decoration-none">Home</a>
                    <a href="" class="text-decoration-none text-dark">Products</a>
                    <a href="" class="text-decoration-none text-dark">Shops</a>
                    <a href="" class="text-decoration-none text-dark">Accessories</a>
                    <a href="" class="text-decoration-none text-dark">Blogs</a>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="my-3">
            @yield('content')
        </div>

        @include('frontend.layouts.footer')
        
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
