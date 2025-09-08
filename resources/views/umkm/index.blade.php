<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ $category ? $category->name : 'UMKM Desa' }}
                </h1>
                <p class="mt-4 text-lg text-gray-500">
                    {{ $category ? $category->description : 'Temukan berbagai produk dan layanan dari UMKM di desa kami.' }}
                </p>
            </div>

            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('umkm.index') }}" class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-jordy-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('umkm.index', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-full {{ request('category') == $cat->slug ? 'bg-jordy-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($umkm as $item)
                    <div class="umkm-card w-full bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="relative h-48">
                            <img 
                                src="{{ $item->image ? Storage::url($item->image) : 'https://placehold.co/800x600?text=UMKM+Desa' }}" 
                                alt="{{ $item->name }}" 
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900 to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <span class="bg-jordy-blue-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $item->category->name }}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-jordy-blue-900">{{ $item->name }}</h3>
                            <p class="text-sm text-jordy-blue-700 mb-3">{{ $item->owner }}</p>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $item->rating)
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
                                <span class="text-xs text-jordy-blue-700 ml-2">({{ $item->reviews }} ulasan)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-jordy-blue-600">{{ $item->formatted_price }}</span>
                                <a href="{{ route('umkm.show', $item) }}" class="bg-jordy-blue-100 hover:bg-jordy-blue-200 text-jordy-blue-700 text-sm px-3 py-1 rounded-full transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada UMKM</h3>
                        <p class="mt-1 text-sm text-gray-500">Belum ada UMKM yang terdaftar dalam kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $umkm->links() }}
            </div>
        </div>
    </div>
</x-app-layout>