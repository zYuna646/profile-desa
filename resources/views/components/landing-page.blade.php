<x-app-layout>
    <div class="bg-jordy-blue-50 min-h-screen initial-animate animate">
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
                        <div class="text-3xl font-bold text-jordy-blue-600 mb-2 animate-pulse-slow">1,234</div>
                        <div class="text-jordy-blue-800">Penduduk</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-jordy-blue-600 mb-2 animate-pulse-slow animation-delay-500">42</div>
                        <div class="text-jordy-blue-800">UMKM</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-jordy-blue-600 mb-2 animate-pulse-slow animation-delay-1000">12</div>
                        <div class="text-jordy-blue-800">Wisata</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-jordy-blue-600 mb-2 animate-pulse-slow animation-delay-1500">85%</div>
                        <div class="text-jordy-blue-800">Kepuasan</div>
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
        <x-organization-structure class="reveal-right" :officials="$staff->map(function($member) {
            return [
                'name' => $member->name,
                'position' => $member->position,
                'photo' => $member->photo ? $member->photo : null
            ];
        })->toArray()" />

        {{-- Village Map --}}
        <x-village-map class="reveal" />

        {{-- Services Section --}}
        @if($services->count() > 0)
        <div id="services" class="py-16 bg-gradient-to-b from-white to-jordy-blue-50 reveal">
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
        <div id="potentials" class="py-16 bg-jordy-blue-50 reveal">
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
        <x-news-section class="reveal-left" :news="$news" />

        {{-- Gallery Section --}}
        @if($galleries->count() > 0)
        <div class="py-16 bg-jordy-blue-50 reveal">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 reveal">
                    <h2 class="section-title typing-animation">Galeri Desa</h2>
                    <p class="section-subtitle">Keindahan dan keunikan desa kami terekam dalam gambar-gambar berikut.</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 stagger" data-aos="zoom-in">
                    @foreach($galleries->take(1) as $category => $items)
                        @foreach($items->take(4) as $gallery)
                            <div class="relative overflow-hidden rounded-lg group hover-shadow card-3d">
                                <img src="{{ $gallery->image_url }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-jordy-blue-900 bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                                    <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-lg font-bold">{{ $category }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('landing.galleries.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-jordy-blue-500 text-white rounded-lg hover:bg-jordy-blue-600 transition-colors shadow-md hover:shadow-lg">
                        Lihat semua galeri
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- UMKM Section --}}
        @if($umkm->count() > 0)
        <x-umkm-section class="reveal" data-aos="fade-up" :umkm="$umkm" />
        @endif

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
                <a href="#" class="bg-transparent border-2 border-jordy-blue-400 hover:border-jordy-blue-300 text-jordy-blue-300 font-medium px-8 py-3 rounded-full transition hover:bg-jordy-blue-900/50 hover-glow animation-delay-500">
                    Pelajari Selengkapnya
                </a>
            </x-cta-section>
        </div>

        {{-- Footer --}}
        <footer class="bg-jordy-blue-900 text-white py-12" data-aos="fade-up">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-3 gap-8 mb-8 stagger">
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-jordy-blue-200">{{ $generalSettings['village_name']->value ?? config('app.name', 'Village Website') }}</h3>
                        <p class="text-jordy-blue-300">Desa kami berkomitmen untuk memberikan pelayanan terbaik dan mengembangkan potensi desa bersama masyarakat.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-jordy-blue-200">Kontak</h3>
                        <ul class="space-y-2 text-jordy-blue-300">
                            <li>{{ $mapSettings['address']->value ?? 'Jl. Desa No. 123' }}</li>
                            <li>{{ $generalSettings['email']->value ?? 'desa@example.com' }}</li>
                            <li>{{ $generalSettings['phone']->value ?? '+62 123 4567 890' }}</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-jordy-blue-200">Tautan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-jordy-blue-300 hover:text-jordy-blue-200">Beranda</a></li>
                            <li><a href="#" class="text-jordy-blue-300 hover:text-jordy-blue-200">Tentang Kami</a></li>
                            <li><a href="#" class="text-jordy-blue-300 hover:text-jordy-blue-200">Layanan</a></li>
                            <li><a href="#" class="text-jordy-blue-300 hover:text-jordy-blue-200">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-jordy-blue-800 pt-6 text-center text-jordy-blue-400 animate-fade-in animation-delay-1000">
                    <p>&copy; {{ date('Y') }} {{ $generalSettings['village_name']->value ?? config('app.name', 'Village Website') }}. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>