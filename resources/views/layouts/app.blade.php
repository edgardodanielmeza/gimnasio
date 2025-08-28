<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ session('theme') ?? 'light' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gimnasio Manager') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Bebas+Neue&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Scripts y estilos -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            // and apply the theme from localStorage so it's instantly available
            const theme = localStorage.getItem('theme') || '{{ session('theme') ?? 'light' }}';
            document.documentElement.setAttribute('data-theme', theme);

            function setTheme(theme) {
                // Apply theme immediately
                document.documentElement.setAttribute('data-theme', theme);

                // Save to localStorage
                localStorage.setItem('theme', theme);

                // Send to server to save in session
                fetch('{{ route("theme.set") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ theme: theme })
                })
                .catch(error => {
                    console.error('Error saving theme:', error);
                });
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-base-200 text-base-content">
        <x-banner />
        <div class="min-h-screen">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-base-100 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
    </body>
</html>
