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
        /* margin: 0 !important; */
        /* padding: 0 !important; */
        background: #eeeeee;
    }
</style>

<body>
    <div id="mainPageLoader" class="tw-absolute tw-flex tw-items-center tw-justify-center tw-w-screen tw-h-screen tw-z-10 tw-bg-gray-100" style="width: 100% !important; height: 100% !important;">
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
            });

            $('#mainPageLoader').fadeOut();
        });
    </script>
</body>

</html>
