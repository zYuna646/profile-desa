<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Tipe Infografis">
                <form action="{{ route('admin.infographic-types.update', $infographicType) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-admin.label for="name" value="Nama" />
                        <x-admin.input type="text" name="name" id="name" class="mt-1 block w-full" :value="old('name', $infographicType->name)" required autofocus />
                        <x-admin.input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="description" value="Deskripsi" />
                        <x-admin.textarea name="description" id="description" class="mt-1 block w-full h-32">{{ old('description', $infographicType->description) }}</x-admin.textarea>
                        <x-admin.input-error for="description" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="icon" value="Icon (Opsional)" />
                        <x-admin.input type="text" name="icon" id="icon" class="mt-1 block w-full" :value="old('icon', $infographicType->icon)" placeholder="Contoh: fa-chart-pie" />
                        <p class="text-sm text-gray-500 mt-1">Masukkan nama icon dari Font Awesome. Contoh: fa-chart-pie</p>
                        <x-admin.input-error for="icon" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="order" value="Urutan" />
                        <x-admin.input type="number" name="order" id="order" class="mt-1 block w-full" :value="old('order', $infographicType->order)" min="0" />
                        <x-admin.input-error for="order" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <x-admin.checkbox name="is_active" id="is_active" :checked="old('is_active', $infographicType->is_active)" />
                        <x-admin.label for="is_active" value="Aktif" class="ml-2" />
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <x-admin.button href="{{ route('admin.infographic-types.index') }}" variant="secondary">
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