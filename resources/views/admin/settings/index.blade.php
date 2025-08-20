<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Pengaturan Konten Landing Page">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.settings.initialize') }}" variant="secondary">
                        Inisialisasi Pengaturan Default
                    </x-admin.button>
                </x-slot>
                
                @if(session('success'))
                    <x-admin.alert type="success" class="mb-4">
                        {{ session('success') }}
                    </x-admin.alert>
                @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- General Settings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Umum</h3>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                @forelse($generalSettings as $setting)
                                    <div class="mb-4">
                                        <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $setting->label }}</label>
                                        
                                        @if($setting->type == 'text')
                                            <x-admin.input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" />
                                        @elseif($setting->type == 'textarea')
                                            <x-admin.input type="textarea" name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3">{{ old($setting->key, $setting->value) }}</x-admin.input>
                                        @elseif($setting->type == 'image')
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-1">
                                                    <x-admin.input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}" />
                                                </div>
                                                @if($setting->value)
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" class="h-20 w-20 object-cover rounded-md">
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif($setting->type == 'number')
                                            <x-admin.input type="number" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" />
                                        @endif
                                        
                                        @if($setting->description)
                                            <p class="mt-1 text-sm text-gray-500">{{ $setting->description }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-gray-500">Tidak ada pengaturan umum. Silakan inisialisasi pengaturan terlebih dahulu.</p>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Map Settings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Peta</h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Map Settings Form -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    @forelse($mapSettings as $setting)
                                        <div class="mb-4">
                                            @if($setting->type == 'text')
                                                <x-admin.input 
                                                    name="{{ $setting->key }}" 
                                                    id="{{ $setting->key }}" 
                                                    label="{{ $setting->label }}" 
                                                    value="{{ old($setting->key, $setting->value) }}" 
                                                    class="map-input" 
                                                />
                                            @elseif($setting->type == 'number')
                                                <x-admin.input 
                                                    type="number" 
                                                    name="{{ $setting->key }}" 
                                                    id="{{ $setting->key }}" 
                                                    label="{{ $setting->label }}" 
                                                    value="{{ old($setting->key, $setting->value) }}" 
                                                    class="map-input" 
                                                />
                                            @elseif($setting->type == 'textarea')
                                                <x-admin.input 
                                                    type="textarea" 
                                                    name="{{ $setting->key }}" 
                                                    id="{{ $setting->key }}" 
                                                    label="{{ $setting->label }}" 
                                                    value="{{ old($setting->key, $setting->value) }}" 
                                                    rows="3" 
                                                />
                                            @endif
                                            
                                            @if($setting->description)
                                                <p class="mt-1 text-sm text-gray-500">{{ $setting->description }}</p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-gray-500">Tidak ada pengaturan peta. Silakan inisialisasi pengaturan terlebih dahulu.</p>
                                    @endforelse
                                </div>
                                
                                <!-- Map Preview -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Preview Peta</h4>
                                    <div id="map-preview" class="h-64 rounded-lg border border-gray-300"></div>
                                    <p class="mt-2 text-xs text-gray-500">Peta akan diperbarui secara otomatis saat Anda mengubah koordinat</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <x-admin.button type="submit" variant="primary">
                                Simpan Pengaturan
                            </x-admin.button>
                        </div>
                    </form>
            </x-admin.card>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map with default coordinates
            const defaultLat = {{ $mapSettings->where('key', 'village_latitude')->first()->value ?? '-7.7956' }};
            const defaultLng = {{ $mapSettings->where('key', 'village_longitude')->first()->value ?? '110.3695' }};
            const defaultZoom = {{ $mapSettings->where('key', 'map_zoom')->first()->value ?? '15' }};
            
            const map = L.map('map-preview').setView([defaultLat, defaultLng], defaultZoom);
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Add marker
            let marker = L.marker([defaultLat, defaultLng]).addTo(map)
                .bindPopup('Lokasi Desa')
                .openPopup();
            
            // Function to update map
            function updateMap() {
                const lat = parseFloat(document.getElementById('village_latitude').value) || defaultLat;
                const lng = parseFloat(document.getElementById('village_longitude').value) || defaultLng;
                const zoom = parseInt(document.getElementById('map_zoom').value) || defaultZoom;
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    map.setView([lat, lng], zoom);
                    marker.setLatLng([lat, lng]);
                }
            }
            
            // Add event listeners to coordinate inputs
            const latInput = document.getElementById('village_latitude');
            const lngInput = document.getElementById('village_longitude');
            const zoomInput = document.getElementById('map_zoom');
            
            if (latInput) latInput.addEventListener('input', updateMap);
            if (lngInput) lngInput.addEventListener('input', updateMap);
            if (zoomInput) zoomInput.addEventListener('input', updateMap);
            
            // Add click event to map for setting coordinates
            map.on('click', function(e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);
                
                if (latInput) latInput.value = lat;
                if (lngInput) lngInput.value = lng;
                
                marker.setLatLng([lat, lng]);
                
                // Trigger input events to update any other listeners
                if (latInput) latInput.dispatchEvent(new Event('input'));
                if (lngInput) lngInput.dispatchEvent(new Event('input'));
            });
        });
    </script>
</x-admin-layout>