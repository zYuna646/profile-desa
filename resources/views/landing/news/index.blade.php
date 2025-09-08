<x-landing-layout>
    <div class="py-16 bg-gradient-to-b from-white to-jordy-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-jordy-blue-900 mb-4">Berita Desa</h2>
                <p class="text-jordy-blue-700 max-w-2xl mx-auto">Informasi dan kabar terbaru seputar kegiatan dan perkembangan desa.</p>
            </div>

            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('landing.news.index') }}" class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-jordy-blue-500 text-white' : 'bg-white text-jordy-blue-700 hover:bg-jordy-blue-50' }} transition-colors shadow-md hover:shadow-lg">
                        Semua
                    </a>
                    @foreach(\App\Models\NewsCategory::where('is_active', true)->orderBy('name')->get() as $category)
                        <a href="{{ route('landing.news.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-jordy-blue-500 text-white' : 'bg-white text-jordy-blue-700 hover:bg-jordy-blue-50' }} transition-colors shadow-md hover:shadow-lg">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news as $item)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-xl transition-shadow duration-300">
                        <div class="relative overflow-hidden">
                            <img 
                                src="{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/800x400?text=Berita+Desa' }}" 
                                alt="{{ $item->title }}" 
                                class="w-full h-48 object-cover transform transition-transform duration-500 group-hover:scale-110"
                            >
                            @if($item->category)
                            <div class="absolute top-0 right-0 bg-jordy-blue-500 text-white text-xs font-bold px-3 py-1 m-2 rounded">
                                {{ $item->category->name }}
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900 to-transparent opacity-0 group-hover:opacity-60 transition-opacity"></div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center text-sm text-jordy-blue-600 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $item->created_at->locale('id')->isoFormat('D MMMM Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $item->views }} kali dilihat</span>
                            </div>
                            <h3 class="font-bold text-lg text-jordy-blue-900 mb-2 group-hover:text-jordy-blue-600 transition-colors">
                                <a href="{{ route('landing.news.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-jordy-blue-700 mb-4 line-clamp-2">{!! Str::limit(strip_tags($item->content), 150) !!}</p>
                            <a href="{{ route('landing.news.show', $item->slug) }}" class="inline-flex items-center font-medium text-jordy-blue-600 hover:text-jordy-blue-700 transition-colors">
                                Baca Selengkapnya
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <div class="h-1 w-0 bg-gradient-to-r from-jordy-blue-300 to-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada berita yang dipublikasikan</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                <div class="flex justify-center">
                    {{ $news->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>