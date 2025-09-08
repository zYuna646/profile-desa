<x-landing-layout>
    <div class="py-16">
        <div class="container mx-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="mb-12 space-y-2 text-center">
                <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Struktur Organisasi</h2>
                <p class="lg:mx-auto lg:w-6/12 text-gray-600 dark:text-gray-300">
                    Berikut adalah struktur organisasi dan staff yang bertugas di Desa Ilomata
                </p>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($staff as $member)
                <div class="group space-y-4 text-center">
                    <div class="mx-auto h-56 w-56 rotate-45 overflow-hidden rounded-[4rem] lg:h-64 lg:w-64">
                        <img 
                            class="mx-auto h-full w-full -rotate-45 scale-125 object-cover transition duration-300 group-hover:scale-[1.4]"
                            src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('img/no-image.png') }}"
                            alt="{{ $member->name }} photo"
                            loading="lazy"
                            width="640"
                            height="805"
                        >
                    </div>
                    <div class="pt-4">
                        <h4 class="text-2xl font-semibold text-gray-700 dark:text-white">{{ $member->name }}</h4>
                        <span class="block text-sm text-gray-500">{{ $member->position }}</span>
                    </div>
                    <div class="flex justify-center space-x-4 text-gray-500">
                        <a href="tel:{{ $member->phone_number }}" class="flex items-center mr-3">
                            <span class="sr-only">Call</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </a>
                        <a href="{{ route('staff.show', $member) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 transition-colors duration-200">
                            Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-landing-layout>