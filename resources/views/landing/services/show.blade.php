<x-landing-layout>
<x-slot name="title">{{ $template->name }}</x-slot>
<div class="bg-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Layanan</h2>
            <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">{{ $template->name }}</p>
        </div>

        <div class="mt-12 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="prose max-w-none">
                    <p class="text-lg text-gray-500">{{ $template->description }}</p>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('landing.services.form', $template->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Isi Formulir Layanan
                    </a>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <a href="{{ route('landing.services.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-landing-layout>