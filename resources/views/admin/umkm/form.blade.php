<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($umkm) ? 'Edit UMKM' : 'Tambah UMKM' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ isset($umkm) ? route('admin.umkm.update', $umkm) : route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($umkm))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-admin.input-label for="name" value="Nama UMKM" />
                                <x-admin.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $umkm->name ?? '')" required autofocus />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-admin.input-label for="category_id" value="Kategori" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-jordy-blue-500 focus:ring-jordy-blue-500 rounded-md shadow-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $umkm->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-admin.input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-admin.input-label for="owner" value="Nama Pemilik" />
                                <x-admin.text-input id="owner" name="owner" type="text" class="mt-1 block w-full" :value="old('owner', $umkm->owner ?? '')" required />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('owner')" />
                            </div>

                            <div>
                                <x-admin.input-label for="price" value="Harga" />
                                <x-admin.text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $umkm->price ?? '')" required />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <x-admin.input-label for="phone" value="Nomor Telepon" />
                                <x-admin.text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $umkm->phone ?? '')" />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-admin.input-label for="address" value="Alamat" />
                                <x-admin.text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $umkm->address ?? '')" />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <div class="col-span-2">
                                <x-admin.input-label for="description" value="Deskripsi" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-jordy-blue-500 focus:ring-jordy-blue-500 rounded-md shadow-sm" required>{{ old('description', $umkm->description ?? '') }}</textarea>
                                <x-admin.input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div class="col-span-2">
                                <x-admin.input-label for="image" value="Foto Utama UMKM" />
                                <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-jordy-blue-50 file:text-jordy-blue-700 hover:file:bg-jordy-blue-100" accept="image/*" />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('image')" />
                                @if(isset($umkm) && $umkm->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($umkm->image) }}" alt="{{ $umkm->name }}" class="h-32 w-32 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>

                            <div class="col-span-2">
                                <x-admin.input-label for="additional_images" value="Foto-foto Tambahan" />
                                <input type="file" id="additional_images" name="additional_images[]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-jordy-blue-50 file:text-jordy-blue-700 hover:file:bg-jordy-blue-100" accept="image/*" multiple />
                                <x-admin.input-error class="mt-2" :messages="$errors->get('additional_images.*')" />
                                @if(isset($umkm) && $umkm->images->count() > 0)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">Foto-foto Saat Ini</h4>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                            @foreach($umkm->images as $image)
                                                <div class="relative group">
                                                    <img src="{{ $image->image_url }}" alt="{{ $umkm->name }}" class="h-24 w-full object-cover rounded-lg">
                                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                        <button type="button" onclick="deleteImage({{ $image->id }})" class="text-white hover:text-red-500 transition-colors">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-span-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-jordy-blue-600 shadow-sm focus:ring-jordy-blue-500" {{ old('is_active', $umkm->is_active ?? true) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">UMKM Aktif</span>
                                </label>
                            </div>

                            @push('scripts')
                            <script>
                                function deleteImage(imageId) {
                                    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                                        fetch(`/admin/umkm-images/${imageId}`, {
                                            method: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json',
                                            }
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.message) {
                                                // Tampilkan pesan sukses
                                                const successAlert = document.createElement('div');
                                                successAlert.className = 'fixed bottom-4 right-4 bg-green-50 text-green-700 px-4 py-2 rounded-lg shadow-lg';
                                                successAlert.textContent = data.message;
                                                document.body.appendChild(successAlert);

                                                // Hilangkan pesan setelah 3 detik
                                                setTimeout(() => {
                                                    successAlert.remove();
                                                    // Reload halaman untuk memperbarui tampilan
                                                    window.location.reload();
                                                }, 1000);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            // Tampilkan pesan error
                                            const errorAlert = document.createElement('div');
                                            errorAlert.className = 'fixed bottom-4 right-4 bg-red-50 text-red-700 px-4 py-2 rounded-lg shadow-lg';
                                            errorAlert.textContent = 'Terjadi kesalahan saat menghapus foto. Silakan coba lagi.';
                                            document.body.appendChild(errorAlert);

                                            // Hilangkan pesan error setelah 3 detik
                                            setTimeout(() => {
                                                errorAlert.remove();
                                            }, 3000);
                                        });
                                    }
                                }
                            </script>
                            @endpush
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-x-4">
                            <a href="{{ route('admin.umkm.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                                Batal
                            </a>
                            <x-admin.button type="submit">
                                {{ isset($umkm) ? 'Simpan Perubahan' : 'Simpan' }}
                            </x-admin.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>