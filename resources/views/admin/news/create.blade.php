<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Tambah Berita">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-admin.label for="title" value="Judul" />
                        <x-admin.input type="text" name="title" id="title" class="mt-1 block w-full" :value="old('title')" required autofocus />
                        <x-admin.input-error for="title" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="category_id" value="Kategori" />
                        <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\NewsCategory::where('is_active', true)->orderBy('name')->get() as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-admin.input-error for="category_id" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="content" value="Konten" />
                        <x-admin.textarea name="content" id="content" class="mt-1 block w-full h-64" required>{{ old('content') }}</x-admin.textarea>
                        <x-admin.input-error for="content" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="image" value="Gambar" />
                        <x-admin.file-input name="image" id="image" class="mt-1 block w-full" accept="image/*" />
                        <x-admin.input-error for="image" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</p>
                    </div>

                    <div class="flex items-center">
                        <x-admin.checkbox name="is_active" id="is_active" value="1" :checked="old('is_active', true)" />
                        <x-admin.label for="is_active" value="Aktif" class="ml-2" />
                        <x-admin.input-error for="is_active" class="mt-2 ml-2" />
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <x-admin.button href="{{ route('admin.news.index') }}" variant="secondary">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            Simpan
                        </x-admin.button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>