<x-landing-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Infografis Desa</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Informasi statistik dan data penting tentang desa kami dalam bentuk visual yang mudah dipahami.</p>
        </div>

        @if($types->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada infografis yang tersedia.</p>
            </div>
        @else
            @foreach($types as $type)
                @if($type->infographics->isNotEmpty())
                    <div class="mb-16" id="{{ $type->slug }}">
                        <div class="flex items-center mb-6">
                            @if($type->icon)
                                <i class="fas {{ $type->icon }} text-primary-600 text-2xl mr-3"></i>
                            @endif
                            <h2 class="text-2xl font-bold text-gray-800">{{ $type->name }}</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($type->infographics as $infographic)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                                    <a href="{{ route('landing.infographics.show', $infographic->slug) }}">
                                        @if($infographic->image)
                                            <img src="{{ asset('storage/' . $infographic->image) }}" alt="{{ $infographic->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                @if($infographic->diagram_type == 'bar')
                                                    <i class="fas fa-chart-bar text-gray-400 text-4xl"></i>
                                                @elseif($infographic->diagram_type == 'pie')
                                                    <i class="fas fa-chart-pie text-gray-400 text-4xl"></i>
                                                @elseif($infographic->diagram_type == 'line')
                                                    <i class="fas fa-chart-line text-gray-400 text-4xl"></i>
                                                @elseif($infographic->diagram_type == 'table')
                                                    <i class="fas fa-table text-gray-400 text-4xl"></i>
                                                @else
                                                    <i class="fas fa-chart-pie text-gray-400 text-4xl"></i>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $infographic->title }}</h3>
                                            @if($infographic->description)
                                                <p class="text-gray-600 mb-4">{{ Str::limit($infographic->description, 100) }}</p>
                                            @endif
                                            <div class="flex justify-end">
                                                <span class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                                    Lihat Detail
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</x-landing-layout>