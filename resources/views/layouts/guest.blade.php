<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <!-- Theme Manager Script -->
        <script>
            const savedTheme = localStorage.getItem('theme') || 'black';
            document.documentElement.setAttribute('data-theme', savedTheme);

            function setTheme(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-base-200 text-base-content">
        <div class="absolute top-4 right-4 z-10">
            <x-theme-switcher />
        </div>
        <div class="font-sans text-base-content antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
