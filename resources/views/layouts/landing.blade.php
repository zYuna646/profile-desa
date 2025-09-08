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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-jordy-blue-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
                        <p class="text-jordy-blue-100">Website resmi Desa [Nama Desa]. Temukan informasi terkini tentang program, layanan, dan kegiatan desa kami.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Link Penting</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-jordy-blue-100 hover:text-white transition">Profil Desa</a></li>
                            <li><a href="#" class="text-jordy-blue-100 hover:text-white transition">Layanan</a></li>
                            <li><a href="#" class="text-jordy-blue-100 hover:text-white transition">Berita</a></li>
                            <li><a href="#" class="text-jordy-blue-100 hover:text-white transition">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Kontak</h3>
                        <ul class="space-y-2 text-jordy-blue-100">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>[Alamat Desa]</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>[Nomor Telepon]</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <span>[Email]</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-jordy-blue-800 text-center text-jordy-blue-100">
                    <p>&copy; {{ date('Y') }} Desa [Nama Desa]. All rights reserved.</p>
                </div>
            </div>
        </footer>

        @stack('scripts')
    </div>
</body>
</html>