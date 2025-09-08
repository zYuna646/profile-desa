<x-landing-layout>
    <article class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <header class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
                        <div class="flex items-center gap-2">
                            <time datetime="{{ $news->created_at->toIso8601String() }}">
                                {{ $news->created_at->locale('id')->isoFormat('D MMMM Y') }}
                            </time>
                            @if($news->category)
                                <span>•</span>
                                <a href="{{ route('landing.news.index', ['category' => $news->category->slug]) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    {{ $news->category->name }}
                                </a>
                            @endif
                        </div>
                        <span>{{ $news->views }} kali dilihat</span>
                    </div>

                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" 
                             alt="{{ $news->title }}" 
                             class="w-full h-[400px] object-cover rounded-lg shadow-lg">
                    @endif
                </header>

                <div class="prose prose-lg max-w-none">
                    {!! $news->content !!}
                </div>

                <footer class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('landing.news.index') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar Berita
                        </a>

                        <div class="flex space-x-4">
                            <button type="button" 
                                    class="inline-flex items-center text-gray-500 hover:text-gray-600 transition-colors"
                                    onclick="share('facebook')">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                </svg>
                            </button>

                            <button type="button" 
                                    class="inline-flex items-center text-gray-500 hover:text-gray-600 transition-colors"
                                    onclick="share('twitter')">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.58v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                                </svg>
                            </button>

                            <button type="button" 
                                    class="inline-flex items-center text-gray-500 hover:text-gray-600 transition-colors"
                                    onclick="share('whatsapp')">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </article>

    @push('scripts')
    <script>
        function share(platform) {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            
            const shareUrls = {
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
                twitter: `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
                whatsapp: `https://api.whatsapp.com/send?text=${title}%20${url}`
            };

            window.open(shareUrls[platform], '_blank', 'width=600,height=400');
        }
    </script>
    @endpush
</x-landing-layout>