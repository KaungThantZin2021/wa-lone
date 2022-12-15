<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/default.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    {{-- <link href="https://fonts.cdnfonts.com/css/baloo" rel="stylesheet"> --}}

</head>
<style>
    body {
        /* margin: 0 !important; */
        /* padding: 0 !important; */
        background: #eef1fc;
    }
</style>

@yield('css')

<body>
    <div id="mainPageLoader" class="tw-fixed tw-flex tw-items-center tw-justify-center tw-z-50 tw-bg-gray-100" style="width: 100% !important; height: 100% !important;">
        <img src="{{ asset('frontend/images/loader.gif') }}" class="tw-w-24 tw-h-24" alt="">
    </div>
    <div class="container-fluid">

        @include('frontend.layouts.topbar')

        @include('frontend.layouts.navbar')

        <div class="my-3">
            @yield('content')
        </div>

        @include('frontend.layouts.footer')

    </div>

    @if (!auth()->guard('web')->check())
    @if (!Request::is('login') && !Request::is('forget-password') && !Request::is('register'))
    <div class="toast fade show animate__animated animate__shakeX tw-z-20 tw-fixed tw-bottom-5 tw-right-5 bg-primary bg-opacity-50 border border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto text-primary">{{ config('app.name') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        <div class="toast-body">
          <p class="text-light p-0 m-0">Please Login or Register</p>
          <div class="mt-2 pt-2 border-top">
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary shadow-lg bg-opacity-75 m-0">@lang('lang.login')</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary shadow-lg bg-opacity-75 m-0">@lang('lang.register')</a>
            </div>
        </div>
    </div>
    @endif
    @endif

    {{-- <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

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
            });

            $(document).on('click', '.change-language', function (e) {
                e.preventDefault();
                var lang = $(this).data('lang');

                $.post('/change-language', {lang}).done(function (res) {
                    if (res.result == 1) {
                        window.location.reload();
                    }
                })
                .fail(function (error) {
                   console.log(error);
                });
            });

            $('#mainPageLoader').fadeOut();
        });
    </script>

    @yield('script')
</body>

</html>
