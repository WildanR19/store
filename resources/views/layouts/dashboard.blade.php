<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('prepend-style')
    @include('components.style')
    @stack('addon-style')
</head>
<body>
<div id="app">
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            @include('components/dashboard/sidebar')
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('components/dashboard/navbar')

                <div
                    class="section-content section-dashboard-home"
                    data-aos="fade-up"
                >
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </div>

    {{--    Footer --}}
    @include('components.footer')

    {{--    Script --}}
    @stack('prepend-script')
    @include('components.script')
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</div>
</body>
</html>
