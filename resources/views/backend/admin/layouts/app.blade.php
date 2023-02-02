<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/images/favicon.png') }}">
    <title>@yield('title')</title>

    @yield('css')

    @include('backend.admin.layouts._partials.css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader dark:tw-bg-slate-800">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('backend.admin.layouts.topbar')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('backend.admin.layouts.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper tw-bg-blue-50 dark:tw-bg-slate-900">
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'tw-dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: tw-dark)').matches)) {
            document.documentElement.classList.add('tw-dark');
        } else {
            document.documentElement.classList.remove('tw-dark')
        }

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'tw-dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: tw-dark)').matches)) {
            themeToggleLightIcon.classList.remove('tw-hidden');
        } else {
            themeToggleDarkIcon.classList.remove('tw-hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('tw-hidden');
            themeToggleLightIcon.classList.toggle('tw-hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'tw-light') {
                    document.documentElement.classList.add('tw-dark');
                    localStorage.setItem('color-theme', 'tw-dark');
                } else {
                    document.documentElement.classList.remove('tw-dark');
                    localStorage.setItem('color-theme', 'tw-light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('tw-dark')) {
                    document.documentElement.classList.remove('tw-dark');
                    localStorage.setItem('color-theme', 'tw-light');
                } else {
                    document.documentElement.classList.add('tw-dark');
                    localStorage.setItem('color-theme', 'tw-dark');
                }
            }
        });
    </script>

    @include('backend.admin.layouts._partials.script')

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    <script>
        $(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (document.getElementById('previous-btn')) {
                document.getElementById('previous-btn').onclick = function () {
                    window.history.back();
                };
            }

            $.extend( true, $.fn.dataTable.defaults, {
                autoFill: true,
                mark: {
                    className: 'bg-transparent text-success p-0'
                },
                language: {
                    "processing": "<span class='fa-stack fa-lg'>\n\
                                    <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                                </span>&emsp;Processing ...",
                }
            });

            $.fn.dataTable.ext.buttons.refresh = {
                text: '<i class="fa fa-sync text-light"></i>',
                className: 'bg-success',
                action: function ( e, dt, node, config ) {
                    dt.clear().draw();
                    dt.ajax.reload();
                }
            };

            @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            })
            @endif
        });
    </script>

    @yield('script')

</body>

</html>
