@props(['name', 'image', 'message'])

<div class="relative bg-white overflow-hidden">
    <!-- Decorative elements -->
    <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:h-full lg:w-full">
        <div class="relative h-full text-madang-200">
            <svg class="absolute right-full transform translate-y-1/4 translate-x-1/4 lg:translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
                <defs>
                    <pattern id="pattern-squares" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="784" fill="url(#pattern-squares)" />
            </svg>
            <svg class="absolute left-full transform -translate-y-3/4 -translate-x-1/4 md:-translate-y-1/2 lg:-translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
                <defs>
                    <pattern id="pattern-squares-2" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="784" fill="url(#pattern-squares-2)" />
            </svg>
        </div>
    </div>

    <div class="relative py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="lg:col-span-5 text-center lg:text-left">
                    <h2 class="text-3xl font-extrabold text-madang-900 sm:text-4xl">
                        Sambutan Kepala Desa
                    </h2>
                    <div class="mt-3 max-w-3xl mx-auto lg:mx-0">
                        <p class="text-xl text-madang-700 mb-6">
                            {{ $message }}
                        </p>
                        <div class="mt-8">
                            <div class="inline-flex items-center">
                                <span class="h-px w-8 bg-madang-500 mr-4"></span>
                                <span class="font-bold text-madang-900">{{ $name }}</span>
                                <span class="h-px w-8 bg-madang-500 ml-4"></span>
                            </div>
                            <p class="text-madang-600 mt-1">Kepala Desa</p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 lg:mt-0 lg:col-span-7">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg overflow-hidden lg:max-w-md">
                        <div class="absolute inset-0 bg-gradient-to-r from-madang-400 to-madang-600 mix-blend-multiply opacity-25"></div>
                        <div class="relative">
                            <img 
                                class="w-full object-cover h-80 lg:h-96" 
                                src="{{ $image }}" 
                                alt="Kepala Desa"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x800?text=Kepala+Desa'"
                            >
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-madang-900 to-transparent">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-white">
                                        {{ $name }}
                                    </p>
                                    <p class="text-xs text-madang-200">
                                        Kepala Desa
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
