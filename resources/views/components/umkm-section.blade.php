@props(['umkm'])

<div class="py-16 bg-jordy-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-jordy-blue-900 mb-4">UMKM Desa</h2>
            <p class="text-jordy-blue-700 max-w-2xl mx-auto">Dukung ekonomi lokal dengan produk dan jasa dari para pelaku UMKM desa kami.</p>
        </div>
        
        <!-- UMKM Slider -->
        <div class="umkm-slider relative">
            <div class="overflow-hidden">
                <div class="umkm-track flex space-x-6 py-4 animate-scroll">
                    @foreach($umkm as $item)
                        <div class="umkm-card flex-none w-64 md:w-72 bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                            <div class="relative h-48">
                                <img 
                                    src="{{ $item['image'] }}" 
                                    alt="{{ $item['name'] }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='https://placehold.co/800x600?text=UMKM+Desa'"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900 to-transparent opacity-60"></div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <span class="bg-jordy-blue-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $item['category'] }}</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-jordy-blue-900">{{ $item['name'] }}</h3>
                                <p class="text-sm text-jordy-blue-700 mb-3">{{ $item['owner'] }}</p>
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < $item['rating'])
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-jordy-blue-700 ml-2">({{ $item['reviews'] }} ulasan)</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-jordy-blue-600">{{ $item['price'] }}</span>
                                    <a href="{{ $item['url'] ?? "" }}" class="bg-jordy-blue-100 hover:bg-jordy-blue-200 text-jordy-blue-700 text-sm px-3 py-1 rounded-full transition">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Duplicate items for continuous scroll effect -->
                    @foreach($umkm as $item)
                        <div class="umkm-card flex-none w-64 md:w-72 bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                            <div class="relative h-48">
                                <img 
                                    src="{{ $item['image'] }}" 
                                    alt="{{ $item['name'] }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='https://placehold.co/800x600?text=UMKM+Desa'"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900 to-transparent opacity-60"></div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <span class="bg-jordy-blue-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $item['category'] }}</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-jordy-blue-900">{{ $item['name'] }}</h3>
                                <p class="text-sm text-jordy-blue-700 mb-3">{{ $item['owner'] }}</p>
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < $item['rating'])
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-jordy-blue-700 ml-2">({{ $item['reviews'] }} ulasan)</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-jordy-blue-600">{{ $item['price'] }}</span>
                                    <a href="{{ $item['url'] ?? "" }}" class="bg-jordy-blue-100 hover:bg-jordy-blue-200 text-jordy-blue-700 text-sm px-3 py-1 rounded-full transition">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Control buttons -->
            <button class="absolute top-1/2 -left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg text-jordy-blue-700 hover:text-jordy-blue-500 focus:outline-none z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="absolute top-1/2 -right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg text-jordy-blue-700 hover:text-jordy-blue-500 focus:outline-none z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('umkm.index') }}" class="inline-flex items-center px-6 py-3 bg-jordy-blue-500 text-white rounded-lg hover:bg-jordy-blue-600 transition shadow-md hover:shadow-lg">
                <span>Jelajahi UMKM Desa</span>
                <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
