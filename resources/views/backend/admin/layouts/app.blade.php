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


    {{-- Corona Template --}}
    @include('backend.admin.layouts._partials.css')
    {{-- End Corona Template --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.css"/> --}}


    @yield('css')

</head>

<body>
    <div id="app">
        <div class="container-scroller">

            <!-- partial:partials/_sidebar.html -->
            @include('backend.admin.layouts.sidebar')
            <!-- partial -->

            <div class="container-fluid page-body-wrapper">

                @if (auth()->guard('admin_user')->check())
                    @include('backend.admin.layouts.navbar')
                @endif

                <div class="main-panel">
                    <div class="content-wrapper">
                        <!-- partial -->
                        @yield('content')
                        <!-- main-panel ends -->
                    </div>

                    <!-- partial:partials/_footer.html -->
                    @include('backend.admin.layouts.footer')
                    <!-- partial -->
                </div>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    </div>

    {{-- Corona Template --}}
    @include('backend.admin.layouts._partials.script')
    {{-- End Corona Template --}}

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.js"></script> --}}

    @yield('script')

    <script>
        document.getElementById('previous-btn').onclick = function () {
            window.history.back();
        };

        // $.extend(true, $.fn.dataTable.defaults, {
        //     mark: true
        // });
    </script>
</body>

</html>
