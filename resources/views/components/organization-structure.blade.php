@props(['officials'])

<div class="py-16 bg-madang-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-madang-900 mb-4">Struktur Organisasi</h2>
            <p class="text-madang-700 max-w-2xl mx-auto">Kenali jajaran perangkat desa yang melayani masyarakat dengan penuh dedikasi.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($officials as $official)
                <div class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 group-hover:-translate-y-2 group-hover:shadow-xl">
                        <div class="relative">
                            <img 
                                src="{{ $official['image'] }}" 
                                alt="{{ $official['name'] }}" 
                                class="w-full h-48 object-cover object-center"
                                onerror="this.onerror=null; this.src='https://placehold.co/400x600?text=Perangkat+Desa'"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-madang-900 to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-madang-900 group-hover:text-madang-600 transition-colors">{{ $official['name'] }}</h3>
                            <p class="text-sm text-madang-700">{{ $official['position'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="#" class="inline-flex items-center px-6 py-3 border border-madang-500 text-madang-700 bg-white rounded-lg hover:bg-madang-100 transition">
                <span>Lihat Selengkapnya</span>
                <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
