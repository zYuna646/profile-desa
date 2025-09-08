<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Kategori Berita">
                <form action="{{ route('admin.news-categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-admin.label for="name" value="Nama" />
                        <x-admin.input type="text" name="name" id="name" class="mt-1 block w-full" :value="old('name', $category->name)" required autofocus />
                        <x-admin.input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="description" value="Deskripsi" />
                        <x-admin.textarea name="description" id="description" class="mt-1 block w-full h-32">{{ old('description', $category->description) }}</x-admin.textarea>
                        <x-admin.input-error for="description" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <x-admin.checkbox name="is_active" id="is_active" :checked="old('is_active', $category->is_active)" />
                        <x-admin.label for="is_active" value="Aktif" class="ml-2" />
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <x-admin.button href="{{ route('admin.news-categories.index') }}" variant="secondary">
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