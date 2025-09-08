<x-landing-layout>
    <div class="py-16 bg-gradient-to-b from-white to-jordy-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-jordy-blue-900 mb-4">Galeri Desa</h2>
                <p class="text-jordy-blue-700 max-w-2xl mx-auto">Keindahan dan keunikan desa kami terekam dalam gambar-gambar berikut.</p>
            </div>

            @forelse($galleries as $category => $items)
                <div class="mb-12">
                    <h3 class="text-2xl font-semibold text-jordy-blue-800 mb-6">{{ $category }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($items as $gallery)
                            <a href="{{ route('landing.galleries.show', $gallery) }}" class="group">
                                <div class="relative overflow-hidden rounded-lg shadow-lg aspect-[4/3]">
                                    <img src="{{ $gallery->image_url }}" 
                                         alt="{{ $gallery->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="absolute bottom-0 left-0 right-0 p-4">
                                            <h4 class="text-white font-semibold text-lg mb-1">{{ $gallery->title }}</h4>
                                            @if($gallery->images->count() > 1)
                                                <p class="text-jordy-blue-100 text-sm">{{ $gallery->images->count() }} foto</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">Belum ada galeri yang ditampilkan</p>
                </div>
            @endforelse
        </div>
    </div>
</x-landing-layout>