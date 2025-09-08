<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Judul" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $gallery->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full h-32" :value="old('description', $gallery->description)" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="category" value="Kategori" />
                            <x-select-input id="category" name="category" class="mt-1 block w-full" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Kegiatan" {{ old('category', $gallery->category) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Wisata" {{ old('category', $gallery->category) == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                                <option value="Budaya" {{ old('category', $gallery->category) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                                <option value="Fasilitas" {{ old('category', $gallery->category) == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="Lainnya" {{ old('category', $gallery->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div>
                            <x-input-label value="Gambar yang Ada" />
                            @if($gallery->images->count() > 0)
                                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach($gallery->images as $image)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($image->image) }}" alt="{{ $gallery->title }}" class="w-full h-32 object-cover rounded">
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <label class="flex items-center space-x-2 text-white cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                    <span>Hapus</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Belum ada gambar.</p>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="images" value="Tambah Gambar Baru" />
                            <x-file-input id="images" name="images[]" class="mt-1 block w-full" accept="image/*" multiple />
                            <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB per gambar.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                        </div>

                        <div>
                            <x-input-label for="order" value="Urutan" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $gallery->order)" min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('order')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-checkbox-input id="is_active" name="is_active" value="1" :checked="old('is_active', $gallery->is_active)" />
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