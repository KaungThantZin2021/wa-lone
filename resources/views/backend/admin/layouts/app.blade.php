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
