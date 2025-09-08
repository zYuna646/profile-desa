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
                                    help="Contoh: fas fa-cog, fas fa-users, dll. <a href='https://fontawesome.com/icons' target='_blank' class='text-jordy-blue-600 hover:text-jordy-blue-900'>Lihat daftar icon</a>" 
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
                            
                            <!-- Template -->
                            <div>
                                <x-admin.input 
                                    type="select" 
                                    name="service_template_id" 
                                    id="service_template_id" 
                                    label="Template Dokumen" 
                                    :error="$errors->first('service_template_id')" 
                                >
                                    <option value="">-- Pilih Template --</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('service_template_id', $service->service_template_id) == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                    @endforeach
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
                        
                        <!-- Template Data -->
                        <div class="mt-6" id="template-data-container" style="{{ $service->service_template_id ? '' : 'display: none;' }}">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Template</h3>
                            <div class="bg-gray-50 p-4 rounded-md mb-4">
                                <p class="text-sm text-gray-600">Isi data sesuai dengan template yang dipilih. Data ini akan digunakan untuk mengisi placeholder pada template dokumen.</p>
                            </div>
                            
                            <div id="template-fields" class="space-y-4">
                                <!-- Template fields will be dynamically added here -->
                                @if($service->template_data && count($service->template_data) > 0)
                                    @foreach($service->template_data as $key => $value)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">{{ $key }}</label>
                                        <input type="text" name="template_data[{{ $key }}]" value="{{ $value }}" class="mt-1 focus:ring-jordy-blue-500 focus:border-jordy-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan {{ $key }}">
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-between">
                            <div>
                                @if($service->service_template_id)
                                <x-admin.button href="{{ route('admin.services.generate-pdf', $service) }}" variant="secondary" type="button">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Generate PDF
                                </x-admin.button>
                                @endif
                            </div>
                            <x-admin.button type="submit" variant="primary">
                                Perbarui Layanan
                            </x-admin.button>
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const templateSelect = document.getElementById('service_template_id');
                                const templateDataContainer = document.getElementById('template-data-container');
                                const templateFields = document.getElementById('template-fields');
                                
                                // Sample template placeholders (in real implementation, this would come from the server)
                                const templatePlaceholders = {
                                    // Template ID: [placeholders]
                                    @foreach($templates as $template)
                                    {{ $template->id }}: ['NAMA', 'KABUPATEN', 'TANGGAL', 'NOMOR_SURAT'],
                                    @endforeach
                                };
                                
                                // Store existing template data
                                const existingData = {
                                    @if($service->template_data && count($service->template_data) > 0)
                                        @foreach($service->template_data as $key => $value)
                                        '{{ $key }}': '{{ $value }}',
                                        @endforeach
                                    @endif
                                };
                                
                                templateSelect.addEventListener('change', function() {
                                    const selectedTemplateId = this.value;
                                    templateFields.innerHTML = '';
                                    
                                    if (selectedTemplateId && templatePlaceholders[selectedTemplateId]) {
                                        templateDataContainer.style.display = 'block';
                                        
                                        templatePlaceholders[selectedTemplateId].forEach(placeholder => {
                                            const fieldDiv = document.createElement('div');
                                            const value = existingData[placeholder] || '';
                                            fieldDiv.innerHTML = `
                                                <label class="block text-sm font-medium text-gray-700">${placeholder}</label>
                                                <input type="text" name="template_data[${placeholder}]" value="${value}" class="mt-1 focus:ring-jordy-blue-500 focus:border-jordy-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan ${placeholder}">
                                            `;
                                            templateFields.appendChild(fieldDiv);
                                        });
                                    } else {
                                        templateDataContainer.style.display = 'none';
                                    }
                                });
                                
                                // Initialize on page load if template is selected
                                if (templateSelect.value) {
                                    // If we already have template data, don't override it with the change event
                                    if (!document.querySelector('#template-fields > div')) {
                                        templateSelect.dispatchEvent(new Event('change'));
                                    }
                                }
                            });
                        </script>
                    </form>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>