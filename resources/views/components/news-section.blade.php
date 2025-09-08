@props(['news'])

<div class="py-16 bg-gradient-to-b from-white to-jordy-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-jordy-blue-900 mb-4">Berita Terkini</h2>
            <p class="text-jordy-blue-700 max-w-2xl mx-auto">Informasi dan kabar terbaru seputar kegiatan dan perkembangan desa.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-xl transition-shadow duration-300">
                    <div class="relative overflow-hidden">
                        <img 
                            src="{{ $item['image'] }}" 
                            alt="{{ $item['title'] }}" 
                            class="w-full h-48 object-cover transform transition-transform duration-500 group-hover:scale-110"
                            onerror="this.onerror=null; this.src='https://placehold.co/800x400?text=Berita+Desa'"
                        >
                        <div class="absolute top-0 right-0 bg-jordy-blue-500 text-white text-xs font-bold px-3 py-1 m-2 rounded">
                            {{ $item['category'] }}
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900 to-transparent opacity-0 group-hover:opacity-60 transition-opacity"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-jordy-blue-600 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $item['date'] }}</span>
                        </div>
                        <h3 class="font-bold text-lg text-jordy-blue-900 mb-2 group-hover:text-jordy-blue-600 transition-colors">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-jordy-blue-700 mb-4 line-clamp-2">{{ $item['excerpt'] }}</p>
                        <a href="{{ $item['url'] }}" class="inline-flex items-center font-medium text-jordy-blue-600 hover:text-jordy-blue-700 transition-colors">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="h-1 w-0 bg-gradient-to-r from-jordy-blue-300 to-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="/berita" class="inline-flex items-center px-6 py-3 bg-jordy-blue-500 text-white rounded-lg hover:bg-jordy-blue-600 transition shadow-md hover:shadow-lg">
                <span>Lihat Semua Berita</span>
                <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
