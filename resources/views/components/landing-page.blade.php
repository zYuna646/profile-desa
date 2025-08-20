<x-app-layout>
    <div class="bg-madang-50 min-h-screen initial-animate animate">
        {{-- Hero Section --}}
        <x-hero 
            title="{{ $generalSettings['village_name']->value ?? config('app.name', 'Village Website') }}"
            subtitle="{{ $generalSettings['welcome_message']->value ?? 'Selamat datang di website resmi desa kami. Temukan informasi terkini, layanan, dan potensi desa yang kami miliki.' }}"
            image="https://images.unsplash.com/photo-1588880331179-bc9b93a8cb5e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="hero-section hero-loaded animate-fade-in"
        >
            <a href="#features" class="btn btn-primary animate-float animation-delay-500">
                Jelajahi Desa
            </a>
            <a href="#contact" class="btn btn-outline hover-scale animation-delay-1000">
                Hubungi Kami
            </a>
        </x-hero>

        {{-- Stats Section --}}
        <div class="bg-white py-12 reveal-left">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center stagger" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="text-3xl font-bold text-madang-600 mb-2 animate-pulse-slow">1,234</div>
                        <div class="text-madang-800">Penduduk</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-madang-600 mb-2 animate-pulse-slow animation-delay-500">42</div>
                        <div class="text-madang-800">UMKM</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-madang-600 mb-2 animate-pulse-slow animation-delay-1000">12</div>
                        <div class="text-madang-800">Wisata</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-madang-600 mb-2 animate-pulse-slow animation-delay-1500">85%</div>
                        <div class="text-madang-800">Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Welcome Message Section --}}
        <x-welcome-message
            name="{{ $generalSettings['village_chief_name']->value ?? 'Budi Santoso' }}"
            image="{{ $generalSettings['village_chief_photo']->value ? asset('storage/' . $generalSettings['village_chief_photo']->value) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
            message="{{ $generalSettings['village_chief_greeting']->value ?? 'Selamat datang di website resmi desa kami. Sebagai Kepala Desa, saya mengucapkan terima kasih atas kunjungan Anda. Website ini merupakan sarana komunikasi dan transparansi informasi untuk seluruh masyarakat. Kami berkomitmen untuk terus meningkatkan pelayanan dan membangun desa yang maju, sejahtera, dan berkelanjutan. Mari bersama-sama membangun desa dengan semangat gotong royong dan kebersamaan.' }}"
            class="reveal"
        />

        {{-- Organization Structure --}}
        <x-organization-structure class="reveal-right" :officials="[
            [
                'name' => 'Budi Santoso',
                'position' => 'Kepala Desa',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'name' => 'Siti Aminah',
                'position' => 'Sekretaris Desa',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'name' => 'Ahmad Rizki',
                'position' => 'Bendahara Desa',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'name' => 'Dewi Lestari',
                'position' => 'Kaur Perencanaan',
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1961&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'name' => 'Hendra Wijaya',
                'position' => 'Kaur Pembangunan',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ]
        ]" />

        {{-- Village Map --}}
        <x-village-map class="reveal" />

        {{-- Services Section --}}
        @if($services->count() > 0)
        <div id="services" class="py-16 bg-gradient-to-b from-white to-madang-50 reveal">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 reveal">
                    <h2 class="section-title typing-animation">Layanan Desa</h2>
                    <p class="section-subtitle">Kami menyediakan berbagai layanan untuk masyarakat desa.</p>
                </div>
                
                <x-slider-section :items="$services" title="Layanan Desa" type="services" />
            </div>
        </div>
        @endif

        {{-- Potentials Section --}}
        @if($potentials->count() > 0)
        <div id="potentials" class="py-16 bg-madang-50 reveal">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 reveal">
                    <h2 class="section-title typing-animation">Potensi Desa</h2>
                    <p class="section-subtitle">Temukan berbagai potensi dan keunggulan desa kami yang siap untuk dikembangkan.</p>
                </div>
                
                <x-slider-section :items="$potentials" title="Potensi Desa" type="potentials" />
            </div>
        </div>
        @endif

        {{-- News Section --}}
        <x-news-section class="reveal-left" :news="[
            [
                'title' => 'Pembangunan Jalan Desa Tahap II Dimulai',
                'excerpt' => 'Proyek pembangunan jalan desa tahap kedua telah dimulai dan diperkirakan selesai dalam 3 bulan ke depan.',
                'image' => 'https://images.unsplash.com/photo-1506843086196-1b2f27d04881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'date' => '12 Juni 2023',
                'category' => 'Pembangunan',
                'url' => '#'
            ],
            [
                'title' => 'Festival Budaya Desa Menarik Ribuan Pengunjung',
                'excerpt' => 'Festival budaya tahunan desa berhasil menarik ribuan pengunjung dan meningkatkan ekonomi lokal.',
                'image' => 'https://images.unsplash.com/photo-1601850494422-3cf14624b0b3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'date' => '5 Mei 2023',
                'category' => 'Budaya',
                'url' => '#'
            ],
            [
                'title' => 'Program Vaksinasi Desa Mencapai Target 90%',
                'excerpt' => 'Program vaksinasi COVID-19 di desa telah mencapai target 90% dari total penduduk yang memenuhi syarat.',
                'image' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'date' => '20 April 2023',
                'category' => 'Kesehatan',
                'url' => '#'
            ]
        ]" />

        {{-- Gallery Section --}}
        <div class="py-16 bg-madang-50 reveal">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 reveal">
                    <h2 class="section-title typing-animation">Galeri Desa</h2>
                    <p class="section-subtitle">Keindahan dan keunikan desa kami terekam dalam gambar-gambar berikut.</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 stagger" data-aos="zoom-in">
                    <div class="relative overflow-hidden rounded-lg group hover-shadow card-3d">
                        <img src="https://images.unsplash.com/photo-1596392301391-76e3871b68c7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Galeri Desa" 
                             class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-madang-900 bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg font-bold">Pertanian</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-lg group hover-shadow card-3d">
                        <img src="https://images.unsplash.com/photo-1583422409516-2895a77efded?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Galeri Desa" 
                             class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-madang-900 bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg font-bold">Kerajinan</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-lg group hover-shadow card-3d">
                        <img src="https://images.unsplash.com/photo-1513862448120-a41616062133?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Galeri Desa" 
                             class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-madang-900 bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg font-bold">Budaya</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-lg group hover-shadow card-3d">
                        <img src="https://images.unsplash.com/photo-1594708053019-5c77bf30a055?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Galeri Desa" 
                             class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-madang-900 bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg font-bold">Wisata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- UMKM Section --}}
        <x-umkm-section class="reveal" data-aos="fade-up" :umkm="[
            [
                'name' => 'Kerajinan Bambu Sejahtera',
                'owner' => 'Pak Hadi',
                'image' => 'https://images.unsplash.com/photo-1601833524915-f59c8b96868a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Kerajinan',
                'rating' => 4,
                'reviews' => 28,
                'price' => 'Rp50.000 - Rp250.000'
            ],
            [
                'name' => 'Batik Tulis Makmur',
                'owner' => 'Bu Siti',
                'image' => 'https://images.unsplash.com/photo-1528396518501-b53b655eb9b3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Fashion',
                'rating' => 5,
                'reviews' => 42,
                'price' => 'Rp150.000 - Rp500.000'
            ],
            [
                'name' => 'Kuliner Desa Lezat',
                'owner' => 'Bu Ani',
                'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Kuliner',
                'rating' => 4,
                'reviews' => 56,
                'price' => 'Rp10.000 - Rp50.000'
            ],
            [
                'name' => 'Madu Murni Asli',
                'owner' => 'Pak Budi',
                'image' => 'https://images.unsplash.com/photo-1587049352851-8d4e89133924?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Makanan',
                'rating' => 5,
                'reviews' => 37,
                'price' => 'Rp85.000 - Rp120.000'
            ]
        ]" />

        {{-- CTA Section --}}
        <div id="contact">
            <x-cta-section
                title="Jadilah Bagian dari Kemajuan Desa"
                subtitle="Mari Bergabung"
                image="https://images.unsplash.com/photo-1596392301391-76e3871b68c7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="reveal-right"
                data-aos="fade-left"
            >
                <a href="#" class="btn btn-primary animate-bounce-slow">
                    Hubungi Kami
                </a>
                <a href="#" class="bg-transparent border-2 border-madang-400 hover:border-madang-300 text-madang-300 font-medium px-8 py-3 rounded-full transition hover:bg-madang-900/50 hover-glow animation-delay-500">
                    Pelajari Selengkapnya
                </a>
            </x-cta-section>
        </div>

        {{-- Footer --}}
        <footer class="bg-madang-900 text-white py-12" data-aos="fade-up">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-3 gap-8 mb-8 stagger">
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-madang-200">{{ $generalSettings['village_name']->value ?? config('app.name', 'Village Website') }}</h3>
                        <p class="text-madang-300">Desa kami berkomitmen untuk memberikan pelayanan terbaik dan mengembangkan potensi desa bersama masyarakat.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-madang-200">Kontak</h3>
                        <ul class="space-y-2 text-madang-300">
                            <li>{{ $mapSettings['address']->value ?? 'Jl. Desa No. 123' }}</li>
                            <li>{{ $generalSettings['email']->value ?? 'desa@example.com' }}</li>
                            <li>{{ $generalSettings['phone']->value ?? '+62 123 4567 890' }}</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-madang-200">Tautan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-madang-300 hover:text-madang-200">Beranda</a></li>
                            <li><a href="#" class="text-madang-300 hover:text-madang-200">Tentang Kami</a></li>
                            <li><a href="#" class="text-madang-300 hover:text-madang-200">Layanan</a></li>
                            <li><a href="#" class="text-madang-300 hover:text-madang-200">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-madang-800 pt-6 text-center text-madang-400 animate-fade-in animation-delay-1000">
                    <p>&copy; {{ date('Y') }} {{ $generalSettings['village_name']->value ?? config('app.name', 'Village Website') }}. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>