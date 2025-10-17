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

        <!-- TallstackUI -->
        <tallstackui:script />

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased ">
        <x-banner />

        <div class="min-h-screen p-16 bg-gray-100 ">
            <div class="flex h-[780px] bg-white border border-gray-200 shadow-md rounded-2xl">
                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main   class="flex-1 h-full max-w-full bg-gray-100">

                    {{ $slot }}
                </main>
            </div>

            @stack('modals')

            @livewireScripts
            </div>
    </body>
</html>
