<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative">
                    <img src="{{ $umkm->image ? Storage::url($umkm->image) : 'https://images.unsplash.com/photo-1582582621959-48d27397dc69?auto=format&fit=crop&q=80' }}" 
                        alt="{{ $umkm->name }}" 
                        class="w-full h-[300px] sm:h-[400px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold">{{ $umkm->name }}</h1>
                                <p class="mt-2 text-lg">Oleh {{ $umkm->owner }}</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center space-x-1 text-amber-400 justify-end">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xl font-semibold">{{ number_format($umkm->rating, 1) }}</span>
                                </div>
                                <p class="text-sm">{{ $umkm->reviews }} ulasan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Tentang UMKM</h2>
                                <p class="mt-4 text-gray-600 whitespace-pre-line">{{ $umkm->description }}</p>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Lokasi</h2>
                                <p class="mt-4 text-gray-600">{{ $umkm->address }}</p>
                            </div>

                            @if($umkm->images->isNotEmpty())
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Galeri Foto</h2>
                                <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
                                    @foreach($umkm->images as $image)
                                    <a href="{{ Storage::url($image->image) }}" class="block aspect-w-1 aspect-h-1 rounded-lg overflow-hidden" data-fslightbox="gallery">
                                        <img src="{{ Storage::url($image->image) }}" alt="{{ $umkm->name }}" class="w-full h-full object-cover hover:opacity-75 transition">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="lg:border-l lg:border-gray-200 lg:pl-8">
                            <div class="sticky top-8 space-y-6">
                                <div>
                                    <span class="text-sm text-gray-500">Mulai dari</span>
                                    <p class="text-3xl font-bold text-gray-900">{{ $umkm->formatted_price }}</p>
                                    <span class="text-sm text-gray-500">per produk</span>
                                </div>

                                <div class="border-t border-gray-200 pt-6">
                                    <h3 class="text-lg font-semibold text-gray-900">Kategori</h3>
                                    <div class="mt-2">
                                        <a href="{{ route('umkm.index', ['category' => $umkm->category->slug]) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-jordy-blue-100 text-jordy-blue-800">
                                            {{ $umkm->category->name }}
                                        </a>
                                    </div>
                                </div>

                                @if($umkm->phone)
                                    <div class="border-t border-gray-200 pt-6">
                                        <h3 class="text-lg font-semibold text-gray-900">Kontak</h3>
                                        <div class="mt-4">
                                            <a href="tel:{{ $umkm->phone }}" class="inline-flex items-center justify-center w-full px-4 py-2 text-base font-medium text-white bg-jordy-blue-600 border border-transparent rounded-md shadow-sm hover:bg-jordy-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-jordy-blue-500">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                Hubungi Penjual
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>