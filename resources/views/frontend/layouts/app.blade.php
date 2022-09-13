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
            })
        });
    </script>
</body>

</html>
