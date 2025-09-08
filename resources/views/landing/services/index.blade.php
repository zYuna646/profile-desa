<x-landing-layout>
<x-slot name="title">Layanan Desa</x-slot>
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Layanan</h2>
            <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Layanan Desa</p>
            <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Berbagai layanan administrasi yang dapat diakses secara online untuk memudahkan masyarakat.</p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($templates as $template)
                    <div class="bg-white overflow-hidden shadow rounded-lg transition-all duration-300 hover:shadow-xl">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900 truncate">{{ $template->name }}</h3>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 line-clamp-3">{{ $template->description }}</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('landing.services.show', $template->id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Ajukan Layanan &rarr;</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-landing-layout>