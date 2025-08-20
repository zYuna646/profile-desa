@props(['title', 'subtitle', 'image'])

<div class="relative bg-madang-900 py-16 overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 20 L20 0 L40 20 L20 40 Z" fill="none" stroke="currentColor" stroke-width="1" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cta-pattern)" />
        </svg>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block p-1 bg-gradient-to-r from-madang-300 to-madang-500 rounded-full mb-8">
                <div class="bg-madang-900 px-6 py-2 rounded-full">
                    <span class="text-madang-300 font-medium">{{ $subtitle }}</span>
                </div>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">{{ $title }}</h2>
            
            <div class="flex flex-wrap justify-center gap-4">
                {{ $slot }}
            </div>
        </div>
    </div>
    
    <!-- Decorative image -->
    <div class="absolute bottom-0 right-0 w-64 h-64 md:w-96 md:h-96 opacity-10">
        <img src="{{ $image }}" alt="Decorative" class="w-full h-full object-contain">
    </div>
</div>
