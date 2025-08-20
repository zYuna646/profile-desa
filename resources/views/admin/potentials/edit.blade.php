<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Potensi Desa">
                <x-slot name="action">
                    <x-admin.button href="{{ route('admin.potentials.index') }}" variant="secondary">
                        Kembali
                    </x-admin.button>
                </x-slot>
                    
                    <form method="POST" action="{{ route('admin.potentials.update', $potential) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <x-admin.input 
                                name="title" 
                                id="title" 
                                label="Judul Potensi" 
                                value="{{ old('title', $potential->title) }}" 
                                required 
                                :error="$errors->first('title')" 
                            />
                            
                            <!-- Order -->
                            <x-admin.input 
                                type="number" 
                                name="order" 
                                id="order" 
                                label="Urutan" 
                                value="{{ old('order', $potential->order) }}" 
                                required 
                                :error="$errors->first('order')" 
                            />
                            
                            <!-- Icon -->
                            <div>
                                <x-admin.input 
                                    name="icon" 
                                    id="icon" 
                                    label="Icon (Font Awesome Class)" 
                                    value="{{ old('icon', $potential->icon) }}" 
                                    :error="$errors->first('icon')" 
                                />
                                <p class="mt-1 text-sm text-gray-500">Contoh: fas fa-chart-line, fas fa-industry, dll. <a href="https://fontawesome.com/icons" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat daftar icon</a></p>
                            </div>
                            
                            <!-- Image -->
                            <div>
                                <x-admin.input 
                                    type="file" 
                                    name="image" 
                                    id="image" 
                                    label="Gambar" 
                                    :error="$errors->first('image')" 
                                />
                                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Ukuran maksimal: 2MB</p>
                                @if($potential->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" class="h-20 w-20 object-cover rounded-md">
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Status -->
                            <x-admin.input 
                                type="select" 
                                name="is_active" 
                                id="is_active" 
                                label="Status" 
                                :error="$errors->first('is_active')" 
                            >
                                <option value="1" {{ old('is_active', $potential->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $potential->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </x-admin.input>
                        </div>
                        
                        <!-- Description -->
                        <div class="mt-6">
                            <x-admin.input 
                                type="textarea" 
                                name="description" 
                                id="description" 
                                label="Deskripsi" 
                                rows="4" 
                                value="{{ old('description', $potential->description) }}" 
                                required 
                                :error="$errors->first('description')" 
                            />
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <x-admin.button type="submit" variant="primary">
                                Simpan Perubahan
                            </x-admin.button>
                        </div>
                    </form>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>