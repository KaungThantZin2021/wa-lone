<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Corona Template -->
    <!-- plugins:css -->
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}>
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap.css') }}>
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}>
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('backend/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href={{ asset('backend/assets/css/style.css') }}>
    <!-- End layout styles -->
    <link rel="shortcut icon" href={{ asset('backend/assets/images/favicon.png') }} />
    <!-- End Corona Template -->

</head>

<body>
    <div id="app">
        @if (auth()->guard('admin_user')->check())
            @include('layouts.navbar')
        @endif

        <main class="">
            @yield('content')
        </main>
    </div>

    <!-- Corona Template -->
    <!-- plugins:js -->
    <script src={{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src={{ asset('backend/assets/vendors/chart.js/Chart.min.js') }}></script>
    <script src={{ asset('backend/assets/vendors/progressbar.js/progressbar.min.js') }}></script>
    <script src={{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}></script>
    <script src={{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}></script>
    <script src={{ asset('backend/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{ asset('backend/assets/js/off-canvas.js') }}></script>
    <script src={{ asset('backend/assets/js/hoverable-collapse.js') }}></script>
    <script src={{ asset('backend/assets/js/misc.js') }}></script>
    <script src={{ asset('backend/assets/js/settings.js') }}></script>
    <script src={{ asset('backend/assets/js/todolist.js') }}></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src={{ asset('backend/assets/js/dashboard.js') }}></script>
    <!-- End custom js for this page -->
    <!-- End Corona Template -->

    <script>
        $(() => {            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            if ("{{ session()->has('error') }}") {
                toastr.error("{{ session()->get('error') }}");
                // toastr.options.progressBar = true;
            }

            // toastr.options = {
            //     "closeButton": true,
            //     "debug": false,
            //     "newestOnTop": false,
            //     "progressBar": true,
            //     "positionClass": "toast-bottom-right",
            //     "preventDuplicates": false,
            //     "onclick": null,
            //     "showDuration": "300",
            //     "hideDuration": "1000",
            //     "timeOut": "5000",
            //     "extendedTimeOut": "1000",
            //     "showEasing": "swing",
            //     "hideEasing": "linear",
            //     "showMethod": "fadeIn",
            //     "hideMethod": "fadeOut",
            //     "tapToDismiss": false
            // }

        })
    </script>

    @yield('script')

</body>

</html>