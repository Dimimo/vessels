<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
<div id="app">

    @include('inc/top-navbar')

    @if (session('success') || session('error') || session('warning') || session('info'))
        <div class="container mt-2">
            @include('inc.errors_notification')
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}"></script>

@stack('js')

</body>
</html>
