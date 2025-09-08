<x-landing-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('landing.infographics.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2">Infografis</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $infographicType->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Type Header -->
            <div class="text-center mb-12">
                <div class="flex items-center justify-center mb-4">
                    @if($infographicType->icon)
                        <i class="fas {{ $infographicType->icon }} text-primary-600 text-3xl mr-3"></i>
                    @endif
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $infographicType->name }}</h1>
                </div>
                @if($infographicType->description)
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $infographicType->description }}</p>
                @endif
            </div>

            <!-- Infographics Grid -->
            @if($infographics->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500">Belum ada infografis yang tersedia untuk kategori ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($infographics as $infographic)
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

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $infographics->links() }}
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-12">
                <a href="{{ route('landing.infographics.index') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Semua Infografis
                </a>
            </div>
        </div>
    </div>
</x-landing-layout>