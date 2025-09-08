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
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-jordy-blue-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-jordy-blue-50 via-white to-jordy-blue-100 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-jordy-blue-100 to-transparent opacity-40"></div>
                <svg class="absolute left-0 top-0 opacity-10" width="400" height="400" viewBox="0 0 400 400" fill="none">
                    <circle cx="200" cy="200" r="200" fill="currentColor" class="text-jordy-blue-500"/>
                </svg>
                <svg class="absolute right-0 bottom-0 opacity-10" width="400" height="400" viewBox="0 0 400 400" fill="none">
                    <circle cx="200" cy="200" r="200" fill="currentColor" class="text-jordy-blue-500"/>
                </svg>
            </div>

            <div class="relative z-10 mb-4 animate-float">
                <a href="/" class="block transform hover:scale-105 transition-transform duration-300">
                    <x-application-logo class="w-24 h-24 fill-current text-jordy-blue-600" />
                </a>
            </div>

            <div class="relative z-10">
                {{ $slot }}
            </div>

            <!-- Wave separator -->
            <div class="absolute bottom-0 left-0 w-full overflow-hidden">
                <svg class="relative block w-full h-12 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#e8f0fe" opacity=".25"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="#e8f0fe" opacity=".5"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#e8f0fe"></path>
                </svg>
            </div>
        </div>
    </body>
</html>
