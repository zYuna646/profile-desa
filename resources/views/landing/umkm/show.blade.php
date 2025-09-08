<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <a href="{{ route('umkm.index') }}" class="inline-flex items-center text-jordy-blue-600 hover:text-jordy-blue-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke UMKM
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image Gallery -->
                        <div class="space-y-4">
                            <!-- Main Image -->
                            <div class="aspect-w-16 aspect-h-9 relative overflow-hidden rounded-lg">
                                <img 
                                    src="{{ $umkm->image ? Storage::url($umkm->image) : 'https://placehold.co/800x600?text=UMKM+Desa' }}" 
                                    alt="{{ $umkm->name }}" 
                                    class="w-full h-full object-cover cursor-pointer"
                                    onclick="openImageModal(this.src, '{{ $umkm->name }}')"
                                >
                            </div>

                            <!-- Additional Images -->
                            @if($umkm->images->count() > 0)
                                <div class="grid grid-cols-4 gap-4">
                                    @foreach($umkm->images as $image)
                                        <div class="aspect-w-1 aspect-h-1 relative overflow-hidden rounded-lg">
                                            <img 
                                                src="{{ Storage::url($image->image) }}" 
                                                alt="{{ $umkm->name }}" 
                                                class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition"
                                                onclick="openImageModal('{{ Storage::url($image->image) }}', '{{ $image->caption ?? $umkm->name }}')"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- UMKM Details -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $umkm->name }}</h1>
                                <p class="text-lg text-gray-600">{{ $umkm->owner }}</p>
                                <div class="mt-2 flex items-center">
                                    <span class="bg-jordy-blue-100 text-jordy-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $umkm->category->name }}</span>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Tentang UMKM</h2>
                                <p class="mt-2 text-gray-600 whitespace-pre-line">{{ $umkm->description }}</p>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Harga</h2>
                                <p class="mt-2 text-2xl font-bold text-jordy-blue-600">{{ $umkm->formatted_price }}</p>
                            </div>

                            @if($umkm->address)
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900">Lokasi</h2>
                                    <p class="mt-2 text-gray-600">{{ $umkm->address }}</p>
                                </div>
                            @endif

                            @if($umkm->phone)
                                <div class="pt-4">
                                    <a 
                                        href="tel:{{ $umkm->phone }}" 
                                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-jordy-blue-600 hover:bg-jordy-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-jordy-blue-500"
                                    >
                                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Hubungi Penjual
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <div class="relative inline-block max-w-4xl w-full">
                <div class="relative">
                    <!-- Close button -->
                    <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Navigation buttons -->
                    <button id="prevImage" class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-16 text-white hover:text-gray-300 hidden">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button id="nextImage" class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-16 text-white hover:text-gray-300 hidden">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Modal content -->
                    <img id="modalImage" src="" alt="" class="max-h-[80vh] mx-auto">
                    <p id="modalCaption" class="mt-4 text-white text-center"></p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentImageIndex = 0;
        const images = [
            { src: '{{ $umkm->image ? Storage::url($umkm->image) : "https://placehold.co/800x600?text=UMKM+Desa" }}', caption: '{{ $umkm->name }}' },
            @foreach($umkm->images as $image)
                { src: '{{ Storage::url($image->image) }}', caption: '{{ $image->caption ?? $umkm->name }}' },
            @endforeach
        ];

        function openImageModal(src, caption) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            const prevButton = document.getElementById('prevImage');
            const nextButton = document.getElementById('nextImage');

            currentImageIndex = images.findIndex(img => img.src === src);
            modalImage.src = src;
            modalCaption.textContent = caption;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Show/hide navigation buttons
            prevButton.classList.toggle('hidden', images.length <= 1 || currentImageIndex === 0);
            nextButton.classList.toggle('hidden', images.length <= 1 || currentImageIndex === images.length - 1);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showImage(index) {
            if (index >= 0 && index < images.length) {
                currentImageIndex = index;
                const modalImage = document.getElementById('modalImage');
                const modalCaption = document.getElementById('modalCaption');
                const prevButton = document.getElementById('prevImage');
                const nextButton = document.getElementById('nextImage');

                modalImage.src = images[index].src;
                modalCaption.textContent = images[index].caption;

                prevButton.classList.toggle('hidden', index === 0);
                nextButton.classList.toggle('hidden', index === images.length - 1);
            }
        }

        document.getElementById('prevImage').addEventListener('click', () => showImage(currentImageIndex - 1));
        document.getElementById('nextImage').addEventListener('click', () => showImage(currentImageIndex + 1));

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!document.getElementById('imageModal').classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') showImage(currentImageIndex - 1);
                if (e.key === 'ArrowRight') showImage(currentImageIndex + 1);
                if (e.key === 'Escape') closeImageModal();
            }
        });
    </script>
    @endpush
</x-app-layout>