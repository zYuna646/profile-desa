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
    </head>
    <body class="font-sans text-madang-900 antialiased bg-madang-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-madang-50 to-madang-100">
            <div class="mb-4 animate-float">
                <a href="/">
                    <x-application-logo class="w-24 h-24 fill-current text-madang-600" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden sm:rounded-lg border border-madang-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
