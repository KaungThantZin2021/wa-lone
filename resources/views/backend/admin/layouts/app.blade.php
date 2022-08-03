<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- Corona Template --}}
    <!-- plugins:css -->
    <link rel="stylesheet" href={{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/css/vendor.bundle.base.css') }}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <!-- End layout styles -->
    <link rel="shortcut icon" href={{ asset('assets/images/favicon.png') }} />
    {{--End Corona Template --}}

</head>

<body>
    <div id="app">
        @if (auth()->guard('admin_user')->check())
            @include('backend.admin.layouts.navbar')
        @endif

        <main class="">
            @yield('content')
        </main>
    </div>

    {{-- Corona Template --}}
    <!-- plugins:js -->
    <script src={{ asset('assets/vendors/js/vendor.bundle.base.js') }}></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src={{ asset('assets/vendors/chart.js/Chart.min.js') }}></script>
    <script src={{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}></script>
    <script src={{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}></script>
    <script src={{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}></script>
    <script src={{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{ asset('assets/js/off-canvas.js') }}></script>
    <script src={{ asset('assets/js/hoverable-collapse.js') }}></script>
    <script src={{ asset('assets/js/misc.js') }}></script>
    <script src={{ asset('assets/js/settings.js') }}></script>
    <script src={{ asset('assets/js/todolist.js') }}></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src={{ asset('assets/js/dashboard.js') }}></script>
    <!-- End custom js for this page -->
    {{--End Corona Template --}}

</body>

</html>
