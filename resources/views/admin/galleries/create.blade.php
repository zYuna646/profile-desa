<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full h-32" :value="old('description')" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Kategori" />
                            <x-select-input id="category" name="category" class="mt-1 block w-full" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Kegiatan" {{ old('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Wisata" {{ old('category') == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                                <option value="Budaya" {{ old('category') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                                <option value="Fasilitas" {{ old('category') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div>
                            <x-input-label for="images" value="Gambar" />
                            <x-file-input id="images" name="images[]" class="mt-1 block w-full" accept="image/*" required multiple />
                            <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB per gambar.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                        </div>

                        <div>
                            <x-input-label for="order" value="Urutan" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', 0)" min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('order')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-checkbox-input id="is_active" name="is_active" value="1" :checked="old('is_active', true)" />
                            <x-input-label for="is_active" value="Aktif" />
                            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>