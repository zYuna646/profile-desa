<x-landing-layout>
    <div class="py-16 bg-gradient-to-b from-white to-jordy-blue-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <nav class="mb-8">
                    <a href="{{ route('landing.galleries.index') }}" class="text-jordy-blue-600 hover:text-jordy-blue-800 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Galeri
                    </a>
                </nav>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <h1 class="text-3xl font-bold text-jordy-blue-900 mb-2">{{ $gallery->title }}</h1>
                        <div class="flex items-center gap-4 text-jordy-blue-600 mb-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $gallery->category }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $gallery->images->count() }} foto
                            </span>
                        </div>
                        @if($gallery->description)
                            <p class="text-gray-600">{{ $gallery->description }}</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($gallery->images as $index => $image)
                        <div class="relative overflow-hidden rounded-lg shadow-lg aspect-[4/3] group cursor-pointer"
                             onclick="openModal({{ $index }})">
                            <img src="{{ $image->image_url }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @if($image->caption)
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <p class="text-white text-sm">{{ $image->caption }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Modal -->
                <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
                    <div class="relative max-w-7xl mx-auto px-4 w-full">
                        <button onclick="closeModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <button onclick="previousImage()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        
                        <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <div class="relative max-h-[80vh] flex items-center justify-center">
                            <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
                            <p id="modalCaption" class="absolute bottom-0 left-0 right-0 text-white text-center p-4 bg-black bg-opacity-50 hidden"></p>
                        </div>
                    </div>
                </div>

                <script>
                    const images = @json($gallery->images->map(function($img) {
                        return [
                            'url' => $img->image_url,
                            'caption' => $img->caption
                        ];
                    }));
                    let currentIndex = 0;
                    const modal = document.getElementById('imageModal');
                    const modalImage = document.getElementById('modalImage');
                    const modalCaption = document.getElementById('modalCaption');

                    function openModal(index) {
                        currentIndex = index;
                        updateModalImage();
                        modal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }

                    function closeModal() {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }

                    function updateModalImage() {
                        modalImage.src = images[currentIndex].url;
                        modalImage.alt = 'Gallery image ' + (currentIndex + 1);
                        
                        if (images[currentIndex].caption) {
                            modalCaption.textContent = images[currentIndex].caption;
                            modalCaption.classList.remove('hidden');
                        } else {
                            modalCaption.classList.add('hidden');
                        }
                    }

                    function previousImage() {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        updateModalImage();
                    }

                    function nextImage() {
                        currentIndex = (currentIndex + 1) % images.length;
                        updateModalImage();
                    }

                    // Keyboard navigation
                    document.addEventListener('keydown', function(e) {
                        if (modal.classList.contains('hidden')) return;
                        
                        if (e.key === 'Escape') closeModal();
                        if (e.key === 'ArrowLeft') previousImage();
                        if (e.key === 'ArrowRight') nextImage();
                    });
                </script>
            </div>
        </div>
    </div>
</x-landing-layout>