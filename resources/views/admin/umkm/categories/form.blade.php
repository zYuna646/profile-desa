<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($category) ? 'Edit Kategori UMKM' : 'Tambah Kategori UMKM' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ isset($category) ? route('admin.umkm.categories.update', $category) : route('admin.umkm.categories.store') }}" method="POST">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-admin.input-label for="name" value="Nama Kategori" />
                                <x-admin.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name ?? '')" required autofocus />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-admin.input-label for="description" value="Deskripsi" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-jordy-blue-500 focus:ring-jordy-blue-500 rounded-md shadow-sm">{{ old('description', $category->description ?? '') }}</textarea>
                                <x-admin.input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-jordy-blue-600 shadow-sm focus:ring-jordy-blue-500" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Kategori Aktif</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-x-4">
                            <a href="{{ route('admin.umkm.categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                                Batal
                            </a>
                            <x-admin.button>
                                {{ isset($category) ? 'Simpan Perubahan' : 'Simpan' }}
                            </x-admin.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>