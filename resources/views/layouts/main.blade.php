<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ Vite::asset('resources/images/cms.png') }}" type="image/png">

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main  style="min-height: calc(100vh - 120px)">
                <div class="container">
                    @yield('content')
                </div>
            </main>
            @include('partials.footer')
        </div>

        @stack('modals')
        @stack('scripts')
        @livewireScripts
    </body>
</html>
