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

    {{-- Default --}}
    <link href="{{ asset('backend/css/default.css') }}" rel="stylesheet">

    {{-- Corona Template --}}
    @include('backend.admin.layouts._partials.css')
    {{-- End Corona Template --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/datatable/css/datatables.min.css') }}"/> --}}


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
 
    {{-- <script type="text/javascript" src="{{ asset('backend/datatable/js/pdfmake.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('backend/datatable/js/vfs_fonts.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('backend/datatable/js/datatables.min.js') }}"></script> --}}

    <script>
        $(() => {
            document.getElementById('previous-btn').onclick = function () {
                window.history.back();
            };

            $.extend( true, $.fn.dataTable.defaults, {
                "language": {
                    "processing": "<span class='fa-stack fa-lg'>\n\
                                        <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                                </span>&emsp;Processing ...",
                }
            });

            console.log($.fn);

            $.fn.dataTable.ext.buttons.refresh = {
            text: '<i class="fa fa-sync text-light"></i>',
            className: 'bg-success',
                action: function ( e, dt, node, config ) {
                    dt.clear().draw();
                    dt.ajax.reload();
                }
            };

        });
    </script>

@yield('script')

</body>

</html>
