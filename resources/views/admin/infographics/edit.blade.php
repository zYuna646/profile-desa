<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Infografis">
                <form action="{{ route('admin.infographics.update', $infographic) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-admin.label for="title" value="Judul" />
                        <x-admin.input type="text" name="title" id="title" class="mt-1 block w-full" :value="old('title', $infographic->title)" required autofocus />
                        <x-admin.input-error for="title" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="infographic_type_id" value="Tipe Infografis" />
                        <select name="infographic_type_id" id="infographic_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Tipe Infografis</option>
                            @foreach(\App\Models\InfographicType::where('is_active', true)->orderBy('order')->get() as $type)
                                <option value="{{ $type->id }}" {{ old('infographic_type_id', $infographic->infographic_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-admin.input-error for="infographic_type_id" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="description" value="Deskripsi" />
                        <x-admin.textarea name="description" id="description" class="mt-1 block w-full h-32">{{ old('description', $infographic->description) }}</x-admin.textarea>
                        <x-admin.input-error for="description" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="image" value="Gambar" />
                        @if($infographic->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $infographic->image) }}" alt="{{ $infographic->title }}" class="h-32 w-auto rounded-lg object-cover">
                            </div>
                        @endif
                        <x-admin.file-input name="image" id="image" class="mt-1 block w-full" accept="image/*" />
                        <x-admin.input-error for="image" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</p>
                    </div>

                    <div>
                        <x-admin.label for="data" value="Data Infografis (JSON)" />
                        <x-admin.textarea name="data" id="data" class="mt-1 block w-full h-64 font-mono">{{ old('data', json_encode($infographic->data, JSON_PRETTY_PRINT)) }}</x-admin.textarea>
                        <p class="mt-1 text-sm text-gray-500">Masukkan data dalam format JSON. Contoh: [{"label":"Penduduk","value":1000},{"label":"Laki-laki","value":500}]</p>
                        <x-admin.input-error for="data" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="diagram_type" value="Tipe Diagram" />
                        <select name="diagram_type" id="diagram_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Tipe Diagram</option>
                            <option value="bar" {{ old('diagram_type', $infographic->diagram_type) == 'bar' ? 'selected' : '' }}>Bar Chart</option>
                            <option value="pie" {{ old('diagram_type', $infographic->diagram_type) == 'pie' ? 'selected' : '' }}>Pie Chart</option>
                            <option value="line" {{ old('diagram_type', $infographic->diagram_type) == 'line' ? 'selected' : '' }}>Line Chart</option>
                            <option value="table" {{ old('diagram_type', $infographic->diagram_type) == 'table' ? 'selected' : '' }}>Table</option>
                        </select>
                        <x-admin.input-error for="diagram_type" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="order" value="Urutan" />
                        <x-admin.input type="number" name="order" id="order" class="mt-1 block w-full" :value="old('order', $infographic->order)" min="0" />
                        <x-admin.input-error for="order" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <x-admin.checkbox name="is_active" id="is_active" value="1" :checked="old('is_active', $infographic->is_active)" />
                        <x-admin.label for="is_active" value="Aktif" class="ml-2" />
                        <x-admin.input-error for="is_active" class="mt-2 ml-2" />
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <x-admin.button href="{{ route('admin.infographics.index') }}" variant="secondary">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            Simpan Perubahan
                        </x-admin.button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>