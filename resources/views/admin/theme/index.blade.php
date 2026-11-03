<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>لوحة الإدارة</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ Vite::asset('resources/images/cms.png') }}" type="image/png">

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/admin.css','resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        @stack('styles')
    </head>
    <body class="sb-nav-fixed">
        @include('admin.theme.header')
        <div id="layoutSidenav">
            @include('admin.theme.sidebar')
            <div id="layoutSidenav_content">
                <div class="container">
                    <x-banner />
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="my-3 h2 text-secondary">@yield('title')</h1>
                        @yield('header-action')
                    </div>
                    <main>
                        @yield('content')
                    </main>
                </div>


                @include('admin.theme.footer')
            </div>
        </div>
        @stack('modals')
        @stack('scripts')
        @livewireScripts
    </body>
</html>
