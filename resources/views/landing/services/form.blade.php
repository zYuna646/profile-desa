<x-landing-layout>
<x-slot name="title">{{ $template->name }}</x-slot>
<div class="bg-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Layanan</h2>
            <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">{{ $template->name }}</p>
            <p class="max-w-xl mt-5 mx-auto text-lg text-gray-500">{{ $template->description }}</p>
        </div>

        <div class="mt-12 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                @if (session('error'))
                    <div class="rounded-md bg-red-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('landing.services.generate', $template->id) }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        @if (!empty($variables))
                            @foreach ($variables as $variable)
                                <div>
                                    <label for="var_{{ $variable['mark'] }}" class="block text-sm font-medium text-gray-700">{{ $variable['description'] ?? $variable['mark'] }}</label>
                                    <div class="mt-1">
                                        <input type="text" name="var_{{ $variable['mark'] }}" id="var_{{ $variable['mark'] }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('var_' . $variable['mark']) }}">
                                    </div>
                                    @error('var_' . $variable['mark'])
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        @else
                            <div class="rounded-md bg-yellow-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Tidak ada variabel yang tersedia untuk template ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('landing.services.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kembali</a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Generate Dokumen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-landing-layout>