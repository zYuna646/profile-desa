@props(['title', 'subtitle', 'image'])

<section class="hero-section relative overflow-hidden">
    <!-- Background image with multiple layers -->
    <div class="absolute inset-0 z-0">
        <img 
            src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
            alt="Village Landscape" 
            class="w-full h-full object-cover opacity-30 initial-animate"
        >
        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-madang-900/80 to-madang-800/60"></div>
    </div>
    
    <!-- Animated background pattern -->
    <div class="absolute inset-0 opacity-10 z-10 animate-blob">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <defs>
                <pattern id="pattern" width="100" height="100" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="currentColor" class="text-madang-500" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#pattern)" />
        </svg>
    </div>

    <div class="container mx-auto px-4 py-24 md:py-32 relative z-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-8 initial-animate delay-200">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight typing-text">
                    {{ $title }}
                </h1>
                <p class="text-xl text-madang-100 max-w-lg initial-animate delay-500">
                    {{ $subtitle }}
                </p>
                <div class="flex flex-wrap gap-4 initial-animate delay-700">
                    {{ $slot }}
                </div>
            </div>
            <div class="relative group initial-animate delay-1000">
                <div class="absolute -inset-1 bg-gradient-to-r from-madang-400 to-madang-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                <div class="relative overflow-hidden rounded-lg shadow-xl">
                    <img 
                        src="{{ $image }}" 
                        alt="Hero Image" 
                        class="w-full h-auto object-cover transform transition-transform duration-500 group-hover:scale-105"
                        onerror="this.onerror=null; this.src='https://placehold.co/1200x800?text=Desa+Kami'"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-madang-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden z-10">
        <svg class="relative block w-full h-12 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#eefff0" opacity=".25"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="#eefff0" opacity=".5"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#eefff0"></path>
        </svg>
    </div>
</section>