<x-landing-layout>
    <div class="py-16">
        <div class="container mx-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="mb-12 space-y-2 text-center">
                <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">Detail Staff</h2>
            </div>
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <img class="h-96 w-full object-cover md:w-96" 
                                src="{{ $staff->photo ? asset('storage/' . $staff->photo) : asset('img/no-image.png') }}" 
                                alt="{{ $staff->name }}">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                                {{ $staff->position }}
                            </div>
                            <h2 class="block mt-1 text-3xl leading-tight font-bold text-black">
                                {{ $staff->name }}
                            </h2>
                            <div class="mt-4">
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-gray-700">Jenis Kelamin: {{ $staff->gender }}</span>
                                </div>
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <a href="tel:{{ $staff->phone_number }}" class="text-blue-500 hover:text-blue-700">
                                        {{ $staff->phone_number }}
                                    </a>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">Status: {{ $staff->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('organization') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>