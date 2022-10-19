<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('prepend-style')
    @include('components.style')
    @stack('addon-style')
</head>
<body>
<div id="app">
    {{--    navbar --}}
    @include('components.navbar')

    {{--    Page Content --}}
    @yield('content')

    {{--    Footer --}}
    @include('components.footer')

    {{--    Script --}}
    @stack('prepend-script')
    @include('components.script')
    @stack('addon-script')
</div>
</body>
</html>
