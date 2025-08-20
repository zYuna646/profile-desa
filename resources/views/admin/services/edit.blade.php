<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Layanan Desa">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.services.index') }}" variant="secondary">
                        Kembali
                    </x-admin.button>
                </x-slot>
                    
                    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div>
                                <x-admin.input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    label="Judul Layanan" 
                                    value="{{ old('title', $service->title) }}" 
                                    required 
                                    :error="$errors->first('title')" 
                                />
                            </div>
                            
                            <!-- Order -->
                            <div>
                                <x-admin.input 
                                    type="number" 
                                    name="order" 
                                    id="order" 
                                    label="Urutan" 
                                    value="{{ old('order', $service->order) }}" 
                                    required 
                                    :error="$errors->first('order')" 
                                />
                            </div>
                            
                            <!-- Icon -->
                            <div>
                                <x-admin.input 
                                    type="text" 
                                    name="icon" 
                                    id="icon" 
                                    label="Icon (Font Awesome Class)" 
                                    value="{{ old('icon', $service->icon) }}" 
                                    help="Contoh: fas fa-cog, fas fa-users, dll. <a href='https://fontawesome.com/icons' target='_blank' class='text-madang-600 hover:text-madang-900'>Lihat daftar icon</a>" 
                                    :error="$errors->first('icon')" 
                                />
                            </div>
                            
                            <!-- Image -->
                            <div>
                                <x-admin.input 
                                    type="file" 
                                    name="image" 
                                    id="image" 
                                    label="Gambar" 
                                    help="Format: JPG, PNG. Ukuran maksimal: 2MB" 
                                    :error="$errors->first('image')" 
                                />
                                @if($service->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="h-20 w-20 object-cover rounded-md">
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Status -->
                            <div>
                                <x-admin.input 
                                    type="select" 
                                    name="is_active" 
                                    id="is_active" 
                                    label="Status" 
                                    :error="$errors->first('is_active')" 
                                >
                                    <option value="1" {{ old('is_active', $service->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $service->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                </x-admin.input>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mt-6">
                            <x-admin.input 
                                type="textarea" 
                                name="description" 
                                id="description" 
                                label="Deskripsi" 
                                rows="4" 
                                value="{{ old('description', $service->description) }}" 
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