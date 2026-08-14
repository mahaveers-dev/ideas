@props([
    'title' => config('app.name', 'Laravel')
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        {{-- 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        --}}

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-background text-foreground">
        <x-layout.nav />
        <!-- Page Content -->
        <main class="max-w-7xl mx-auto px-6">
            {{ $slot }}
        </main>
        
        <footer class="px-6 py-6 mt-10 border-t border-border text-sm text-muted-foreground text-center">
            © {{ date('Y') }} Your Company, Inc. All rights reserved.
        </footer>
        @session('success')
            <div 
                x-data="{show: true}"
                x-init="setTimeout(()=> show = false, 3000)"
                x-show="show"
                x-transition.opacity.duration.600ms
                class="bg-primary px-6 py-3 absolute bottom-4 right-4 rounded-lg">
                {{ $value }}
            </div>
        @endsession
    </body>
</html>